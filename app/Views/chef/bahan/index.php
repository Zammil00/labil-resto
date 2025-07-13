<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title">Data Bahan Baku</h4>
                                <div class="page-title-right">
                                    <a href="<?= site_url('chef/bahan/create') ?>" class="btn btn-primary btn-sm">
                                        <i class="uil uil-plus"></i> Tambah Bahan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Stok</th>
                                                    <th>Satuan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($bahan as $b): ?>
                                                    <tr>
                                                        <td><?= esc($b['nama_bahan']) ?></td>
                                                        <td><?= esc($b['stok']) ?></td>
                                                        <td><?= esc($b['satuan']) ?></td>
                                                        <td>
                                                            <a href="<?= site_url('chef/bahan/edit/' . $b['bahan_id']) ?>"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="uil uil-edit"></i> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->

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
                                <a href="javascript:void(0);">About</a>
                                <a href="javascript:void(0);">Support</a>
                                <a href="javascript:void(0);">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- content-page -->

    </div> <!-- wrapper -->

    <?= $sidebar_kanan ?>
    <?= $footer ?>