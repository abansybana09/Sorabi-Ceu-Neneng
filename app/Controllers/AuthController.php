<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function __construct()
    {
        // Memuat helper 'url' dan 'session'
        helper(['url', 'session']);
    }

    // Menampilkan halaman login
    public function index()
    {
        // Jika sudah login, lempar ke dashboard admin
        if (session()->get('isLoggedIn')) {
            return redirect()->to('admin/menu');
        }
        
        return view('auth/login');
    }

    // Memproses upaya login
  // app/Controllers/AuthController.php
// app/Controllers/AuthController.php

public function processLogin()
{
    // Ambil input dari form
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Panggil model
    $userModel = new \App\Models\UserModel();
    
    // Cari user berdasarkan username
    $user = $userModel->where('username', $username)->first();

    // Cek apakah user ada DAN password-nya cocok
    if ($user && password_verify($password, $user['password'])) {
        // ---- JIKA LOGIN BERHASIL ----
        
        // Buat data untuk disimpan ke session
        $sessionData = [
            'user_id'    => $user['id'],
            'fullname'   => $user['fullname'],
            'username'   => $user['username'],
            'role'       => $user['role'],
            'isLoggedIn' => TRUE
        ];
        session()->set($sessionData);

        // Arahkan (redirect) berdasarkan role
        if ($user['role'] === 'admin') {
            // Jika admin, arahkan ke dashboard admin
            return redirect()->to(site_url('admin/menu'));
        } else {
            // Jika user biasa, arahkan ke halaman utama
            return redirect()->to(site_url('/'));
        }
    } else {
        // ---- JIKA LOGIN GAGAL ----
        
        // Kembali ke halaman login dan tampilkan pesan error
        return redirect()->to(site_url('login'))->with('error', 'Username atau Password salah!');
    }
}

    // app/Controllers/AuthController.php

// Method untuk menampilkan form registrasi
public function showRegisterForm()
{
    return view('auth/register');
}

// Method untuk memproses registrasi
public function processRegister()
{
    $rules = [
        'fullname' => 'required|min_length[3]',
        'username' => 'required|min_length[3]|is_unique[users.username]',
        'password' => 'required|min_length[6]',
        'pass_confirm' => 'required|matches[password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel(); // Kita akan buat model ini
    $data = [
        'fullname' => $this->request->getPost('fullname'),
        'username' => $this->request->getPost('username'),
        // Hash password sebelum disimpan!
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'     => 'user' // Setiap yang mendaftar adalah user biasa
    ];

    $userModel->save($data);
    return redirect()->to('login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    // Proses logout
    // app/Controllers/AuthController.php

public function logout()
{
    // Hancurkan session
    session()->destroy();
    
    // GANTI BARIS INI: Arahkan ke halaman utama (home)
    return redirect()->to(base_url('/'))->with('success', 'Anda telah berhasil logout.');
}
}