<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light"}, "topbar": {"color": "light"}}'>

    <div id="wrapper">
        <?= $navbar ?>
        <?= $sidebar ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <h4 class="page-title">Tambah Menu Baru</h4>
                            <a href="<?= site_url('chef/menu') ?>" class="btn btn-secondary btn-sm">
                                <i class="uil uil-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= site_url('chef/menu/store') ?>"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="nama_menu" class="form-label">Nama Menu</label>
                                    <input type="text" class="form-control" name="nama_menu" id="nama_menu" required>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="harga" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" name="kategori" id="kategori" required>
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Menu</label>
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                </div>


                                <h5 class="mt-4">Gunakan Bahan Baku</h5>
                                <div class="mb-3">
                                    <label for="bahan-select" class="form-label">Pilih Bahan Baku</label>
                                    <select id="bahan-select" class="form-control" multiple name="bahan[]">
                                        <?php foreach ($bahan as $b): ?>
                                            <option value="<?= $b['bahan_id'] ?>|<?= $b['satuan'] ?>">
                                                <?= esc($b['nama_bahan']) ?> (<?= esc($b['satuan']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div id="bahan-terpilih"></div>


                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="uil uil-save"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <?= $footer ?>
        </div>
    </div>
    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        new TomSelect('#bahan-select', {
            plugins: ['remove_button'],
            placeholder: "Cari dan pilih bahan baku...",
            onItemAdd: function (value) {
                const [id, satuan] = value.split('|');
                if (!document.getElementById('bahan_' + id)) {
                    const html = `
                    <div class="mb-2" id="bahan_${id}">
                        <input type="hidden" name="bahan_id[]" value="${id}">
                        <label>Jumlah untuk ${this.getOption(value).textContent}</label>
                        <input type="number" class="form-control mb-1" name="jumlah[]" step="0.01" min="0" required>
                    </div>`;
                    document.getElementById('bahan-terpilih').insertAdjacentHTML('beforeend', html);
                }
            },
            onItemRemove: function (value) {
                const id = value.split('|')[0];
                const el = document.getElementById('bahan_' + id);
                if (el) el.remove();
            }
        });
    </script>


    <?= $sidebar_kanan ?>