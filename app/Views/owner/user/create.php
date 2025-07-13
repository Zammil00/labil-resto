<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light" }, "topbar": {"color": "light"}}'>
<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <h4 class="page-title">Tambah User Baru</h4>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="<?= site_url('owner/user/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= old('nama') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_level" class="form-label">Role</label>
                        <select name="user_level" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="2" <?= old('user_level') == '2' ? 'selected' : '' ?>>Kasir</option>
                            <option value="3" <?= old('user_level') == '3' ? 'selected' : '' ?>>Chef</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('owner/user') ?>" class="btn btn-secondary">Kembali</a>
                </form>

            </div>
        </div>
        <?= $footer ?>
    </div>
</div>
</body>
