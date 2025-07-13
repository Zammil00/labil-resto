<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\MenuBahanModel;
use App\Models\BahanBakuModel;
use App\Models\MenuModel;

class UpdateBahan extends BaseController
{
    public function kurangiStok($menuId, $qty)
    {
        $menuBahanModel = new MenuBahanModel();
        $bahanModel = new BahanBakuModel();

        $bahanList = $menuBahanModel->where('menu_id', $menuId)->findAll();

        foreach ($bahanList as $bahan) {
            $totalKurang = $bahan['jumlah'] * $qty;
            $bahanModel->where('bahan_id', $bahan['bahan_id'])->decrement('stok', $totalKurang);
        }

        // Cek kembali apakah stok bahan masih mencukupi
        $stokCukup = true;
        foreach ($bahanList as $bahan) {
            $stok = $bahanModel->find($bahan['bahan_id'])['stok'];
            if ($stok < $bahan['jumlah']) {
                $stokCukup = false;
                break;
            }
        }

        $menuModel = new MenuModel();
        $menuModel->update($menuId, ['is_available' => $stokCukup ? 1 : 0]);
    }

    // ✅ Fungsi ini bisa dipanggil berkala/manual untuk refresh semua menu
    public function periksaSemuaMenu()
    {
        $menuModel = new MenuModel();
        $menuBahanModel = new MenuBahanModel();
        $bahanModel = new BahanBakuModel();

        $semuaMenu = $menuModel->findAll();

        foreach ($semuaMenu as $menu) {
            $bahanList = $menuBahanModel->where('menu_id', $menu['menu_id'])->findAll();

            $stokCukup = true;
            foreach ($bahanList as $bahan) {
                $stok = $bahanModel->find($bahan['bahan_id'])['stok'] ?? 0;
                if ($stok < $bahan['jumlah']) {
                    $stokCukup = false;
                    break;
                }
            }

            $menuModel->update($menu['menu_id'], ['is_available' => $stokCukup ? 1 : 0]);
        }

        return redirect()->back()->with('msg', 'Ketersediaan menu diperbarui berdasarkan stok bahan baku.');
    }
}
