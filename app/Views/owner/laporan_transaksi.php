<!-- File: app/Views/owner/laporan_transaksi.php -->

<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Laporan Transaksi</h4>

                    <form method="get" class="mb-3">
                        <input type="date" name="tanggal" value="<?= $tanggal ?>" class="form-control" />
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>
                                <th>Metode</th>
                                <th>Kasir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $i => $t): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $t['created_at'] ?></td>
                                    <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.') ?></td>
                                    <td><?= ucfirst($t['metode_pembayaran']) ?></td>
                                    <td><?= $t['kasir'] ?? '-' ?></td>
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