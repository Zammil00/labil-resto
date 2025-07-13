<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">Profil Saya</h4>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif ?>

                    <?php if ($user): ?>
                        <div class="card">
                            <div class="card-body">
                                <p><strong>Nama:</strong> <?= esc($user['nama']) ?></p>
                                <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                                <p><strong>Level:</strong> <?= esc($user['user_level']) ?></p>
                                <a href="<?= site_url('system/updateprofile/edit') ?>" class="btn btn-primary">Edit Profil</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">User tidak ditemukan.</div>
                    <?php endif ?>
                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>

    <?= $sidebar_kanan ?>
</body>
