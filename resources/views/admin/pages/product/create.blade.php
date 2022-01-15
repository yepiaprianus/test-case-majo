@extends('layouts.admin.header')
@section('page-style')
<link href="{{ asset('theme/app-assets/css/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('theme/app-assets/css/quill/quill.bubble.css') }}" rel="stylesheet">
<!-- <link rel="stylesheet" href="{{ asset('theme/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}"> -->

@endsection
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
                            <a href="{{ url('product') }}">Produk</a>
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
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" onclick="backtoProduct()">
                    <i class="feather icon-arrow-left-circle"></i>
                    <b>Kembali</b>
                </button>
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" data-toggle="tooltip" data-original-title="Refresh" onclick="reloadPage()" aria-haspopup="true" aria-expanded="false">
                    <i class="feather icon-refresh-ccw"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="basic-examples">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Poduct</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="relative">
                        <form action="" id="form_product" novalidate enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Product Name :</label>
                                        <div class="controls">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Product Name" required data-validation-required-message="This name field is required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="form-control-label">Category :</label>
                                        <div class="controls">
                                            <select name="category" id="category" class="form-control select2 required" required style="width: 100%;" required data-validation-required-message="This field is required">
                                                <option value="" aria-readonly="true">--Choose--</option>
                                                @foreach($kategori as $k)
                                                <option value="{{$k->id}}">{{$k->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="form-control-label">Price</label>
                                        <input type="number" class="form-control" name="price" id="price" min="0" placeholder="Price" required data-validation-required-message="This price field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product_description" class="form-control-label">Description :</label>
                                        <input name="product_description" id="product_description" type="hidden">
                                        <div id="editor" class="controls"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="border rounded p-2">
                                            <h4 class="mb-1">Product Image</h4>
                                            <div class="media flex-column flex-md-row">
                                                <div class="media-aside align-self-start">
                                                    <img src="{{ $img_product }}" alt="image" class="rounded mr-2 mb-1 mb-md-0" id="img_product" style="max-height: 100px; max-width: 150px; height: auto; width: 100%;">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">Image best resolution 800x400, image size 10mb.</small>
                                                    <p class="card-text my-50">
                                                        <a id="blog-image-text" href="javascript:void(0);" target="_self"></a>
                                                    </p>
                                                    <div class="d-inline-block">
                                                        <div class="controls">
                                                            <input type="file" id="product_image" name="product_image" accept="image/*" class="form-control" placeholder="Image" required data-validation-required-message="This field is required" />
                                                        </div>

                                                        <div class="progress progress-bar-primary mb-2">
                                                            <div class="progress-bar" id="ProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light float-right">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('vendor-script')
<script src="{{ asset('theme/app-assets/js/quill/quill.js') }}"></script>
<script src="{{ asset('theme/app-assets/js/quill/quill.min.js') }}"></script>
@endsection
@section('page-script')
<script src="{{ asset('theme/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
<!-- <script src="{{ asset('theme/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js') }}"></script> -->
@endsection
@section('add-scripts')
<script type="text/javascript">
    function cekKategori() {
        var kategori = <?= json_encode($kategori) ?>;
        if (kategori.length == 0) {
            Swal.fire({
                type: "error",
                title: "Perhatian!",
                text: "Data kategori masih kosong, silahkan input kategori.Terimaksih.",
                confirmButtonClass: "btn btn-success"
            }).then(function(result) {
                if (result.value) {
                    return backtoProduct();
                }
            });
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            progressBar(reader);
            reader.onload = function(e) {
                $('#img_product').attr('src', e.target.result);
                setTimeout(() => {
                    $('#ProgressBar').css('width', '0%');
                }, 2000);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function progressBar(reader) {
        reader.onprogress = function(event) {
            var str, p;
            if (event.lengthComputable) { // does the progress know what's coming
                p = (event.loaded / event.total) * 100; // get the percent loaded
                str = Math.floor(p) + "%"; // create the text
            } else {
                p = event.loaded / 1024; // show the kilobytes
                str = Math.floor(p) + "k"; // the text
                p = ((p / 50) % 1) * 100; // make the progress bar cycle around every 50K
            }
            $('#ProgressBar').css('width', p + '%');
            // $("#sp_progressCount").html(str);
        }
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        cekKategori();
        $("#product_image").change(function() {
            readURL(this);
        });

        // submit data
        $('#form_product').submit(function(e) {
            e.preventDefault();
            var content = $('input[name=product_description]').val();
            console.log(content);
            if (content == "" || content == '<p><br></p>') {
                quill.focus();
                Swal.fire({
                    type: "error",
                    title: "Failed!",
                    text: "Description can't be null",
                    confirmButtonClass: "btn btn-danger"
                });
                return false;
            } else {
                // var form = this;
                var formData = new FormData(this);
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
                            url: "{{ route('product.store') }}",
                            // data: $(this).serialize(),
                            data: formData,
                            // dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                if (data.code == 1) {
                                    Swal.fire({
                                        type: "success",
                                        title: 'Inserted!',
                                        text: 'Your data has been submitted',
                                        confirmButtonClass: 'btn btn-success',
                                    })
                                    $("#form_product").trigger("reset");
                                    setTimeout(function() {
                                        backtoProduct();
                                    }, 1000);

                                } else {
                                    var msg = data.message;
                                    Swal.fire({
                                        type: "error",
                                        title: "Failed!",
                                        text: msg,
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
            }

        });

        // quill 
        var options = {
            // debug: 'info',
            modules: {
                // imageResize: {
                //     displaySize: true,
                // },
                toolbar: {
                    container: [
                        // [{
                        //     header: [1, 2, 3, 4, false]
                        // }],
                        [
                            "bold",
                            "italic",
                            "underline",
                            "strike",
                            "blockquote",
                        ],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }],
                        [{
                            script: "sub"
                        }, {
                            script: "super"
                        }], // superscript/subscript
                        [{
                            indent: "-1"
                        }, {
                            indent: "+1"
                        }], // outdent/indent
                        [{
                            direction: "rtl"
                        }],
                        [{
                            size: ["small", false, "large", "huge"]
                        }], // custom dropdown
                        // [{
                        //     header: [1, 2, 3, 4, 5, 6, false]
                        // }],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        // [{'font': []}],
                        [{
                            align: []
                        }],
                        ["link", "image", "formula"],
                        ["clean"],
                    ],

                    handlers: {
                        link: function(val) {
                            if (val) {
                                const range = this.quill.getSelection();
                                this.quill.focus();
                                if (range == null || range.length === 0) {
                                    Swal.fire({
                                        type: "error",
                                        title: "Gagal!",
                                        text: "Silahkan isi atau block text terlebih dahulu.",
                                        confirmButtonClass: "btn btn-success",
                                    });
                                    return;
                                }
                                let preview = this.quill.getText(range);
                                if (
                                    /^\S+@\S+\.\S+$/.test(preview) &&
                                    preview.indexOf("mailto:") !== 0
                                ) {
                                    preview = `mailto:${preview}`;
                                }
                                const {
                                    tooltip
                                } = this.quill.theme;
                                tooltip.edit("link", preview);
                            } else {
                                this.quill.format("link", false);
                            }
                        },
                    },
                },

            },
            placeholder: 'Type the description',
            // readOnly: true,
            theme: 'snow'
        };
        var quill = new Quill('#editor', options);
        quill.on('editor-change', function(eventName, html, text) {
            var myEditor = document.querySelector('#editor');
            var htmlVal = myEditor.children[0].innerHTML;
            $("#product_description").val(htmlVal);
        });
    });

    function backtoProduct() {
        location.href = "{{ URL::to('product') }}";
    }

    function resetForm() {
        $("#form_product").trigger('reset');
    }
</script>
@endsection