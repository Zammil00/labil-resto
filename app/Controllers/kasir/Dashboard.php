<?php
namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{


public function index()
{
    $user = $this->session->get('user');
    if (!$user || $user['user_level'] != 2) {
        $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
        return redirect()->to('/login');
    }

    $pesananModel = new PesananModel();
    $transaksiModel = new TransaksiModel();

    $total_pesanan = $pesananModel->countAllResults();
    $total_transaksi = $transaksiModel->countAllResults();
    $total_pendapatan = $transaksiModel->selectSum('total_bayar')->first()['total_bayar'] ?? 0;

    $recent_transaksi = $transaksiModel
        ->join('pesanan', 'pesanan.pesanan_id = transaksi.pesanan_id')
        ->orderBy('transaksi.created_at', 'DESC')
        ->limit(5)
        ->findAll();

    $data = [
        'title' => 'Dashboard Kasir',
        'header' => view('my_template/header', ['title' => 'Dashboard Kasir']),
        'navbar' => view('my_template/navbar'),
        'sidebar' => view('my_template/sidebar_kasir'),
        'sidebar_kanan' => view('my_template/sidebar_kanan'),
        'footer' => view('my_template/footer'),
        'total_pesanan' => $total_pesanan,
        'total_transaksi' => $total_transaksi,
        'total_pendapatan' => $total_pendapatan,
        'recent_transaksi' => $recent_transaksi,
    ];

    return view('kasir/dashboard', $data);
}

}
