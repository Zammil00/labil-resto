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
                        <h4 class="page-title">Riwayat Transaksi</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Meja</th>
                                    <th>Total Bayar</th>
                                    <th>Metode</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi as $t): ?>
                                <tr>
                                    <td><?= esc($t['transaksi_id']) ?></td>
                                    <td><?= esc($t['meja_nomor']) ?></td>
                                    <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.') ?></td>
                                    <td><?= ucfirst($t['metode_pembayaran']) ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($t['created_at'])) ?></td>
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
