<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light"}, "topbar": {"color": "light"}}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="page-title">Pembayaran Pesanan</h4>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm border">
                            <div class="card-body">

                                <p><strong>No Meja:</strong> <?= esc($pesanan['meja_nomor']) ?></p>
                                <p><strong>Total:</strong> Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></p>

                                <div class="table-responsive mb-4">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-light">
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
                                                <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>

                                <form method="post" action="<?= site_url('/kasir/transaksi/simpan') ?>">
                                    <input type="hidden" name="pesanan_id" value="<?= $pesanan['pesanan_id'] ?>">
                                    <input type="hidden" name="total_bayar" value="<?= $pesanan['total'] ?>">

                                    <div class="mb-3">
                                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                                            <option value="cash">Cash</option>
                                            <option value="qris">QRIS</option>
                                            <option value="transfer">Transfer</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">Selesaikan Pembayaran</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?= $footer ?>
    </div>
</div>

<?= $sidebar_kanan ?>
