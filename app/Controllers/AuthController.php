<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        session();
        $data = [
            'validation'    => \config\Services::validation()
        ];
        return view('auth/index', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'email'   => 'required|valid_email|max_length[128]',
            'password'   => 'required|min_length[8]|max_length[128]',
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        }
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $users = $this->userModel->where([
            'email' => $email,
        ])->asObject()->first();
        if ($users) {
            if (password_verify($password, $users->password)) {
                session()->set([
                    'id' => $users->id,
                    'email' => $users->email,
                    'name' => $users->name,
                    'logged_in' => true
                ]);
                return redirect()->to('/dashboard')->with('success', "Login berhasil");
            }           
        }
        return redirect()->to('/login')->with('error', "Email atau Password Salah");

    }

    public function signup()
    {
        session();
        $data = [
            'validation'    => \config\Services::validation()
        ];
        return view('auth/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name'   => 'required|min_length[8]|max_length[128]',
            'email'   => 'required|valid_email|max_length[128]|is_unique[users.email]',
            'password'   => 'required|min_length[8]|max_length[128]',
            'retype-password'   => 'required|matches[password]|max_length[128]'
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/sign-up')->withInput()->with('validation', $validation);
        }

        $data = [
            'name'   => $this->request->getVar('name'),
            'email'   => $this->request->getVar('email'),
            'password'   => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $this->userModel->insert($data);
        return redirect()->to('/sign-up')->with('success', "Data berhasil ditambahkan");
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}
