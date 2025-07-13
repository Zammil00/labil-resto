<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Nik Patel</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <a href="pages-profile.html" class="dropdown-item notify-item">
                        <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                    </a>
                    <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                        <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <!-- <li class="menu-title">Navigation</li> -->
                <li>
                    <a href="<?= site_url('pelanggan/dashboard') ?>">
                        <i data-feather="home"></i>
                        <span> Dashboards Pelanggan </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarPesanan" data-bs-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Daftar Menu </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPesanan">
                        <ul class="nav-second-level">
                            <li><a href="<?= site_url('pelanggan/menu/kategori/makanan') ?>">Makanan</a></li>
                            <li><a href="<?= site_url('pelanggan/menu/kategori/minuman') ?>">Minuman</a></li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#sidebarPembayaran" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Pesanan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPembayaran">
                        <ul class="nav-second-level">
                            <li><a href="/pelanggan/keranjang">Keranjang Pesanan</a></li>
                            <li><a href="/pelanggan/pesanan/riwayat">Status Pesanan</a></li>
                            <!-- <li><a href="project-detail.html">Riwayat Pesanan</a></li> -->
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#sidebarPembayaran" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Pemabayaran </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPembayaran">
                        <ul class="nav-second-level">
                            <!-- <li><a href="/pelanggan/">Bayar</a></li> -->
                            <li><a href="/pelanggan/transaksi/riwayat">Riwayat Transaksi</a></li>
                            <!-- <li><a href="project-detail.html">Riwayat Pesanan</a></li> -->
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Setting</li>

                <li>
                    <a href="ui-elements.html">
                        <i data-feather="package"></i>
                        <span> Notifikasi </span>
                    </a>
                </li>
                <li>
                    <a href="/system/updateprofile">
                        <i data-feather="package"></i>
                        <span> Profile </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>