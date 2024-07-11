<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">

    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">
            <h4 class="ms-1 font-weight-bold text-white">Point Of Sales</h4>
        </a>
    </div>


    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Dashboard
                </h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('dashboard.index') }}">

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>

                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data
                </h6>
            </li>

            @if (Auth::user()->level->nama_level == 'Admin' || Auth::user()->level->nama_level == 'Pimpinan')
                
            <li class="nav-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <span class="nav-link-text ms-1">Data Barang</span>
            </li>

            <div class="collapse" id="collapseExample">
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('barang.index') }}">
                        <span class="nav-link-text ms-1">Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('kategori.index') }}">
                        <span class="nav-link-text ms-1">Kategori Barang</span>
                    </a>
                </li>
            </div>
            @endif

            <li class="nav-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1"
                aria-expanded="false" aria-controls="collapseExample">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <span class="nav-link-text ms-1">Data Penjualan</span>
            </li>

            <div class="collapse" id="collapseExample1">
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('penjualan.index') }}">
                        <span class="nav-link-text ms-1">Penjualan</span>
                    </a>
                </li>
            </div>

            @if (Auth::user()->level->nama_level == 'Admin')
                
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages
                </h6>
            </li>

            <li class="nav-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2"
                aria-expanded="false" aria-controls="collapseExample">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">assignment</i>
                </div>
                <span class="nav-link-text ms-1">Data User</span>
            </li>

            <div class="collapse" id="collapseExample2">
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('user.index') }}">
                        <span class="nav-link-text ms-1">User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('level') }}">
                        <span class="nav-link-text ms-1">Level</span>
                    </a>
                </li>
            </div>
            @endif


        </ul>
    </div>

</aside>
