<!-- File: app/Views/owner/total_omzet.php -->

<?= $header ?>
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Total Omzet Harian</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Total Omzet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $t): ?>
                            <tr>
                                <td><?= $t['tanggal'] ?></td>
                                <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
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
