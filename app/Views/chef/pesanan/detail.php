<?= $header ?>
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4>Detail Pesanan Meja <?= $pesanan['meja_nomor'] ?></h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                                <tr>
                                    <td><?= (new \App\Models\MenuModel())->find($d['menu_id'])['nama_menu'] ?? 'Tidak ditemukan' ?></td>
                                    <td><?= $d['qty'] ?></td>
                                    <td>Rp<?= number_format($d['subtotal'], 0, ',', '.') ?></td>
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
