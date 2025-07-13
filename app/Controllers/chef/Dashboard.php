<?php
namespace App\Controllers\Chef;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\BahanBakuModel;
use App\Models\PesananModel;
use App\Models\PesananDetailModel;


class Dashboard extends BaseController  
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $menuModel = new MenuModel();
        $bahanModel = new BahanBakuModel();
        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();

        // Ambil 5 pesanan terakhir
        $recentOrders = $pesananModel
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title' => 'Dashboard Chef',
            'jumlah_menu' => $menuModel->countAll(),
            'jumlah_bahan' => $bahanModel->countAll(),
            'pesanan_masuk' => $pesananModel->whereIn('status', ['menunggu', 'diproses', 'dimasak'])->countAllResults(),
            'pesanan_selesai' => $pesananModel->where('status', 'selesai')->countAllResults(),
            'recent_orders' => $recentOrders,

            'header' => view('my_template/header', ['title' => 'Dashboard Chef']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/dashboard', $data);
    }


}
