<?php
use Illuminate\Support\Facades\Session;
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}" class="loading" data-textdirection="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Test Case Fullstack</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset ('images/logo/paket-desktop.png') }}">
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet"> -->
    <link href="{{ asset ('theme/app-assets/css/google-font.css') }}" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/extensions/toastr.css') }}">

    <!-- BEGIN: Analytic -->
    <!-- <link rel="stylesheet" type="text/css" href="theme/app-assets/vendors/css/charts/apexcharts.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/extensions/tether-theme-arrows.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/extensions/tether.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/extensions/shepherd-theme-default.css') }}">
    <!-- END: Analitic -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">

    <!-- Begin datepicker css -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css/datepicker/form-flat-pickr.css') }}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css/datepicker/form-pickadate.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">

    <!-- end datepicker css  -->
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/custom-css.css') }}"> -->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/plugins/extensions/toastr.css') }}">

    <!-- BEGIN: Analytic -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/css/pages/card-analytics.css') }}">

    <!-- datatable  -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">


    <!-- END: Analitic -->
    <!-- END: Page CSS-->
    @yield('vendor-style')
    @yield('page-style')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('theme/assets/css/style.css') }}">
    <!-- <link href="{{ asset ('theme/app-assets/css/font-awesome.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset ('theme/app-assets/css/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('theme/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <!-- END: Custom CSS-->
    <style type="text/css" media="screen">
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        div.dataTables_wrapper div.dataTables_filter select,
        div.dataTables_wrapper div.dataTables_length select {
            padding: 2.5px 0.8rem;
        }

        div#DataTables_Table_0_wrapper {
            width: 100% !important;
        }

        .ql-align-justify {
            white-space: normal !important;
            text-align: justify !important;
        }

        .ql-align-left {
            text-align: left !important;
        }

        .ql-align-right {
            text-align: right !important;
        }

        .ql-align-center {
            text-align: center !important;
        }

        .dropdown2 i {
            margin-right: 0px !important;
        }

        html body .content .content-wrapper {
            min-height: 520px !important;
        }

        .vgt-table.bordered td,
        .vgt-table.bordered th {
            border: 0px solid #dcdfe6 !important;
        }

        .vgt-table thead th {
            color: #606266 !important;
            vertical-align: middle !important;
            border-bottom: 1px solid #dcdfe6 !important;
            background: none !important;
            background-color: #137bbf1f !important;
            padding-right: 1.5em !important;
            font-weight: 500 !important;
        }

        .vgt-table th.line-numbers,
        .vgt-table th.vgt-checkbox-col {
            padding: 0 .75em 0 .75em !important;
            color: #606266 !important;
            word-wrap: break-word !important;
            width: 25px !important;
            text-align: center !important;
            /*background: none !important;*/
        }

        table.vgt-table {
            font-size: 14px !important;
            border-radius: 0.5rem !important;
        }

        .vgt-global-search {
            padding: 5px 0 !important;
            display: -webkit-box !important;
            display: flex !important;
            flex-wrap: nowrap !important;
            -webkit-box-align: stretch !important;
            align-items: stretch !important;
            border: 0px solid #dcdfe6 !important;
            background: none !important;
            margin-bottom: 15px !important;
            width: 30% !important;
            margin-left: 70% !important;
            float: right !important;
        }

        table.vgt-table td {
            vertical-align: inherit !important;
        }

        .vgt-wrap__footer {
            border: 0px solid #dcdfe6 !important;
            background: none !important;
        }

        .accordion .collapse-border-item.card:first-child {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .accordion .collapse-border-item.card {
            margin-bottom: 20px !important;
        }

        .accordion .collapse-border-item.card .card-header {
            background-color: rgba(0, 0, 0, 0.03) !important;
        }

        .ql-editor {
            min-height: 350px !important;
        }

        .contentIsi p {
            margin: 0px !important;
        }

        .img-content {
            max-width: 750px !important;
            height: auto !important;
        }

        .avatar .avatar-status-online {
            background-color: #28c76f;
        }

        .avatar [class*=avatar-status-] {
            border: 1px solid #fff;
            border-radius: 50%;
            bottom: 0;
            height: 11px;
            position: absolute;
            right: 0;
            width: 11px;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow navbar-dark bg-primary" style="background-color : #1C0F3B !important">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto">
                                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascriptvoid(0)">
                                    <i class="ficon feather icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link nav-link-expand">
                                <i class="ficon feather icon-maximize"></i>
                            </a>
                        </li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name text-bold-600">{{ Session::get('name') }}</span>
                                    <span class="user-status">{{Session::get('role_name')}}</span>
                                </div>
                                <span>
                                    <img class="round" src="{{ asset('uploads/photo_profile/'.Session::get('foto'))}}" height="40" width="40" alt="..." />
                                    <span class="avatar-status-online"></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{url('/')}}"><i class="feather icon-home"></i>Home</a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="/logout"><i class="feather icon-power"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @include('layouts.admin.sidebar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @include('layouts.admin.popup');

    <!-- BEGIN: Vendor JS-->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- BEGIN: Analytic -->
    <!-- <script src="theme/app-assets/vendors/js/charts/apexcharts.min.js"></script> -->
    @include('layouts.admin.footer')
    @yield('scripts')
    <script src="{{ asset ('theme/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/extensions/tether.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/extensions/shepherd.min.js') }}"></script>
    <!-- END: Analytic -->
    <script src="{{ asset ('theme/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>



    <!-- datepicker -->
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <!-- <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/flatpickr.min.js') }}"></script> -->
    <!-- <script src="{{ asset('theme/app-assets/vendors/js/pickers/pickadate/form-pickers.js') }}"></script> -->

    <!-- end datepicker -->
    <!-- END: Page Vendor JS-->
    <script src="{{ asset('theme/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @yield('vendor-script')

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset ('theme/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/js/scripts/components.js') }}"></script>
    <!-- <script src="{{ asset('theme/app-assets/js/scripts/extensions/toastr.js') }}"></script> -->

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- BEGIN: Analytic -->
    <!-- <script src="theme/app-assets/js/scripts/pages/dashboard-analytics.js"></script> -->
    <!-- <script src="theme/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script> -->
    <script src="{{ asset ('theme/app-assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/js/scripts/navs/navs.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/js/select2/select2.min.js') }}"></script>

    <!-- <script type="text/javascript" src="{{ asset ('js/jquery/jquery.min.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset ('js/jquery/jquery.js') }}"></script> -->

    <!-- datatble  -->
    <script src="{{ asset ('theme/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset ('theme/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <!-- <script src="{{ asset ('theme/app-assets/vendors/js/tables/datatable/table-datatables-advanced.min.js') }}"></script> -->

    @yield('page-script')
    <script type="text/javascript">
        // $(window).on('load', function() {
        //     if (feather) {
        //         feather.replace({
        //             width: 14,
        //             height: 14
        //         });
        //     }
        // })

        function reloadPage() {
            location.reload();
        }
        $(document).ready(function() {            
            $('.select2').select2({
                placeholder: 'Select an option'
            });           
        });
    </script>
    @yield('add-scripts')
    <!-- END: Page JS-->
    <!-- <script src="{{ asset ('js/service-worker.js') }}"></script> -->
</body>

</html>