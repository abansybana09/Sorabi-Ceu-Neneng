<?php
namespace App\Controllers;

class AdminController extends BaseController
{
    public function __construct()
    {
        // Mulai session PHP manual jika belum ada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index(...$segments)
    {
        // Cek apakah session login admin dari sistem lama sudah ada
        // Ganti 'admin_logged_in' dengan nama session yang Anda gunakan di Login.php lama
        if (!isset($_SESSION['admin_logged_in'])) { 
            // Jika belum login, arahkan ke file Login.php lama Anda
            return redirect()->to('/Admin/Login.php');
        }

        // Jika sudah login, coba muat file yang diminta
        // Contoh: /admin/dashboard.php -> $path = 'dashboard.php'
        $path = implode('/', $segments);

        // Jika path kosong (hanya /admin), arahkan ke halaman default
        if (empty($path)) {
            $path = 'index.php'; // Ganti dengan halaman dashboard admin Anda
        }

        // Tentukan path lengkap ke file di dalam folder Admin lama Anda
        // Kita asumsikan folder Admin ada di root proyek, sejajar dengan 'app'
        $fullPath = FCPATH . 'Admin/' . $path;

        if (file_exists($fullPath) && !is_dir($fullPath)) {
            // Jika file ada, "render" file tersebut
            // Ini adalah cara untuk menjalankan file PHP lama di dalam CI4
            ob_start();
            include($fullPath);
            $output = ob_get_clean();
            return $this->response->setBody($output);
        } else {
            // Jika file tidak ditemukan, tampilkan 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}