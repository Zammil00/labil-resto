<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Validasi sesi login
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        $userId = $user['user_id'];

        // Model
        $menuModel = new MenuModel();
        $pesananModel = new PesananModel();
        $transaksiModel = new TransaksiModel();

        // Data ringkasan
        $jumlah_menu = $menuModel->where('is_available', 1)->countAllResults();
        $jumlah_pesanan = $pesananModel->where('user_id', $userId)->countAllResults();

        $pesananIds = $pesananModel->where('user_id', $userId)->findColumn('pesanan_id');
        $jumlah_transaksi = 0;
        if ($pesananIds) {
            $jumlah_transaksi = $transaksiModel
                ->whereIn('pesanan_id', $pesananIds)
                ->countAllResults();
        }

        // Menu rekomendasi (contoh: 5 menu dengan harga tertinggi)
        $menu_rekomendasi = $menuModel
            ->where('is_available', 1)
            ->orderBy('harga', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => 'Dashboard Pelanggan',
            'jumlah_menu' => $jumlah_menu,
            'jumlah_pesanan' => $jumlah_pesanan,
            'jumlah_transaksi' => $jumlah_transaksi,
            'menu_rekomendasi' => $menu_rekomendasi,

            // Layout
            'header' => view('my_template/header', ['title' => 'Dashboard Pelanggan']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/dashboard', $data);
    }
}
