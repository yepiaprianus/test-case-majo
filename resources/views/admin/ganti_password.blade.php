@extends('layouts.admin.header')
@section('content')
<!-- <div class="content-wrapper"> -->
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Ganti Password
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('beranda') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Ganti Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Refresh" aria-haspopup="true" aria-expanded="false" onclick="reloadPage()">
                    <i class="feather icon-refresh-ccw" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="basic-examples">
        <div id="page-user-view">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ganti Password</h4>
                </div>
                <div class="card-content">
                    <form id="formgantiPassword" autocomplete="off">
                        @csrf
                        <input type="hidden" id="id_user" name="id_user" value="{{ $id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-9">
                                    <label class="form-control-label" for="oldPassword">Password lama</label>
                                    <input id="pass_lama" name="pass_lama" type="password" class="form-control" placeholder="Masukan password lama anda" minlength="5" required />
                                </div>
                                <!-- <div class="form-group col-md-9">
                                    <label class="form-control-label" for="pass_baru">Password baru</label>
                                    <input type="password" id="pass_baru" name="pass_baru" class="form-control form-readonly" placeholder="Masukan password baru anda" minlength="6" required readonly />
                                </div>
                                <div class="form-group col-md-9">
                                    <label class="form-control-label" for="confirmPassword">Konfirmasi Password baru</label>
                                    <input type="password" id="pass_confirm" name="pass_confirm" class="form-control form-readonly" placeholder="Masukan lagi password baru anda" minlength="6" required readonly />
                                </div> -->
                                <div class="col-sm-9 md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="password" name="pass_baru" id="pass_baru" class="form-control form-readonly" placeholder="Your Password" required data-validation-required-message="The password field is required" minlength="6" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 md-9">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control form-readonly" placeholder="Confirm Password" required data-validation-match-match="pass_baru" data-validation-required-message="The Confirm password field is required" minlength="6" required readonly>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="form-group col-md-12" style="display: none;" id="div_error">
                                    <div class="alert alert-danger" role="alert">
                                        <p v-for="error in errors" id="error_msg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="bt_submit" disabled>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- </div> -->
@endsection
@section('add-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#pass_confirm").keyup(function(e) {
            var valueConfirm = e.target.value;
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                var newPass = $("#pass_baru").val();
                if (valueConfirm != newPass) {
                    $("#div_error").css('display', 'block');
                    $("#error_msg").html("Password confirm masih salah");
                    $("#bt_submit").attr("disabled");
                    // return false;
                } else {
                    $("#div_error").css('display', 'none');
                    $("#bt_submit").removeAttr("disabled");
                    $("#error_msg").html("");
                }
            }, 500);
        });

        // insert 
        $('#formgantiPassword').submit(function(e) {
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
                        url: "{{ url('ganti_password_user') }}",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(data) {
                            if (data.code == 1) {
                                Swal.fire({
                                    type: "success",
                                    title: 'Updated!',
                                    text: 'Your data has been submitted',
                                    confirmButtonClass: 'btn btn-success',
                                })
                                $("#formgantiPassword").trigger("reset");
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1800);
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

        $("#pass_lama").keyup(function(e) {
            var len = e.target.value.length;
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                if (len >= 5) {
                    var pass = $("#pass_lama").val();
                    var id = $("#id_user").val();

                    $.ajax({
                        url: "{{ url('cek_password') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            "id": id,
                            "password": pass
                        },
                        success: function(data) {
                            if (!data.status) {
                                $("#div_error").css('display', 'block');
                                $("#error_msg").html("Password lama salah");
                                $(".form-readonly").attr('readonly');
                                $("#bt_submit").attr("disabled");
                            } else {
                                $("#div_error").css('display', 'none');
                                $("#bt_submit").removeAttr("disabled");
                                $("#error_msg").html("");
                                $(".form-readonly").removeAttr('readonly');
                            }
                        },
                        error: function(e) {
                            Swal.showValidationMessage(
                                `Request failed: ${e}`
                            );
                        }
                    });
                }
            }, 500);
        });
    });
</script>
@endsection