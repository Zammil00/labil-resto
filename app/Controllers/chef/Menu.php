<?php

namespace App\Controllers\Chef;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\BahanBakuModel;
use App\Models\MenuBahanModel;

class Menu extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $menuModel = new MenuModel();

        $data = [
            'title' => 'Data Menu',
            'menu' => $menuModel->findAll(),
            'header' => view('my_template/header', ['title' => 'Data Menu']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/menu/index', $data);
    }

    public function create()
    {
        $bahanModel = new BahanBakuModel();

        $data = [
            'title' => 'Tambah Menu',
            'bahan' => $bahanModel->findAll(),
            'header' => view('my_template/header', ['title' => 'Tambah Menu']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/menu/create', $data);
    }

    public function store()
    {
        $menuModel = new MenuModel();
        $menuBahanModel = new MenuBahanModel();
        $foto = $this->request->getFile('foto');
        $namaFoto = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/menu/', $namaFoto); // pastikan folder ini ada
        }
        // Simpan menu
        $menuData = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'harga' => $this->request->getPost('harga'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $namaFoto
        ];
        $menuModel->insert($menuData);
        $menuId = $menuModel->insertID();

        // Simpan bahan terkait
        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlahs = $this->request->getPost('jumlah');

        foreach ($bahan_ids as $index => $bahan_id) {
            if ($jumlahs[$index] > 0) {
                $menuBahanModel->insert([
                    'menu_id' => $menuId,
                    'bahan_id' => $bahan_id,
                    'jumlah' => $jumlahs[$index],
                ]);
            }
        }

        return redirect()->to('/chef/menu')->with('msg', 'Menu berhasil ditambahkan');
    }

    public function edit($id)
    {
        $menuModel = new MenuModel();
        $bahanModel = new BahanBakuModel();
        $menuBahanModel = new MenuBahanModel();

        $menu = $menuModel->find($id);
        if (!$menu) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Menu tidak ditemukan");
        }

        $menu_bahan = [];
        $relasi = $menuBahanModel->where('menu_id', $id)->findAll();
        foreach ($relasi as $item) {
            $menu_bahan[$item['bahan_id']] = $item['jumlah'];
        }

        $data = [
            'title' => 'Edit Menu',
            'menu' => $menu,
            'bahan' => $bahanModel->findAll(),
            'menu_bahan' => $menu_bahan,
            'header' => view('my_template/header', ['title' => 'Edit Menu']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/menu/edit', $data);
    }

    public function update($id)
    {
        $menuModel = new MenuModel();
        $menuBahanModel = new MenuBahanModel();
        $menu = $menuModel->find($id);
        $foto = $this->request->getFile('foto');
        $namaFoto = $menu['foto']; // gunakan foto lama
        // Update data menu

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaBaru = $foto->getRandomName();
            $foto->move('uploads/menu/', $namaBaru);
            $namaFoto = $namaBaru;

            // hapus foto lama jika ada
            if ($menu['foto'] && file_exists('uploads/menu/' . $menu['foto'])) {
                unlink('uploads/menu/' . $menu['foto']);
            }
        }
        $menuData = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'harga' => $this->request->getPost('harga'),
            'kategori' => $this->request->getPost('kategori'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $namaFoto
        ];
        $menuModel->update($id, $menuData);

        // Hapus dan insert ulang relasi bahan
        $menuBahanModel->where('menu_id', $id)->delete();

        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlahs = $this->request->getPost('jumlah');

        foreach ($bahan_ids as $index => $bahan_id) {
            if ($jumlahs[$index] > 0) {
                $menuBahanModel->insert([
                    'menu_id' => $id,
                    'bahan_id' => $bahan_id,
                    'jumlah' => $jumlahs[$index],
                ]);
            }
        }

        return redirect()->to('/chef/menu')->with('msg', 'Menu berhasil diperbarui');
    }

    public function detail($id)
    {
        $menuModel = new MenuModel();
        $bahanModel = new BahanBakuModel();
        $menuBahanModel = new MenuBahanModel();

        $menu = $menuModel->find($id);
        if (!$menu) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Menu tidak ditemukan");
        }

        // Ambil relasi bahan + detail bahan
        $relasi = $menuBahanModel
            ->join('bahan_baku', 'bahan_baku.bahan_id = menu_bahan.bahan_id')
            ->where('menu_id', $id)
            ->select('bahan_baku.nama_bahan, bahan_baku.satuan, menu_bahan.jumlah')
            ->findAll();

        $data = [
            'title' => 'Detail Menu',
            'menu' => $menu,
            'bahan_terpakai' => $relasi,
            'header' => view('my_template/header', ['title' => 'Detail Menu']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/menu/detail', $data);
    }

}
