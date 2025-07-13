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
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h4 class="page-title">Kelola Meja</h4>
                        <a href="<?= site_url('kasir/meja/create') ?>" class="btn btn-primary">
                            <i class="mdi mdi-plus-circle me-1"></i> Tambah Meja
                        </a>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="card shadow-sm border">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($meja as $key => $m): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($m['nomor_meja']) ?></td>
                                        <td><?= esc($m['keterangan']) ?></td>
                                        <td>
                                            <?php if ($m['status'] == 'kosong'): ?>
                                                <span class="badge bg-success">Kosong</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"><?= esc(ucfirst($m['status'])) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('kasir/meja/edit/' . $m['meja_id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="<?= site_url('kasir/meja/delete/' . $m['meja_id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus meja ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="mdi mdi-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?= $footer ?>
    </div>
</div>

<?= $sidebar_kanan ?>
