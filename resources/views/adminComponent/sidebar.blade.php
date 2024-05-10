<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/user/images/logoLandscape.png') }}" class="w-75">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminDashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Verifikasi
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminMitra') }}">
            <i class="fas fa-fw fa-store"></i>
            <span>Pendaftaran Mitra</span></a>
    </li>     
    @endif

    @if (\Illuminate\Support\Facades\Auth::user()->role_id == 2 && \Illuminate\Support\Facades\Auth::user()->mitra->mitra->status == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminQr') }}">
            <i class="fas fa-fw fa-qrcode"></i>
            <span>Scan Pesanan</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminOrder') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Daftar Pesanan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Toko
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminFood') }}">
            <i class="fa fa-fw fa-utensils"></i>
            <span>Makanan</span></a>
    </li>
    @endif

    @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola Konten
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminNews') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel</span></a>
    </li>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('adminVoucher') }}">
            <i class="fas fa-fw fa-tag"></i>
            <span>Voucer</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
