<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\MejaModel;

class Keranjang extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart') ?? [];

        // Ambil data meja
        $mejaModel = new MejaModel();
        $daftarMeja = $mejaModel->where('status', 'kosong')->findAll(); // Atau tanpa filter status

        $data = [
            'title' => 'Keranjang',
            'cart' => $cart,
            'daftarMeja' => $daftarMeja, // <- ini yang penting
            'header' => view('my_template/header', ['title' => 'Keranjang']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/keranjang/index', $data);
    }

    public function hapus($id)
    {
        $cart = session()->get('cart') ?? [];
        unset($cart[$id]);
        session()->set('cart', $cart);
        return redirect()->to('/pelanggan/keranjang')->with('success', 'Item dihapus dari keranjang');
    }

    public function kosongkan()
    {
        session()->remove('cart');
        return redirect()->to('/pelanggan/keranjang')->with('success', 'Keranjang dikosongkan');
    }
}
