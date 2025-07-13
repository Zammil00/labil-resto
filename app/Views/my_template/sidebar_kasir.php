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

                <li>
                    <a href="<?= site_url('kasir/dashboard') ?>">
                        <i data-feather="home"></i>
                        <span> Dashboards Kasir </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarPesanan" data-bs-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Pesanan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPesanan">
                        <ul class="nav-second-level">
                            <li><a href="email-inbox.html">Proses</a></li>
                            <li><a href="email-read.html">Selesait</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarPembayaran" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Pembayaran </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPembayaran">
                        <ul class="nav-second-level">
                            <li><a href="/kasir/transaksi/siap-belum-dibayar">Daftar Pembayaran</a></li>
                            <li><a href="/kasir/transaksi/scan">Scan Barcode</a></li>
                            <li><a href="/kasir/transaksi/riwayat">Riwayat Transaksi</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="/kasir/meja">
                        <i data-feather="package"></i>
                        <span> Meja </span>
                    </a>
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