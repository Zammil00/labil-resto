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
                            <h4 class="page-title">Data Menu</h4>
                            <a href="<?= site_url('chef/menu/create') ?>" class="btn btn-primary btn-sm">
                                <i class="uil uil-plus"></i> Tambah Menu
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menu as $m): ?>
                                        <tr>
                                            <td><?= esc($m['nama_menu']) ?></td>
                                            <td><?= esc($m['kategori']) ?></td>
                                            <td>Rp <?= number_format($m['harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($m['foto']): ?>
                                                    <img src="<?= base_url('uploads/menu/' . $m['foto']) ?>" width="80"
                                                        alt="Foto Menu">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif ?>
                                            </td>

                                            <td><?= esc($m['deskripsi']) ?></td>
                                            <td>
                                                <a href="<?= site_url('chef/menu/edit/' . $m['menu_id']) ?>"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="uil uil-edit"></i> Edit
                                                </a>
                                                <a href="<?= site_url('chef/menu/detail/' . $m['menu_id']) ?>"
                                                    class="btn btn-sm btn-info">
                                                    <i class="uil uil-info-circle"></i> Detail
                                                </a>
                                            </td>
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