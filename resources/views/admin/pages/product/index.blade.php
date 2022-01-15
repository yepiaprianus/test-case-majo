<?php

use Illuminate\Support\Facades\Session;
?>
@extends('layouts.admin.header')
@section('content')
<!-- <div class="content-wrapper"> -->
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Produk
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('beranda') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Refresh" onclick="reloadPage()" aria-haspopup="true" aria-expanded="false">
                    <i class="feather icon-refresh-ccw"></i>
                </button>
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" onclick="createPruduct()">
                    <i class="feather icon-file-plus"></i>
                    <b>Tambah</b>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="basic-examples">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Jumlah Produk : <span id="total_produk"></span></h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- <div class="card-datatable"> -->
                    <table class="datatables-ajax table table-responsive-md-12" id="tb_produk" cellspacing="0" width="99.9%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
</div>



@endsection
@section('page-script')
<script src="{{ asset('theme/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
<!-- <script src="{{ asset('theme/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js') }}"></script> -->
@endsection

@section('add-scripts')
<script>
    $(document).ready(function() {
        let optionToast = {
            positionClass: 'toast-bottom-right',
            containerId: 'toast-bottom-right'
        };

        var msg = '<?= json_encode(Session::has('alert')) ?>';

        if (msg == "true") {
            var data_alert = <?= json_encode(Session::get('alert')) ?>;
            if (data_alert.type == 'success') {
                toastr.success(data_alert.msg, 'Success!', optionToast);
            }

            if (data_alert.type == 'Error') {
                toastr.error(data_alert.msg, 'Error!', optionToast);
            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#tb_produk').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url ('all_product') }}",
            columns: [{
                    data: "id",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: "date",
                    name: "date",
                    className: "text-center"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ],
            initComplete: function(data) {
                var info = data.json.info;
                $("#total_produk").html(info.total);
            },
        });
    });

    function createPruduct() {
        location.href = "{{ URL::to('product/create') }}";
    }

    function deleteProduct(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: false
        }).then(
            function(result) {
                if (result.value) {
                    $.ajax({
                        dataType: 'JSON',
                        type : 'POST',
                        data: {
                            id: id,
                            _method: 'DELETE'
                        },
                        url:"{{ route('product.destroy', '') }}/"+id,
                        success: function(res) {
                            console.log(res);
                            if (res.code == 1) {
                                Swal.fire({
                                    type: "success",
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    confirmButtonClass: "btn btn-success"
                                });
                            } else {
                                Swal.fire({
                                    type: "error",
                                    title: "Failed!",
                                    text: "Your file has failed been deleted.",
                                    confirmButtonClass: "btn btn-success"
                                });
                            }
                        },
                        error: function(e) {
                            Swal.showValidationMessage(
                                `Request failed: ${e}`
                            );                            
                        },
                        complete: function(res) {
                            console.log(res);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            }.bind(this)
        );
    }

    function updateTgl(id, tanggal, jam) {
        $("#id_artikel").val(id);
        $("#tanggal_publish").val(tanggal);
        $("#jam_publish").val(jam);
        $("#backdrop").modal('show');
    }
</script>
@endsection