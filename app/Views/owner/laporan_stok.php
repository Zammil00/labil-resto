<!-- File: app/Views/owner/laporan_stok.php -->

<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Stok Bahan Baku</h4>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Bahan</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bahan as $i => $b): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $b['nama_bahan'] ?></td>
                                    <td><?= $b['stok'] ?></td>
                                    <td><?= $b['satuan'] ?></td>
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