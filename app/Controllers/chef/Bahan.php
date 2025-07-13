<?php

namespace App\Controllers\Chef;

use App\Controllers\BaseController;
use App\Models\BahanBakuModel;

class Bahan extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 3) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Chef.');
            return redirect()->to('/login');
        }

        $model = new BahanBakuModel();

        $data = [
            'title' => 'Data Bahan Baku',
            'bahan' => $model->findAll(),

            // Include layout bagian-bagian template
            'header' => view('my_template/header', ['title' => 'Data Bahan Baku']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/bahan/index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Bahan Baku',
            // Include layout bagian-bagian template
            'header' => view('my_template/header', ['title' => 'Data Bahan Baku']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/bahan/create', $data);
    }

    public function store()
    {
        $model = new BahanBakuModel();
        $model->insert([
            'nama_bahan' => $this->request->getPost('nama_bahan'),
            'satuan' => $this->request->getPost('satuan'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/chef/bahan')->with('msg', 'Bahan baku ditambahkan');
    }
    public function edit($id)
    {
        $model = new BahanBakuModel();
        $bahan = $model->find($id);

        if (!$bahan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Bahan dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Bahan Baku',
            'bahan' => $bahan,
            'header' => view('my_template/header', ['title' => 'Edit Bahan']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_chef'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('chef/bahan/edit', $data);
    }


    public function update($id)
    {
        $model = new BahanBakuModel();
        $model->update($id, [
            'nama_bahan' => $this->request->getPost('nama_bahan'),
            'satuan' => $this->request->getPost('satuan'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/chef/bahan')->with('msg', 'Bahan baku diperbarui');
    }

}
