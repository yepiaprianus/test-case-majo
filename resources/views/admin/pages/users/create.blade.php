@extends('layouts.admin.header')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Users
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('users') }}">User</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
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
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Kembali" type="button" aria-haspopup="true" aria-expanded="false" onclick="backUser()">
                    <i class="feather icon-arrow-left"></i><b> Kembali</b>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="users-list-wrapper">
        <div id="basic-examples">
            <div class="card">
                <div class="card-header">
                    <h4 class="car-title"> Create Users</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="" id="form_insert" autocomplete="off">
                                    @csrf
                                    <div class="form-group col-md-8">
                                        <label for="name">Nama</label>
                                        <div class="controls">
                                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="email">Email</label>
                                        <div class="controls">
                                            <input type="email" name="email" id="email" autocomplete="off" required class="form-control" data-validation-required-message="This field is required">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="role">Role</label>
                                        <div class="controls">
                                            <select name="role" id="role" class="form-control select2" required data-validation-required-message="This field is required">
                                                <option value="" aria-readonly="true">--Choose--</option>
                                                @foreach($data as $k)
                                                <option value="{{$k->role_id}}">{{$k->role_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('add-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                        url: "{{ url('simpan_users') }}",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data.code == 1) {
                                Swal.fire({
                                    type: "success",
                                    title: 'Inserted!',
                                    text: 'Your data has been submitted',
                                    confirmButtonClass: 'btn btn-success',
                                })
                                $("#form_insert").trigger("reset");
                                setTimeout(function() {
                                    window.location.replace("{{ URL::to('users') }}");
                                }, 1800);
                            }

                            if (data.code == 0) {
                                Swal.fire({
                                    type: "error",
                                    title: "Failed!",
                                    text: `${data.message[0]}`,
                                    confirmButtonClass: "btn btn-success"
                                });
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

    function backUser() {
        location.href = "{{ URL::to('users') }}";
    }
</script>
@endsection