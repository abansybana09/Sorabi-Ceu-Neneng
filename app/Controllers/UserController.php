<?php
namespace App\Controllers;

use App\Models\OrderModel;

class UserController extends BaseController
{
    // Halaman ini hanya bisa diakses jika sudah login
    protected $authGuard;

    public function __construct()
    {
        // Memuat filter auth untuk pengecekan manual
        $this->authGuard = new \App\Filters\AuthGuard();
    }

    // Method untuk menampilkan halaman profil dan riwayat pesanan
   // app/Controllers/OrderController.php
    // app/Controllers/UserController.php
public function profile()
{
    // Ambil ID user yang sedang login dari session
    $userId = session()->get('user_id');

    $orderModel = new \App\Models\OrderModel();

    // --- INI BAGIAN YANG DIPERBAIKI ---
    // Cari pesanan HANYA berdasarkan user_id yang cocok
    $data['orders'] = $orderModel
        ->where('user_id', $userId) // Filter berdasarkan ID pengguna yang login
        ->getOrdersWithItems(); // Gunakan method yang sudah ada

    return view('user/profile', $data);
}
}