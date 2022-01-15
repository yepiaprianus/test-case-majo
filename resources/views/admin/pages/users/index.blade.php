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
                            <a href="{{ url('beranda') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
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
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Tambah user" type="button" aria-haspopup="true" aria-expanded="false" onclick="createUser()">
                    <i class="feather icon-file-plus"></i><b>Tambah User</b>
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
                        <h4 class="card-title">Users</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-datatable">
                                <table class="datatables-ajax table table-responsive-md-12" id="tb_user" cellspacing="0" width="99.9%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Username</th>
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
<div class="modal fade text-left viewUserMod" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">View User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetForm()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form_view" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="name">Nama</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" name="name" autocomplete="off" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="email_view">Email</label>
                            <input type="text" class="form-control" id="email_view" name="email_view" placeholder="Email" autocomplete="off" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="role_view">Role</label>
                            <input type="text" class="form-control" id="role_view" name="role_view" placeholder="role" autocomplete="off" readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username" autocomplete="off" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="resetForm()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
@section('add-scripts')
<script>
    var tbUsers;
    $(document).ready(function() {
        tbUsers = $('#tb_user').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searchDelay: 350,
            // "search": {
            //     "search": "",
            // },
            // "autoWidth": false,
            ajax: "{{ url ('get_all_users') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role_name',
                    name: 'role_name'
                },
                {
                    data: 'username',
                    name: 'username'
                },

                // {
                //     "data": "created_at",
                //     render: function(data, type, row, meta) {
                //         if (type === "sort" || type === "type") {
                //             return data;
                //         }
                //         return moment(data).format("YYYY-MM-DD HH:mm:ss");
                //     }
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ]
        });


        $('.dataTables_filter input')
            .unbind('keypress keyup')
            .bind('keypress keyup', function(e) {                 
                if ($(this).val().length < 3 && e.keyCode != 13) return;
                if (this.timer) {
                    clearTimeout(this.timer);
                    this.timer = null;
                }
                this.timer = setTimeout(() => {
                    // console.log($(this).val());
                   tbUsers.fnFilter($(this).val());                   
               }, 500);
            });
    });

    function createUser() {
        location.href = "{{ URL::to('users/create') }}";
    }

    function resetForm() {
        $("#form_view").trigger('reset');
    }

    function deleteUser(id) {
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
                        url: `{{ url('delete_user/${id}') }}`,
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

    function view_user(id) {
        $.ajax({
            url: `{{ url('get_user_by_id/${id}') }}`,
            dataType: 'JSON',
            type: 'GET',
            success: function(data) {
                var users = data.data;
                $("#name").val(users.name);
                $("#email_view").val(users.email);
                $("#role_view").val(users.role_name);
                $("#username").val(users.username);
                setTimeout(() => {
                    $("#modal_view").modal('show');
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