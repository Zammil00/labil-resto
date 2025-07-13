<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Menu extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        $menuModel = new MenuModel();
        $data = [
            'title' => 'Daftar Menu',
            'menu' => $menuModel->where('is_available', 1)->findAll(),
            'header' => view('my_template/header', ['title' => 'Daftar Menu']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/menu/index', $data);
    }

    public function kategori($kategori)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        // ✅ Update otomatis menu berdasarkan stok
        $updateBahan = new \App\Controllers\System\UpdateBahan();
        $updateBahan->periksaSemuaMenu(); // langsung refresh menu

        // Ambil menu setelah update
        $menuModel = new MenuModel();
        $data = [
            'title' => 'Menu ' . ucfirst($kategori),
            'menu' => $menuModel->where(['is_available' => 1, 'kategori' => $kategori])->findAll(),
            'header' => view('my_template/header', ['title' => 'Menu ' . ucfirst($kategori)]),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/menu/index', $data);
    }

    public function addToCart($id)
    {
        $menuModel = new MenuModel();
        $menu = $menuModel->find($id);
        if (!$menu)
            return redirect()->back()->with('error', 'Menu tidak ditemukan');

        $cart = session()->get('cart') ?? [];

        // Jika sudah ada, tambahkan qty
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $id,
                'nama' => $menu['nama_menu'],
                'harga' => $menu['harga'],
                'qty' => 1,
            ];
        }

        session()->set('cart', $cart);
        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang');
    }


}
