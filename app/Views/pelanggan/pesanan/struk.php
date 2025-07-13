<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <h4 class="page-title">Struk Pembayaran</h4>

                    <div class="card">
                        <div class="card-header">
                            <strong>Pesanan #<?= $pesanan['pesanan_id'] ?></strong><br>
                            Meja: <?= esc($pesanan['meja_nomor']) ?><br>
                            Status: <span class="badge bg-info"><?= esc(ucwords($pesanan['status'])) ?></span>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-3">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail as $d): ?>
                                        <tr>
                                            <td><?= esc($d['nama_menu']) ?></td>
                                            <td><?= esc($d['qty']) ?></td>
                                            <td>Rp<?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                            <h5 class="fw-bold">Total: Rp<?= number_format($pesanan['total'], 0, ',', '.') ?></h5>

                            <div class="mt-4 text-center">
                                <p class="mb-2"><strong>Scan QR ini di kasir untuk pembayaran:</strong></p>
                                <img src="data:image/png;base64,<?= $qr_code ?>" width="250" height="250"
                                    alt="QR Code Pembayaran" class="img-fluid">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <?= $footer ?>
        </div>
    </div>
</body>