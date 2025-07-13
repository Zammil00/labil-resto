<?= $header ?>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed"}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <h4 class="page-title">Edit Menu: <?= esc($menu['nama_menu']) ?></h4>
                            <a href="<?= site_url('chef/menu') ?>" class="btn btn-secondary btn-sm">
                                <i class="uil uil-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <form method="post" action="<?= site_url('chef/menu/update/' . $menu['menu_id']) ?>"
                        enctype="multipart/form-data">

                        <div class="card">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Menu</label>
                                        <input type="text" name="nama_menu" value="<?= esc($menu['nama_menu']) ?>"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" name="harga" value="<?= esc($menu['harga']) ?>"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="kategori" class="form-select">
                                            <option value="makanan" <?= $menu['kategori'] === 'makanan' ? 'selected' : '' ?>>Makanan</option>
                                            <option value="minuman" <?= $menu['kategori'] === 'minuman' ? 'selected' : '' ?>>Minuman</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi"
                                            class="form-control"><?= esc($menu['deskripsi']) ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Ganti Foto Menu</label>
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                    <?php if ($menu['foto']): ?>
                                        <img src="<?= base_url('uploads/menu/' . $menu['foto']) ?>" alt="Foto Menu"
                                            class="mt-2" width="120">
                                    <?php endif ?>
                                </div>


                                <div class="col-md-6">
                                    <h5 class="mb-3">Gunakan Bahan Baku</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Bahan</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bahan as $b): ?>
                                                <tr>
                                                    <td><?= $b['nama_bahan'] ?> (<?= $b['satuan'] ?>)</td>
                                                    <td>
                                                        <input type="hidden" name="bahan_id[]"
                                                            value="<?= $b['bahan_id'] ?>">
                                                        <input type="number" name="jumlah[]" step="0.01"
                                                            value="<?= $menu_bahan[$b['bahan_id']] ?? 0 ?>"
                                                            class="form-control">
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="uil uil-save"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>

    <?= $sidebar_kanan ?>