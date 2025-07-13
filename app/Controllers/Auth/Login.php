<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Controllers\Auth\RememberMe;
use App\Models\User;

class Login extends BaseController
{
    protected $rememberMe;

    public function __construct()
    {
        $this->rememberMe = new RememberMe();
    }

    public function index()
    {
        if ($this->session->get('user')) {
            return redirect()->to($this->getRedirectUrl($this->session->get('user')['user_level']));
        }

        if ($this->rememberMe->checkUserCookie() === TRUE) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login Page',
            'session' => $this->session,
        ];

        return view('auth/login', $data);
    }

    public function authenticate()
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            $errors = [
                'email' => $this->validation->getError('email'),
                'password' => $this->validation->getError('password'),
            ];
            return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new User();
        $user = $userModel->findUserActiveByEmail($email); // pastikan mengembalikan user_level juga

        if (!$user) {
            return $this->response->setJSON(['status' => FALSE, 'errors' => ['email' => 'Email not found']]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['status' => FALSE, 'errors' => ['password' => 'Wrong Password']]);
        }

        if ($this->request->getPost('rememberMe')) {
            $this->rememberMe->setUserCookie($user);
        }

        // Simpan ke session
        $this->session->set('user', [
            'isLoggedIn' => true,
            'user_id' => $user['user_id'], // ← tambahkan ini
            'nama' => $user['nama'],
            'email' => $user['email'],
            'user_level' => $user['user_level'],
        ]);

        $this->session->setFlashdata('login-success', 'Login success, welcome back ' . $user['nama']);

        return $this->response->setJSON([
            'status' => TRUE,
            'redirectUrl' => $this->getRedirectUrl($user['user_level']),
        ]);
    }

    private function getRedirectUrl($user_level)
    {
        switch ($user_level) {
            case 1:
                return '/owner/dashboard';
            case 2:
                return '/kasir/dashboard';
            case 3:
                return '/chef/dashboard';
            case 4:
                return '/pelanggan/dashboard';
            default:
                return '/';
        }
    }
}
