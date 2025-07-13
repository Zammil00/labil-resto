<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\PesananDetailModel;
use App\Models\MenuBahanModel;
use App\Models\BahanBakuModel;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Pesanan extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        return redirect()->to('/pelanggan/keranjang');
    }

    public function simpan()
    {
        $request = service('request');
        $cart = session()->get('cart');
        $mejaId = $request->getPost('meja_id');
        $mejaNomor = $request->getPost('meja_nomor');

        $user = $this->session->get('user');
        $userId = $user['user_id'] ?? null;

        if (!$mejaId || !$mejaNomor || !$userId || !$cart) {
            return redirect()->back()->with('error', 'Data pesanan tidak lengkap.');
        }

        $menuModel = new MenuModel();
        $menuBahanModel = new MenuBahanModel();
        $bahanModel = new BahanBakuModel();

        // 🔍 CEK APAKAH SEMUA STOK CUKUP
// 🔍 CEK STOK TOTAL SEMUA BAHAN dari seluruh keranjang
        $bahanTotal = []; // ['bahan_id' => total_qty_butuh]

        foreach ($cart as $menuId => $item) {
            $qty = $item['qty'];
            $bahanList = $menuBahanModel->where('menu_id', $menuId)->findAll();

            foreach ($bahanList as $bahan) {
                $bahanId = $bahan['bahan_id'];
                $butuh = $bahan['jumlah'] * $qty;

                if (isset($bahanTotal[$bahanId])) {
                    $bahanTotal[$bahanId] += $butuh;
                } else {
                    $bahanTotal[$bahanId] = $butuh;
                }
            }
        }

        // Sekarang cek apakah semua bahan mencukupi
        foreach ($bahanTotal as $bahanId => $totalButuh) {
            $stok = $bahanModel->find($bahanId)['stok'] ?? 0;
            if ($stok < $totalButuh) {
                $namaBahan = $bahanModel->find($bahanId)['nama_bahan'] ?? '(bahan tidak diketahui)';
                return redirect()->back()->with('error', "Stok bahan '$namaBahan' tidak mencukupi. Dibutuhkan $totalButuh, tersedia $stok.");
            }
        }


        // ✅ JIKA STOK AMAN, LANJUTKAN PEMESANAN
        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();
        $total = 0;

        $pesananModel->insert([
            'user_id' => $userId,
            'meja_nomor' => $mejaNomor,
            'meja_id' => $mejaId,
            'status' => 'menunggu',
        ]);
        $pesananId = $pesananModel->insertID();

        // Update status meja
        $updateMeja = new \App\Controllers\System\UpdateMeja();
        $updateMeja->tandaiDigunakan($mejaId);

        $updateBahan = new \App\Controllers\System\UpdateBahan();

        foreach ($cart as $menuId => $item) {
            $qty = $item['qty'];
            $menu = $menuModel->find($menuId);
            if (!$menu || $qty <= 0)
                continue;

            $subtotal = $menu['harga'] * $qty;
            $total += $subtotal;

            $detailModel->insert([
                'pesanan_id' => $pesananId,
                'menu_id' => $menuId,
                'qty' => $qty,
                'subtotal' => $subtotal,
            ]);

            $updateBahan->kurangiStok($menuId, $qty);
        }

        $pesananModel->update($pesananId, ['total' => $total]);
        session()->remove('cart');

        return redirect()->to('/pelanggan/pesanan/riwayat')->with('msg', 'Pesanan berhasil dikirim!');
    }



    public function riwayat()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        $userId = $user['user_id'];

        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();
        $menuModel = new MenuModel();
        $transaksiModel = new \App\Models\TransaksiModel();

        $pesananList = $pesananModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($pesananList as &$pesanan) {
            // Tambahkan flag apakah sudah dibayar
            $transaksi = $transaksiModel->where('pesanan_id', $pesanan['pesanan_id'])->first();
            $pesanan['sudah_dibayar'] = $transaksi ? true : false;

            $details = $detailModel->where('pesanan_id', $pesanan['pesanan_id'])->findAll();
            foreach ($details as &$d) {
                $menu = $menuModel->find($d['menu_id']);
                $d['nama_menu'] = $menu['nama_menu'] ?? '(menu tidak ditemukan)';
            }
            $pesanan['detail'] = $details;
        }

        $data = [
            'title' => 'Status Pesanan',
            'pesananList' => $pesananList,
            'header' => view('my_template/header', ['title' => 'Status Pesanan']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/pesanan/riwayat', $data);
    }


    public function struk($id)
    {
        $pesananModel = new \App\Models\PesananModel();
        $detailModel = new \App\Models\PesananDetailModel();
        $menuModel = new \App\Models\MenuModel();

        $pesanan = $pesananModel->find($id);
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        $detail = $detailModel->where('pesanan_id', $id)->findAll();
        foreach ($detail as &$d) {
            $menu = $menuModel->find($d['menu_id']);
            $d['nama_menu'] = $menu['nama_menu'] ?? '-';
        }

        // QR code
        $qrCode = new QrCode((string) $id); // isi ID pesanan
        $writer = new PngWriter();
        $qrOutput = base64_encode($writer->write($qrCode)->getString());

        $data = [
            'pesanan' => $pesanan,
            'detail' => $detail,
            'qr_code' => $qrOutput,
            'title' => 'Struk Pembayaran',
            'header' => view('my_template/header', ['title' => 'Struk Pembayaran']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/pesanan/struk', $data);

    }


    public function riwayatTransaksi()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 4) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Pelanggan.');
            return redirect()->to('/login');
        }

        $userId = $user['user_id'];

        $transaksiModel = new \App\Models\TransaksiModel();
        $pesananModel = new \App\Models\PesananModel();
        $detailModel = new \App\Models\PesananDetailModel();
        $menuModel = new \App\Models\MenuModel();

        // Ambil transaksi yang terkait dengan pesanan milik pelanggan ini
        $pesananIds = $pesananModel->where('user_id', $userId)->findColumn('pesanan_id');

        $transaksiList = [];
        if ($pesananIds) {
            $transaksiList = $transaksiModel
                ->whereIn('pesanan_id', $pesananIds)
                ->orderBy('created_at', 'DESC')
                ->findAll();

            // Tambahkan detail pesanan dan menu
            foreach ($transaksiList as &$t) {
                $pesanan = $pesananModel->find($t['pesanan_id']);
                $t['meja_nomor'] = $pesanan['meja_nomor'] ?? '-';

                $details = $detailModel->where('pesanan_id', $t['pesanan_id'])->findAll();
                foreach ($details as &$d) {
                    $menu = $menuModel->find($d['menu_id']);
                    $d['nama_menu'] = $menu['nama_menu'] ?? '(menu tidak ditemukan)';
                }
                $t['detail'] = $details;
            }
        }

        $data = [
            'title' => 'Riwayat Transaksi',
            'transaksi' => $transaksiList,
            'header' => view('my_template/header', ['title' => 'Riwayat Transaksi']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_pelanggan'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('pelanggan/transaksi/riwayat', $data);
    }


}
