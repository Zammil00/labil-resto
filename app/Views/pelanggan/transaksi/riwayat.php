<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    
    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Riwayat Transaksi</h4>

                    <?php if (empty($transaksi)): ?>
                        <div class="alert alert-info">Belum ada transaksi.</div>
                    <?php else: ?>
                        <?php foreach ($transaksi as $t): ?>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <strong>Transaksi #<?= $t['transaksi_id'] ?></strong> <br>
                                    Meja: <?= esc($t['meja_nomor']) ?><br>
                                    Tanggal: <?= date('d M Y H:i', strtotime($t['created_at'])) ?><br>
                                    Metode: <span class="badge bg-primary"><?= esc(ucfirst($t['metode_pembayaran'])) ?></span>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Menu</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($t['detail'] as $d): ?>
                                                <tr>
                                                    <td><?= esc($d['nama_menu']) ?></td>
                                                    <td><?= $d['qty'] ?></td>
                                                    <td>Rp<?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <strong>Total Bayar: Rp<?= number_format($t['total_bayar'], 0, ',', '.') ?></strong>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
            <?= $footer ?>
        </div>
    </div>
</body>
