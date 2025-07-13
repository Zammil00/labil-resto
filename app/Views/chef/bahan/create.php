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
                            <div class="page-title-box d-flex justify-content-between align-items-center">
                                <h4 class="page-title">Tambah Bahan Baku</h4>
                                <a href="<?= site_url('chef/bahan') ?>" class="btn btn-secondary btn-sm">
                                    <i class="uil uil-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="<?= site_url('chef/bahan/store') ?>">
                                        <div class="mb-3">
                                            <label for="nama_bahan" class="form-label">Nama Bahan</label>
                                            <input type="text" class="form-control" id="nama_bahan" name="nama_bahan"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="satuan" class="form-label">Satuan</label>
                                            <select class="form-select" id="satuan" name="satuan" required>
                                                <option value="" disabled selected>Pilih satuan</option>
                                                <option value="pcs">pcs</option>
                                                <option value="bungkus">bungkus</option>
                                                <option value="botol">botol</option>
                                                <option value="gram">gram</option>
                                                <option value="mililiter">mililiter</option>
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label for="stok" class="form-label">Stok Awal</label>
                                            <input type="number" step="0.01" class="form-control" id="stok" name="stok"
                                                required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="uil uil-save"></i> Simpan
                                        </button>
                                    </form>
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
                                <a href="#">About</a>
                                <a href="#">Help</a>
                                <a href="#">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <?= $sidebar_kanan ?>
    <?= $footer ?>