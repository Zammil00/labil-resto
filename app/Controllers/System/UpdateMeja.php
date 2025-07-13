<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\MejaModel;
use App\Models\PesananModel;
use App\Models\TransaksiModel;

class UpdateMeja extends BaseController
{
    public function tandaiDigunakan($mejaId)
    {
        $mejaModel = new MejaModel();

        $meja = $mejaModel->find($mejaId);
        if (!$meja) {
            return false;
        }

        $mejaModel->update($mejaId, ['status' => 'digunakan']);
        return true;
    }

    public function tandaiKosongDariPesanan($pesananId)
    {
        $pesananModel = new PesananModel();
        $mejaModel = new MejaModel();

        $pesanan = $pesananModel->find($pesananId);
        if (!$pesanan) {
            return false;
        }

        $mejaId = $pesanan['meja_id'];
        if ($mejaId) {
            $mejaModel->update($mejaId, ['status' => 'kosong']);
        }

        return true;
    }
}
