@extends('layouts.admin.header')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Beranda
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Beranda</li>
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
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{ $month }}</h2>
                            <p>Total produk tahun ini</p>
                        </div>
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-server text-success font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{$month}}</h2>
                            <p>Total produk bulan ini</p>
                        </div>
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-start pb-0">
                        <div>
                            <h2 class="text-bold-700 mb-0">{{$today}}</h2>
                            <p>Total produk hari ini</p>
                        </div>
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-activity text-danger font-medium-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Produk hari ini</h4>
                        <div class="heading-elements">
                            <a href="{{ route('product.index') }}">Lihat Semua</a>

                        </div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            <table class="table table-hover-animation mb-0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>STATUS</th>
                                        <th>CATEGORI</th>
                                        <th>PRICE</th>
                                        <th>DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($product) > 0)
                                    @foreach($product as $k)
                                    <tr>
                                        <td>
                                            {{$k->name }}
                                        </td>
                                        <td>
                                            <i class="fa fa-circle font-small-3 text-success mr-50"></i>Avalaible
                                        </td>
                                        <td>{{$k->category_name}}</td>
                                        <td>{{$k->price}}</td>
                                        <td>{{ $k->date }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" style="text-align: center;">
                                            <p class="text-warning">Belum ada produuk hari ini.</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('page-script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> -->
<!-- <script src="http://localhost:3001/socket.io/socket.io.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
@endsection

@section('add-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // var socket = new io();
        var connectionOptions = {
            reconnect: true,
            rejectUnauthorized: false,
            secure: false,
            upgrade: false,
            autoconnect: true,
            transports: ["websocket"],
            enabledTransports: ["ws", "wss"],
        };

        // socket.connect('http://localhost:3001', connectionOptions);
        // socket.on('connect', function() {
        //     console.log("connected");
        // });

        // socket.on("connect_error", (e) => {
        //     console.log(e.stack);
        // });


    });
</script>
@endsection