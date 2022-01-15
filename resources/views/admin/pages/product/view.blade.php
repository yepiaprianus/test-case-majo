@extends('layouts.admin.header')
<style>
    img {
        max-width: -webkit-fill-available;
    }

    .fs-10 {
        font-size: 10px;
    }
</style>
@section('content')
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
                            <a href="{{ url('product') }}">Product</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
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
    <section class="app-ecommerce-details">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5 mt-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ $data->image }}" alt="product-image">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h5>{{ $data->name }}</h5>
                        <div class="ecommerce-details-price d-flex flex-wrap">
                            <p class="text-dark font-x-small-3 mr-1 mb-0 fs-10">{{ $data->created_at }}</p>
                        </div>
                        <hr>
                        <?= $data->description ?>
                        <hr>
                        <p class="fs-10" style="font-size: 10px;">
                            Available <span class="text-success">in stock</span>
                        </p>
                        <div class="d-flex flex-column flex-sm-row">
                            <button class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">
                                <i class="feather icon-shopping-cart mr-25"></i>{{ $data->category_name }}
                            </button>
                            <button class="btn btn-outline-danger waves-effect waves-light">
                                <i class="feather icon-star"></i>
                                {{ "Rp " . number_format($data->price, 0, ",", ".") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@section('add-scripts')
<script type="text/javascript">
    function backtoProduct() {
        location.href = "{{ URL::to('product') }}";
    }
</script>
@endsection