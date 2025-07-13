<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light"}, "topbar": {"color": "light"}}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <!-- Judul Halaman -->
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="page-title">Tambah Meja</h4>
                    </div>
                </div>

                <!-- Form Tambah -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm border">
                            <div class="card-body">
                                <form action="<?= site_url('kasir/meja/store') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="mb-3">
                                        <label for="nomor_meja" class="form-label">Nomor Meja</label>
                                        <input type="text" id="nomor_meja" name="nomor_meja" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control">
                                    </div>

                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="kosong">Kosong</option>
                                            <option value="digunakan">Digunakan</option>
                                            <option value="reservasi">Reservasi</option>
                                        </select>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-content-save me-1"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?= $footer ?>
    </div>
</div>

<?= $sidebar_kanan ?>
