<h3>Form Pemesanan</h3>

<form action="<?= site_url('pelanggan/pesanan/simpan') ?>" method="post">
    <label>Nomor Meja:</label>
    <input type="text" name="meja" required><br><br>

    <table border="1" cellpadding="5">
        <tr>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
        <?php foreach ($menu as $m): ?>
        <tr>
            <td><?= $m['nama_menu'] ?></td>
            <td><?= number_format($m['harga']) ?></td>
            <td>
                <input type="number" name="menu[<?= $m['menu_id'] ?>]" value="0" min="0">
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <button type="submit">Pesan</button>
</form>
