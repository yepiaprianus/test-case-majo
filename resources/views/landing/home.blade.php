<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Majo Teknologi Indonesia</title>
    <meta content="test case majo" name="description">
    <meta content="majo,developer" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('images/logo/paket-desktop.png') }}" rel="icon">
    <!-- <link href="{{ asset('landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('landing/assets/css/style.css') }}" rel="stylesheet">
    <style>
        .dsecription {
            font-size: 12px;
            text-align: left;
            min-height: 200px;
        }

        .min-h200 {
            min-height: 200px;
            max-height: 200px;
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="{{url('/')}}">Majo Teknologi Indonesia</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    @if($login)
                    <li><a class="getstarted scrollto" href="{{ url('beranda') }}">Dashboard</a></li>
                    @else
                    <li><a class="getstarted scrollto" href="{{ url('login') }}">Login</a></li>
                    @endif                    
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h1>Better Solutions For Your Business</h1>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#pricing" class="btn-get-started scrollto">Get Started</a>
                        <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{asset('landing/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= Pricing Section ======= -->
        <section id="pricing" class="pricing">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Produk</h2>
                </div>
                @foreach($data->chunk(4) as $chunk)
                <div class="row">
                    @foreach($chunk as $product)
                    <div class="col-lg-3 mt-4 mt-lg-0 align-items-center justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="box featured" style="padding-top: 5px; text-align: center;">
                            <img src="{{ $product->image }}" class="img-fluid min-h200" alt="">
                            <h6 class="mt-2">{{ $product->name }}</h6>
                            <h5> <sup>Rp.</sup>
                                {{ number_format($product->price, 0, ",", ".") }}
                            </h5>
                            <div class="dsecription mb-2">
                                <?= $product->description ?>
                            </div>
                            <a href="javascript:void(0);" class="buy-btn">Beli</a>
                        </div>
                    </div>
                    @endforeach

                    <!-- <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                        <div class="box featured">
                            <h3>Business Plan</h3>
                            <h4><sup>$</sup>29<span>per month</span></h4>
                            <ul>
                                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                            </ul>
                            <a href="#" class="buy-btn">Get Started</a>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="box">
                            <h3>Developer Plan</h3>
                            <h4><sup>$</sup>49<span>per month</span></h4>
                            <ul>
                                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                            </ul>
                            <a href="#" class="buy-btn">Get Started</a>
                        </div>
                    </div> -->

                </div>
                @endforeach
            </div>
        </section><!-- End Pricing Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>Majo</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="{{url('/')}}">Yepi</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing/assets/js/main.js') }}"></script>
</body>

</html>