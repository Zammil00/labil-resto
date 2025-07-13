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
                    <a href="<?= site_url('owner/dashboard') ?>">
                        <i data-feather="home"></i>
                        <span> Dashboards Owner </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarStatistik" data-bs-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Statistik </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarStatistik">
                        <ul class="nav-second-level">
                            <!-- <li><a href="email-inbox.html">Jumlah pesanan</a></li> -->
                            <li><a href="/owner/statistik/total-omzet">Total omzet</a></li>
                            <li><a href="/owner/statistik/menu-terlaris">Menu terlaris</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarLaporan" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Laporan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLaporan">
                        <ul class="nav-second-level">
                            <li><a href="/owner/laporan-transaksi">transaksi per tanggal</a></li>
                            <li><a href="/owner/laporan-stok">stok bahan baku</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarExport" data-bs-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Export </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExport">
                        <ul class="nav-second-level">
                            <li><a href="<?= site_url('owner/export/pdf/omzet-weekly') ?>"
                                    class="btn btn-danger btn-sm mb-2">Export PDF Mingguan</a></li>
                            <li><a href="<?= site_url('owner/export/pdf/omzet-monthly') ?>"
                                    class="btn btn-danger btn-sm mb-2">Export PDF Bulanan</a></li>
                            <li><a href="<?= site_url('owner/export/pdf/omzet-yearly') ?>"
                                    class="btn btn-danger btn-sm mb-2">Export PDF Tahunan</a></li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title mt-2">Manajemen user</li>

                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li><a href="/owner/user">Kelola User</a></li>
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