<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/beranda">
                    <!-- <div class="brand-logo"></div>  -->
                    <h2 class="brand-text mb-0">MAJO</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::path() === 'beranda' ? 'active' : ''}}">
                <a href="{{ URL::to('/beranda') }}"> <i class="feather icon-home"></i><span class="menu-title">Beranda</span></a>
            </li>
            <li class="{{ Request::path() === 'category' ? 'active' : ''}} {{ (request()->is('category/*')) ? 'active' : '' }}">
                <a href="{{ URL::to('/category') }}"><i class="feather icon-slack"></i> <span class="men-title">Kategori</span></a>
            </li>
            <li class="{{ Request::path() === 'users' ? 'active' : ''}} {{ (request()->is('users/*')) ? 'active' : '' }}">
                <a href="{{ URL::to('/users') }}"> <i class="feather icon-users"></i> <span class="menu-title">User</span></a>
            </li>
            <li class="{{ Request::path() === 'product' ? 'active' : ''}} {{ (request()->is('product/*')) ? 'active' : '' }}">
                <a href="{{ route('product.index') }}"><i class="feather icon-shopping-cart"></i><span class="menu-item">Produk</span></a>
            </li>
            <li class="{{ Request::path() === 'ganti_password' ? 'active' : ''}}">
                <a href="{{ URL::to('ganti_password') }}"><i class="feather icon-lock"></i><span class="menu-title">Ganti Kata Sandi</span></a>
            </li>
            <li class="">
                <a href="/logout"><i class="feather icon-power"></i><span class="menu-title">Keluar</span></a>
            </li>
        </ul>
    </div>
</div>