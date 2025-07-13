<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\TransaksiModel;
use App\Models\PesananDetailModel;
use App\Models\MenuModel;
// Tambahkan ini di bagian atas controller
use App\Controllers\System\UpdateMeja;


class Transaksi extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new PesananModel();
        $pesanan = $model->where('status', 'siap')->findAll();

        $data = [
            'title' => 'Transaksi Kasir',
            'pesanan' => $pesanan,
            'header' => view('my_template/header', ['title' => 'Transaksi Kasir']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/index', $data);
    }

    public function bayar($id)
    {
        $pesananModel = new PesananModel();
        $pesanan = $pesananModel->find($id);

        $data = [
            'title' => 'Bayar Pesanan',
            'pesanan' => $pesanan,
            'header' => view('my_template/header', ['title' => 'Bayar Pesanan']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/bayar', $data);
    }
    public function siapBelumDibayar()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $pesananModel = new PesananModel();

        // Ambil semua pesanan status "siap" tapi belum masuk ke tabel transaksi
        $pesanan = $pesananModel
            ->select('pesanan.*')
            ->where('status', 'siap')
            ->whereNotIn('pesanan_id', function ($builder) {
                return $builder->select('pesanan_id')->from('transaksi');
            })
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Pesanan Siap Belum Dibayar',
            'pesanan' => $pesanan,
            'header' => view('my_template/header', ['title' => 'Pesanan Siap Belum Dibayar']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/siap_belum_dibayar', $data);
    }


    public function view($id)
    {
        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();
        $menuModel = new MenuModel();

        $pesanan = $pesananModel->find($id);
        if (!$pesanan) {
            return redirect()->to('/kasir/transaksi')->with('error', 'Pesanan tidak ditemukan.');
        }

        $details = $detailModel->where('pesanan_id', $id)->findAll();
        foreach ($details as &$d) {
            $menu = $menuModel->find($d['menu_id']);
            $d['nama_menu'] = $menu['nama_menu'] ?? '(menu tidak ditemukan)';
        }

        $data = [
            'title' => 'Pembayaran',
            'pesanan' => $pesanan,
            'detail' => $details,
            'header' => view('my_template/header', ['title' => 'Pembayaran']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/bayar', $data);
    }

    public function scan()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Scan Pembayaran',
            'header' => view('my_template/header', ['title' => 'Scan QR']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/scan', $data);
    }


    public function simpan()
    {
        $model = new TransaksiModel();
        $pesananModel = new PesananModel();

        $data = [
            'pesanan_id' => $this->request->getPost('pesanan_id'),
            'kasir_id' => session()->get('user')['user_id'] ?? null,
            'total_bayar' => $this->request->getPost('total_bayar'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
        ];

        // Simpan transaksi
        $model->insert($data);

        // Update status pesanan jadi selesai
        $pesananModel->update($data['pesanan_id'], ['status' => 'selesai']);

        // Update status meja jadi kosong
        $updateMeja = new UpdateMeja();
        $updateMeja->tandaiKosongDariPesanan($data['pesanan_id']);

        return redirect()->to('/kasir/transaksi')->with('msg', 'Transaksi berhasil');
    }


    public function riwayat()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $transaksiModel = new TransaksiModel();
        $pesananModel = new PesananModel();

        // Ambil transaksi + relasi pesanan
        $transaksiList = $transaksiModel
            ->select('transaksi.*, pesanan.meja_nomor')
            ->join('pesanan', 'pesanan.pesanan_id = transaksi.pesanan_id')
            ->orderBy('transaksi.created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Riwayat Transaksi',
            'transaksi' => $transaksiList,
            'header' => view('my_template/header', ['title' => 'Riwayat Transaksi']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('kasir/transaksi/riwayat', $data);
    }

}
