<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <h4 class="page-title">Daftar Menu</h4>

                    <div class="row">
                        <?php
                        $bahanModel = new \App\Models\BahanBakuModel();
                        $menuBahanModel = new \App\Models\MenuBahanModel();
                        ?>

                        <?php foreach ($menu as $m): ?>
                            <?php
                            $bahanList = $menuBahanModel->where('menu_id', $m['menu_id'])->findAll();
                            $stokCukup = true;
                            foreach ($bahanList as $b) {
                                $stok = $bahanModel->find($b['bahan_id'])['stok'] ?? 0;
                                if ($stok < $b['jumlah']) {
                                    $stokCukup = false;
                                    break;
                                }
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="card shadow-sm mb-3">
                                    <?php if ($m['foto']): ?>
                                        <img src="<?= base_url('uploads/menu/' . $m['foto']) ?>" class="card-img-top"
                                            style="height:200px; object-fit:cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                                    <?php endif ?>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= esc($m['nama_menu']) ?></h5>
                                        <p class="card-text text-muted"><?= esc($m['deskripsi']) ?></p>
                                        <p class="text-primary fs-5 fw-semibold">
                                            Rp<?= number_format($m['harga'], 0, ',', '.') ?></p>
                                        <span class="badge bg-secondary mb-2"><?= ucfirst($m['kategori']) ?></span>
                                        <div class="mt-2">
                                            <?php if ($stokCukup): ?>
                                                <a href="<?= site_url('pelanggan/menu/add/' . $m['menu_id']) ?>"
                                                    class="btn btn-success btn-sm w-100">
                                                    <i class="mdi mdi-cart-plus"></i> Masuk Keranjang
                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-danger w-100 py-2">Stok Bahan Habis</span>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                                                


                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>
</body>