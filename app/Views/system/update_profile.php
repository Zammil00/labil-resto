<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <h4 class="page-title">Edit Profil</h4>

                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= site_url('system/updateprofile/save') ?>">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" value="<?= esc($user['nama']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak diganti)</small></label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="<?= site_url('system/updateprofile') ?>" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>

    <?= $sidebar_kanan ?>
</body>
