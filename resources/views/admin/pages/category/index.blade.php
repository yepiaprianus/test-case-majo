@extends('layouts.admin.header')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Kategori
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('beranda') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" onclick="reloadPage()" data-toggle="tooltip" data-original-title="Refresh" aria-haspopup="true" aria-expanded="false">
                    <i class="feather icon-refresh-ccw" aria-hidden="true"></i>
                </button>
                
                @if(Session::get('role') == 'R000')
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Tambah kategori" type="button" aria-haspopup="true" aria-expanded="false" onclick="createKategori()">
                    <i class="feather icon-file-plus"></i><b> Tambah Kategori</b>
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="ajax-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Kategori</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-datatable">
                                <table class="datatables-ajax table table-responsive-md-12" id="tb_kategori" cellspacing="0" width="99.9%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade text-left viewUserMod" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetForm()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="form_insert" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="name">Kategori</label>
                            <input type="text" class="form-control" placeholder="Category name" id="category_name" name="category_name" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetForm()">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
@section('add-scripts')
<script>
    $(document).ready(function() {
        $('#tb_kategori').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            // "autoWidth": false,
            ajax: "{{ url ('get_all_category') }}",
            columns: [{
                    data: "id",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ]
        });

        $('#form_insert').submit(function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, insert it!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('simpan_category') }}",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 1) {
                                Swal.fire({
                                    type: "success",
                                    title: 'Inserted!',
                                    text: 'Your data has been submitted',
                                    confirmButtonClass: 'btn btn-success',
                                })
                                $("#form_insert").trigger("reset");
                                setTimeout(function() {
                                    window.location.reload();
                                }, 100);
                            }
                        },
                        error: function(error) {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            );
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        },
                    })
                }
            }.bind(this))
        });
    });

    function createKategori() {
        $("#myModalLabel1").html("Tambah Kategori");
        $("#modal_insert").modal('show');
    }

    function resetForm() {
        $("#form_insert").trigger('reset');
    }

    function deleteCategory(id) {
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
                        url: `{{ url('delete_category/${id}') }}`,
                        dataType: 'JSON',
                        type: 'GET',
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
                            // setTimeout(function() {
                            //     window.location.reload();
                            // }, 1000);
                        },
                        complete: function(res) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            }.bind(this)
        );
    }

    function view_category(id) {
        $.ajax({
            url: `{{ url('get_category/${id}') }}`,
            dataType: 'JSON',
            type: 'GET',
            success: function(data) {
                var category = data.data;
                $("#category_name").val(category.category_name);
                $("#id").val(category.id);
                $("#myModalLabel1").html("Update Kategori");
                setTimeout(() => {
                    $("#modal_insert").modal('show');
                }, 100);
            },
            error: function(er) {
                Swal.showValidationMessage(
                    `Request failed: ${er}`
                );

            },
            complete: function(data) {
                console.log("complete");
            },
        });

    }
</script>
@endsection