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
                        <h4 class="page-title">Pesanan Siap Tapi Belum Dibayar</h4>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Nomor Meja</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($pesanan)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada pesanan menunggu pembayaran.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($pesanan as $p): ?>
                                    <tr>
                                        <td><?= esc($p['pesanan_id']) ?></td>
                                        <td><?= esc($p['meja_nomor']) ?></td>
                                        <td>Rp <?= number_format($p['total'], 0, ',', '.') ?></td>
                                        <td>
                                            <a href="<?= site_url('kasir/transaksi/view/' . $p['pesanan_id']) ?>" class="btn btn-sm btn-success">
                                                <i class="uil uil-credit-card"></i> Bayar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
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
