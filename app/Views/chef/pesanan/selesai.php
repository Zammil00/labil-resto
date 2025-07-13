<?= $header ?>
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Pesanan Selesai</h4>
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
                                    <td><span class="badge bg-success"><?= ucfirst($p['status']) ?></span></td>
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
