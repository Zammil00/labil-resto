<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light"}, "topbar": {"color": "light"}}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <h4 class="page-title">Detail Menu: <?= esc($menu['nama_menu']) ?></h4>
                            <a href="<?= site_url('chef/menu') ?>" class="btn btn-secondary btn-sm">
                                <i class="uil uil-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5>Deskripsi</h5>
                            <p><?= esc($menu['deskripsi']) ?></p>

                            <h5 class="mt-4">Bahan Baku yang Digunakan</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Bahan</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bahan_terpakai as $b): ?>
                                        <tr>
                                            <td><?= esc($b['nama_bahan']) ?></td>
                                            <td><?= esc($b['jumlah']) ?></td>
                                            <td><?= esc($b['satuan']) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>

    <?= $sidebar_kanan ?>
</body>