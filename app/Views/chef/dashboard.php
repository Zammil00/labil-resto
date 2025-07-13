<!-- LOAD HEADER TEMPLATE -->
<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?= $navbar ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->

        <?= $sidebar ?>
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
                    <!-- stats + charts -->
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="p-3">
                                        <h5 class="card-title header-title mb-0">Overview</h5>
                                    </div>
                                    <!-- Total Menu -->
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $jumlah_menu ?></h4>
                                            <span class="text-muted">Total Menu</span>
                                        </div>
                                        <i data-feather="book-open" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <!-- Total Bahan Baku -->
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $jumlah_bahan ?></h4>
                                            <span class="text-muted">Bahan Baku</span>
                                        </div>
                                        <i data-feather="package" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <!-- Pesanan Masuk -->
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $pesanan_masuk ?></h4>
                                            <span class="text-muted">Pesanan Masuk</span>
                                        </div>
                                        <i data-feather="clipboard" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <!-- Pesanan Selesai -->
                                    <div class="d-flex p-3">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $pesanan_selesai ?></h4>
                                            <span class="text-muted">Pesanan Selesai</span>
                                        </div>
                                        <i data-feather="check-square" class="align-self-center icon-dual icon-md"></i>
                                    </div>

                                    <a href="<?= site_url('/chef/pesanan') ?>" class="p-2 d-block text-end">Lihat
                                        Pesanan <i class="uil-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Slot tambahan grafik / info lainnya -->
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

                    <!-- row -->
                    <!-- products -->
                    <div class="row">
                        <!-- end col-->
                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <a href="" class="btn btn-primary btn-sm float-end">
                                        <i class='uil uil-export me-1'></i> Export
                                    </a>
                                    <h5 class="card-title mt-0 mb-0 header-title">Recent Orders</h5>

                                    <div class="table-responsive mt-4">
                            <table class="table table-hover table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Meja</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_orders as $order): ?>
                                        <tr>
                                            <td>#<?= $order['pesanan_id'] ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                            <td><?= isset($order['meja']) ? esc($order['meja']) : '-' ?></td>

                                            <td>
                                                <?php
                                                $badge = 'secondary';
                                                if ($order['status'] == 'menunggu')
                                                    $badge = 'warning';
                                                elseif ($order['status'] == 'diproses')
                                                    $badge = 'info';
                                                elseif ($order['status'] == 'dimasak')
                                                    $badge = 'primary';
                                                elseif ($order['status'] == 'selesai')
                                                    $badge = 'success';
                                                ?>
                                                <span class="badge bg-<?= $badge ?>"><?= ucfirst($order['status']) ?></span>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('chef/pesanan/detail/' . $order['pesanan_id']) ?>"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>


                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Shreyu theme by <a
                                href="">Coderthemes</a>
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


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->


    <?= $sidebar_kanan ?>
    <?= $footer ?>