<?php

namespace App\Controllers\Kasir;

use App\Controllers\BaseController;
use App\Models\MejaModel;

class Meja extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new MejaModel();
        $data = [
            'title' => 'Kelola Meja',
            'meja' => $model->findAll(),
            'header' => view('my_template/header', ['title' => 'Kelola Meja']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'footer' => view('my_template/footer'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
        ];

        return view('kasir/meja/index', $data);
    }

    public function create()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Meja',
            'header' => view('my_template/header', ['title' => 'Tambah Meja']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'footer' => view('my_template/footer'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
        ];

        return view('kasir/meja/create', $data);
    }

    public function store()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new MejaModel();
        $model->save([
            'nomor_meja' => $this->request->getPost('nomor_meja'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('/kasir/meja')->with('success', 'Meja berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new MejaModel();
        $data = [
            'title' => 'Edit Meja',
            'meja' => $model->find($id),
            'header' => view('my_template/header', ['title' => 'Edit Meja']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_kasir'),
            'footer' => view('my_template/footer'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
        ];

        return view('kasir/meja/edit', $data);
    }

    public function update($id)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new MejaModel();
        $model->update($id, [
            'nomor_meja' => $this->request->getPost('nomor_meja'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('/kasir/meja')->with('success', 'Data meja berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 2) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Kasir.');
            return redirect()->to('/login');
        }

        $model = new MejaModel();
        $model->delete($id);
        return redirect()->to('/kasir/meja')->with('success', 'Meja berhasil dihapus');
    }
}
