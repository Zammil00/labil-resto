<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Pesanan Masuk</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Meja</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesanan as $key => $p): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $p['meja_nomor'] ?></td>
                                    <td>Rp<?= number_format($p['total'], 0, ',', '.') ?></td>
                                    <td> <?php if ($p['status'] == 'menunggu'): ?>
                                            <a href="<?= site_url('chef/pesanan/ubahStatus/' . $p['pesanan_id'] . '/diproses') ?>"
                                                class="btn btn-info btn-sm">Menunggu</a>

                                        <?php elseif ($p['status'] == 'diproses'): ?>
                                            <a href="<?= site_url('chef/pesanan/ubahStatus/' . $p['pesanan_id'] . '/dimasak') ?>"
                                                class="btn btn-warning btn-sm">Proses</a>

                                        <?php elseif ($p['status'] == 'dimasak'): ?>
                                            <a href="<?= site_url('chef/pesanan/ubahStatus/' . $p['pesanan_id'] . '/selesai') ?>"
                                                class="btn btn-success btn-sm">Masak</a>
                                        <?php elseif ($p['status'] == 'Siap'): ?>
                                            <a href="<?= site_url('chef/pesanan/ubahStatus/' . $p['pesanan_id'] . '/selesai') ?>"
                                                class="btn btn-success btn-sm">Selesai</a>
                                        <?php elseif ($p['status'] == 'Selesai'): ?>
                                            <a href="<?= site_url('chef/pesanan/ubahStatus/' . $p['pesanan_id'] . '/selesai') ?>"
                                                class="btn btn-success btn-sm">Siap Antar</a>
                                        <?php endif ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= site_url('chef/pesanan/detail/' . $p['pesanan_id']) ?>"
                                            class="btn btn-primary btn-sm">Detail</a>


                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?= $footer ?>
        </div>
    </div>
</body>