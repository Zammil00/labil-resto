<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\User;

class UpdateProfile extends BaseController
{
    private function getSidebarView()
    {
        $userId = session()->get('user')['user_level'];

        switch ($userId) {
            case '1':
                return view('my_template/sidebar_owner');
            case '2':
                return view('my_template/sidebar_kasir');
            case '3':
                return view('my_template/sidebar_chef');
            case '4':
                return view('my_template/sidebar_pelanggan');
            default:
                return view('my_template/sidebar_default'); // fallback
        }
    }

    public function index()
    {
        $userModel = new User();
        $userId = session()->get('user')['user_id'];


        $user = $userModel->withDeleted()->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan. Silakan login ulang.');
        }

        $data = [
            'title' => 'Profil Saya',
            'user' => $user,
            'header' => view('my_template/header', ['title' => 'Profil Saya']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => $this->getSidebarView(),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('system/profile', $data);
    }

    public function edit()
    {
        $userModel = new User();
        $userId = session()->get('user')['user_id'];


        $user = $userModel->withDeleted()->find($userId);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Profil',
            'user' => $user,
            'header' => view('my_template/header', ['title' => 'Edit Profil']),
            'navbar' => view('my_template/navbar'),
            'sidebar' => $this->getSidebarView(),
            'sidebar_kanan' => view('my_template/sidebar_kanan'),
            'footer' => view('my_template/footer'),
        ];

        return view('system/update_profile', $data);
    }

    public function save()
    {
        $userModel = new User();
        $userId = session()->get('user')['user_id'];


        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);

        return redirect()->to(site_url('system/updateprofile'))->with('success', 'Profil berhasil diperbarui.');
    }
}
