<!-- LOAD HEADER TEMPLATE -->
<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <!-- Page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard Pelanggan</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="p-3">
                                        <h5 class="card-title header-title mb-0">Ringkasan</h5>
                                    </div>
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $jumlah_menu ?></h4>
                                            <span class="text-muted">Menu Tersedia</span>
                                        </div>
                                        <i data-feather="book-open" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <div class="d-flex p-3 border-bottom">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $jumlah_pesanan ?></h4>
                                            <span class="text-muted">Pesanan Anda</span>
                                        </div>
                                        <i data-feather="clipboard" class="align-self-center icon-dual icon-md"></i>
                                    </div>
                                    <div class="d-flex p-3">
                                        <div class="flex-grow-1">
                                            <h4 class="mt-0 mb-1 fs-22"><?= $jumlah_transaksi ?></h4>
                                            <span class="text-muted">Transaksi Selesai</span>
                                        </div>
                                        <i data-feather="check-circle" class="align-self-center icon-dual icon-md"></i>
                                    </div>

                                    <a href="<?= site_url('/pelanggan/pesanan/riwayat') ?>" class="p-2 d-block text-end">Lihat
                                        Riwayat <i class="uil-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Dummy -->
                        <!-- <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-0 header-title">Grafik Dummy</h5>
                                    <div id="chart-pelanggan" class="apex-charts mt-3" dir="ltr"
                                        style="min-height: 250px;"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <!-- Menu rekomendasi -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title header-title">Rekomendasi Menu</h5>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nama Menu</th>
                                                    <th>Harga</th>
                                                    <th>Kategori</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($menu_rekomendasi as $menu): ?>
                                                    <tr>
                                                        <td><?= esc($menu['nama_menu']) ?></td>
                                                        <td>Rp<?= number_format($menu['harga'], 0, ',', '.') ?></td>
                                                        <td><?= esc($menu['kategori']) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <a href="<?= site_url('/pelanggan/menu') ?>" class="btn btn-sm btn-primary mt-3 float-end">
                                        Lihat Semua Menu
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container -->
            </div> <!-- content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; LabilResto
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="#">Tentang Kami</a>
                                <a href="#">Bantuan</a>
                                <a href="#">Kontak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?= $sidebar_kanan ?>
    <?= $footer ?>
</body>
