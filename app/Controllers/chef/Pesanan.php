<?php

namespace App\Controllers\Chef;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\PesananDetailModel;
use App\Models\MenuModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $pesananModel = new PesananModel();

        $data = [
            'title' => 'Data Pesanan Masuk',
            'pesanan' => $pesananModel
                ->whereIn('status', ['menunggu', 'diproses', 'dimasak']) // hanya yg belum selesai
                ->orderBy('created_at', 'DESC')
                ->findAll(),
            'header' => view('my_template/header', ['title' => 'Data Pesanan Masuk']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/pesanan/index', $data);
    }

    public function selesai()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $pesananModel = new PesananModel();

        $data = [
            'title' => 'Pesanan Selesai',
            'pesanan' => $pesananModel
                ->where('status', 'selesai')
                ->orderBy('created_at', 'DESC')
                ->findAll(),
            'header' => view('my_template/header', ['title' => 'Pesanan Selesai']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/pesanan/selesai', $data);
    }

    public function detail($id)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();
        $menuModel = new MenuModel();

        $pesanan = $pesananModel->find($id);
        $detail = $detailModel->where('pesanan_id', $id)->findAll();

        $data = [
            'title' => 'Detail Pesanan',
            'pesanan' => $pesanan,
            'detail' => $detail,
            'header' => view('my_template/header', ['title' => 'Detail Pesanan']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/pesanan/detail', $data);
    }

    public function ubahStatus($id, $status)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $pesananModel = new PesananModel();

        // Cek apakah pesanan ada
        $pesanan = $pesananModel->find($id);
        if (!$pesanan) {
            $this->session->setFlashdata('error', 'Pesanan tidak ditemukan.');
            return redirect()->back();
        }

        // Update status
        $pesananModel->update($id, ['status' => $status]);

        $this->session->setFlashdata('success', 'Status pesanan berhasil diubah.');
        return redirect()->back();
    }



}
