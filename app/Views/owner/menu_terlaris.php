<!-- File: app/Views/owner/menu_terlaris.php -->

<?= $header ?>
<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Menu Terlaris</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menu as $m): ?>
                            <tr>
                                <td><?= $m['nama_menu'] ?></td>
                                <td><?= $m['total_terjual'] ?></td>
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
