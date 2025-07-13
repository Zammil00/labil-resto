<!-- File: app/Views/owner/dashboard.php -->

<?= $header ?>
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Dashboard Owner</h4>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5>Jumlah Pesanan</h5>
                                <h3><?= $jumlah_pesanan ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5>Total Omzet</h5>
                                <h3>Rp <?= number_format($total_omzet, 0, ',', '.') ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5>Menu Terlaris</h5>
                                <h4><?= $menu_terlaris['nama_menu'] ?? '-' ?> (<?= $menu_terlaris['total_terjual'] ?? 0 ?>)</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $footer ?>
    </div>
</div>
</body>
