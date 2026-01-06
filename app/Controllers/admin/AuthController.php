<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    private $username = 'admin';
    private $password = 'admin123'; // Ganti dengan password yang lebih aman
    
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('admin/dashboard');
        }
        
        return view('admin/auth/login');
    }
    
    public function processLogin()
    {
        $inputUsername = $this->request->getPost('username');
        $inputPassword = $this->request->getPost('password');
        
        if ($inputUsername === $this->username && $inputPassword === $this->password) {
            session()->set('logged_in', true);
            session()->set('username', $inputUsername);
            
            return redirect()->to('admin/dashboard');
        } else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('login')->withInput();
        }
    }
    
    public function logout()
    {
        session()->remove('logged_in');
        session()->remove('username');
        session()->destroy();
        
        return redirect()->to('login');
    }
}