<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4>Keranjang</h4>
                    <?php if (empty($cart)): ?>
                        <p>Keranjang kosong.</p>
                    <?php else: ?>
                        <form action="<?= site_url('pelanggan/pesanan/simpan') ?>" method="post">
                            <!-- Tambahkan di atas tombol submit -->
                            <select name="meja_id" class="form-control mb-3" required>
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($daftarMeja as $meja): ?>
                                    <option value="<?= $meja['meja_id'] ?>">
                                        Meja <?= $meja['nomor_meja'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="hidden" name="meja_nomor" id="meja_nomor" value="">



                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0;
                                    foreach ($cart as $id => $item): ?>
                                        <?php $subtotal = $item['harga'] * $item['qty'];
                                        $total += $subtotal; ?>
                                        <tr>
                                            <td><?= esc($item['nama']) ?></td>
                                            <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                                            <td><?= $item['qty'] ?>
                                                <input type="hidden" name="menu[<?= $id ?>]" value="<?= $item['qty'] ?>">
                                            </td>
                                            <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                                            <td><a href="<?= site_url('pelanggan/keranjang/hapus/' . $id) ?>"
                                                    class="btn btn-danger btn-sm">Hapus</a></td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <p><strong>Total: Rp<?= number_format($total, 0, ',', '.') ?></strong></p>
                            <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                            <a href="<?= site_url('pelanggan/keranjang/kosongkan') ?>" class="btn btn-warning">Kosongkan</a>
                        </form>
                    <?php endif ?>
                </div>
            </div>
            <?= $footer ?>
        </div>
    </div>
</body>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectMeja = document.querySelector('select[name="meja_id"]');
        const inputNomor = document.getElementById('meja_nomor');

        if (selectMeja) {
            selectMeja.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const nomorMeja = selectedOption.textContent.replace('Meja ', '').trim();
                inputNomor.value = nomorMeja;
            });
        }
    });
</script>