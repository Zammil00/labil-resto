<!-- LOAD HEADER TEMPLATE -->
<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?= $navbar ?>
        <!-- end Topbar -->

        <!-- Sidebar Start -->
        <?= $sidebar ?>
        <!-- Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                                <div class="page-title-right">
                                    <form class="float-sm-end mt-3 mt-sm-0">
                                        <div class="row g-2">
                                            <div class="col-md-auto">
                                                <div class="mb-1 mb-sm-0">
                                                    <input type="text" class="form-control" id="dash-daterange"
                                                        style="min-width: 210px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Overview & Chart -->
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="p-3">
                                        <h5 class="card-title header-title mb-0">Overview</h5>
                                    </div>
                                    <!-- Total Pesanan -->
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $total_pesanan ?></h4>
                                            <span class="text-muted">Total Pesanan</span>
                                        </div>
                                        <i data-feather="clipboard" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <!-- Total Transaksi -->
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $total_transaksi ?></h4>
                                            <span class="text-muted">Transaksi</span>
                                        </div>
                                        <i data-feather="shopping-cart" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <!-- Total Pendapatan -->
                                    <div class="d-flex p-3">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22">Rp<?= number_format($total_pendapatan, 0, ',', '.') ?></h4>
                                            <span class="text-muted">Total Pendapatan</span>
                                        </div>
                                        <i data-feather="dollar-sign" class="align-self-center icon-dual icon-md"></i>
                                    </div>

                                    <a href="<?= site_url('/kasir/transaksi') ?>" class="p-2 d-block text-end">
                                        Lihat Transaksi <i class="uil-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Dummy -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-0 header-title">Grafik Dummy</h5>
                                    <div id="revenue-chart" class="apex-charts mt-3" dir="ltr"
                                        style="min-height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transaksi -->
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <a href="<?= site_url('/kasir/transaksi/riwayat') ?>" class="btn btn-primary btn-sm float-end">
                                        <i class='uil uil-export me-1'></i> Lihat Semua
                                    </a>
                                    <h5 class="card-title mt-0 mb-0 header-title">Transaksi Terbaru</h5>

                                    <div class="table-responsive mt-4">
                                        <table class="table table-hover table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Waktu</th>
                                                    <th>Meja</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_transaksi as $trx): ?>
                                                    <tr>
                                                        <td>#<?= $trx['transaksi_id'] ?></td>
                                                        <td><?= date('d/m/Y H:i', strtotime($trx['created_at'])) ?></td>
                                                        <td><?= $trx['meja_nomor'] ?? '-' ?></td>
                                                        <td>Rp<?= number_format($trx['total_bayar'], 0, ',', '.') ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div>

                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Shreyu theme by 
                            <a href="#">Coderthemes</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end content-page -->

    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <?= $sidebar_kanan ?>
    <?= $footer ?>
