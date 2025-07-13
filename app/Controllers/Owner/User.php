<?php

namespace App\Controllers\Owner;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 1) {
            $this->session->setFlashdata('error', 'Akses ditolak. Silakan login sebagai Owner.');
            return redirect()->to('/login');
        }

        $model = new UserModel();
        $data = [
            'users' => $model->findAll(),
            'header' => view('my_template/header', ['title' => 'Manajemen User']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/user/index', $data);
    }


    public function aktifkan($id)
    {
        $model = new UserModel();
        $model->update($id, ['is_active' => 1]);
        return redirect()->back()->with('msg', 'User diaktifkan');
    }

    public function nonaktifkan($id)
    {
        $model = new UserModel();
        $model->update($id, ['is_active' => 0]);
        return redirect()->back()->with('msg', 'User dinonaktifkan');
    }

    public function create()
    {
        $user = $this->session->get('user');
        if (!$user || $user['user_level'] != 1) {
            $this->session->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to('/login');
        }

        $data = [
            'header' => view('my_template/header', ['title' => 'Tambah User']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => view('my_template/sidebar_owner'),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('owner/user/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'user_level' => 'required|in_list[2,3]', // 2 = Kasir, 3 = Chef
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'user_level' => $this->request->getPost('user_level'),
            'is_active' => 1, // Langsung aktif
        ]);

        return redirect()->to('/owner/user')->with('msg', 'User berhasil ditambahkan.');
    }

}
