<?php

// File: app/Controllers/Owner/Dashboard.php

namespace App\Controllers\Owner;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\PesananDetailModel;
use App\Models\TransaksiModel;
use App\Models\BahanBakuModel;
use CodeIgniter\I18n\Time;
use Dompdf\Dompdf;
use Dompdf\Options;

class Dashboard extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 1) {
            return redirect()->to('/login')->with('error', 'Akses ditolak. Silakan login sebagai Owner.');
        }

        $menuModel = new MenuModel();
        $pesananModel = new PesananModel();
        $detailModel = new PesananDetailModel();
        $transaksiModel = new TransaksiModel();

        $jumlah_pesanan = $pesananModel->where('status', 'selesai')->countAllResults();
        $total_omzet = $transaksiModel->selectSum('total_bayar')->first()['total_bayar'] ?? 0;

        // Menu terlaris
        $menuTerlaris = $detailModel
            ->select('menu.nama_menu, SUM(qty) as total_terjual')
            ->join('menu', 'menu.menu_id = pesanan_detail.menu_id')
            ->groupBy('pesanan_detail.menu_id')
            ->orderBy('total_terjual', 'DESC')
            ->limit(1)
            ->first();

        $data = [
            'title' => 'Dashboard Owner',
            'jumlah_pesanan' => $jumlah_pesanan,
            'total_omzet' => $total_omzet,
            'menu_terlaris' => $menuTerlaris,

            'header' => view('my_template/header', ['title' => 'Dashboard Owner']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/dashboard', $data);
    }

    public function laporanTransaksi()
    {
        $transaksiModel = new TransaksiModel();

        $tanggal = $this->request->getVar('tanggal');
        $query = $transaksiModel->select('transaksi.*, users.nama as kasir')
            ->join('users', 'users.user_id = transaksi.kasir_id', 'left');

        if ($tanggal) {
            $query->like('transaksi.created_at', $tanggal);
        }

        $data = [
            'transaksi' => $query->findAll(),
            'tanggal' => $tanggal,
            'header' => view('my_template/header'),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/laporan_transaksi', $data);
    }

    public function laporanStok()
    {
        $bahanModel = new BahanBakuModel();
        $data = [
            'bahan' => $bahanModel->findAll(),
            'header' => view('my_template/header'),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/laporan_stok', $data);
    }

    // File: app/Controllers/Owner/Dashboard.php

    public function totalOmzet()
    {
        $transaksiModel = new TransaksiModel();

        $transaksi = $transaksiModel
            ->select("DATE(created_at) as tanggal, SUM(total_bayar) as total")
            ->groupBy("DATE(created_at)")
            ->orderBy("tanggal", "DESC")
            ->findAll();

        $data = [
            'title' => 'Total Omzet Harian',
            'transaksi' => $transaksi,
            'header' => view('my_template/header'),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/total_omzet', $data);
    }

    public function menuTerlaris()
    {
        $detailModel = new PesananDetailModel();

        $menu = $detailModel
            ->select("menu.nama_menu, SUM(qty) as total_terjual")
            ->join("menu", "menu.menu_id = pesanan_detail.menu_id")
            ->groupBy("menu.menu_id")
            ->orderBy("total_terjual", "DESC")
            ->findAll();

        $data = [
            'title' => 'Menu Terlaris',
            'menu' => $menu,
            'header' => view('my_template/header'),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/menu_terlaris', $data);
    }

    private function generatePDF($view, $data, $filename)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view($view, $data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename . ".pdf", ['Attachment' => true]);
    }

    public function exportOmzetWeekly()
    {
        $transaksiModel = new TransaksiModel();
        $result = $transaksiModel
            ->select("WEEK(created_at, 1) AS periode, YEAR(created_at) AS tahun, SUM(total_bayar) as total")
            ->groupBy(["tahun", "periode"])
            ->orderBy("tahun DESC, periode DESC")
            ->findAll();

        $this->generatePDF('owner/pdf/laporan_periode', [
            'title' => 'Laporan Omzet Mingguan',
            'periode' => 'Minggu',
            'laporan' => $result,
        ], 'laporan-omzet-mingguan');
    }

    public function exportOmzetMonthly()
    {
        $transaksiModel = new TransaksiModel();
        $result = $transaksiModel
            ->select("MONTH(created_at) AS periode, YEAR(created_at) AS tahun, SUM(total_bayar) as total")
            ->groupBy(["tahun", "periode"])
            ->orderBy("tahun DESC, periode DESC")
            ->findAll();

        $this->generatePDF('owner/pdf/laporan_periode', [
            'title' => 'Laporan Omzet Bulanan',
            'periode' => 'Bulan',
            'laporan' => $result,
        ], 'laporan-omzet-bulanan');
    }

    public function exportOmzetYearly()
    {
        $transaksiModel = new TransaksiModel();
        $result = $transaksiModel
            ->select("YEAR(created_at) AS periode, SUM(total_bayar) as total")
            ->groupBy("periode")
            ->orderBy("periode DESC")
            ->findAll();

        $this->generatePDF('owner/pdf/laporan_periode', [
            'title' => 'Laporan Omzet Tahunan',
            'periode' => 'Tahun',
            'laporan' => $result,
        ], 'laporan-omzet-tahunan');
    }

}
