<!-- File: app/Views/owner/manajemen_user.php -->

<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Manajemen User</h4>
                    <a href="<?= site_url('owner/user/create') ?>" class="btn btn-primary mb-3">+ Tambah User</a>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $u): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $u['nama'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td>
                                        <?php
                                        switch ($u['user_level']) {
                                            case 1:
                                                echo 'Owner';
                                                break;
                                            case 2:
                                                echo 'Kasir';
                                                break;
                                            case 3:
                                                echo 'Chef';
                                                break;
                                            case 4:
                                                echo 'Pelanggan';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= $u['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Nonaktif</span>' ?>
                                    </td>
                                    <td>
                                        <?php if (!$u['is_active']): ?>
                                            <a href="<?= site_url('owner/user/aktifkan/' . $u['user_id']) ?>"
                                                class="btn btn-sm btn-primary">Aktifkan</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('owner/user/nonaktifkan/' . $u['user_id']) ?>"
                                                class="btn btn-sm btn-danger">Nonaktifkan</a>
                                        <?php endif ?>
                                    </td>
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