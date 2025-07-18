<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;

use App\Controllers\Auth\EmailVerification;

class Registration extends BaseController
{
    public function index()
    {
        if($this->session->get('user')) {
            return redirect()->back();
        }

        return view('auth/register', [
            'title' => 'Registration Page',
            'session' => $this->session,
        ]);
    }
    public function store()
    {
        $rules = [
            'nama' => 'required',
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid',
                    'is_unique' => 'Email has been registered'
                ]
            ],
            'password' => 'required|min_length[8]',
            'passwordConfirmation' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password Confirmation is required',
                    'matches' => 'Password Confirmation does not match'
                ]
            ]
        ];

        if(!$this->validate($rules)) {
            $errors = [
                'nama' => $this->validation->getError('nama'),
                'email' => $this->validation->getError('email'),
                'password' => $this->validation->getError('password'),
                'passwordConfirmation' => $this->validation->getError('passwordConfirmation')
            ];

            return $this->response->setJSON(['status' => FALSE, 'errors' => $errors]);
        } else {
            try {
                $model = new User();
                $model->transBegin();

                $password = $this->request->getPost('password');
                $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
                $email =  $this->request->getPost('email');

                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'email' => $email,
                    'password' => $encryptedPassword,
                    'user_level' => 4,
                    'is_active' => 0,
                ];

                $model->insert($data);

                $user_id = $model->getInsertID();

                $emailVerification = new EmailVerification();
                $emailVerification->sendEmail($user_id, $email, 'registration');

                $model->transCommit();

                $this->session->setFlashdata('success', 'Registration success, please verify your email!');
                return $this->response->setJSON(['status' => TRUE, 'redirectUrl' => '/login']);
            } catch (\Throwable $th) {
                $model->transRollback();

                $this->session->setFlashdata('failed', 'Registration failed, please try again!');
                return $this->response->setJSON(['status' => 'error', 'redirectUrl' => '/registration']);
            }

        }
    }
}
