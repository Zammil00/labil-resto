<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4>Status Pesanan Saya</h4>

                    <?php foreach ($pesananList as $p): ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <strong>Pesanan #<?= $p['pesanan_id'] ?></strong><br>
                                Meja: <?= esc($p['meja_nomor']) ?> <br>
                                Status: <span class="badge bg-info"><?= esc(ucwords($p['status'])) ?></span>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered mb-2">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($p['detail'] as $d): ?>
                                            <tr>
                                                <td><?= esc($d['nama_menu']) ?></td>
                                                <td><?= esc($d['qty']) ?></td>
                                                <td>Rp<?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

                                <strong>Total: Rp<?= number_format($p['total'], 0, ',', '.') ?></strong>

                                <?php if ($p['status'] == 'selesai' && !$p['sudah_dibayar']): ?>
                                    <div class="mt-2">
                                        <a href="<?= site_url('/pelanggan/pesanan/struk/' . $p['pesanan_id']) ?>"
                                            class="btn btn-primary btn-sm">
                                            Bayar & Cetak Struk
                                        </a>
                                    </div>
                                <?php elseif ($p['status'] == 'selesai' && $p['sudah_dibayar']): ?>
                                    <div class="mt-2 text-success fw-bold">
                                        ✅ Transaksi Selesai
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>

            </div>

            <?= $footer ?>
        </div>
    </div>
</body>