<?php

namespace App\Controllers;

// PASTIKAN BARIS INI ADA DAN TIDAK SALAH KETIK
use App\Models\MenuModel; 

class MenuController extends BaseController
{
    public function index()
    {
        // Buat instance dari model
        $menuModel = new MenuModel();
        
        // Ambil semua data menggunakan model
        $data['menu'] = $menuModel->findAll();

        // Loop untuk menyesuaikan path gambar (jika diperlukan)
        foreach ($data['menu'] as &$item) {
            // Baris ini tidak wajib, tapi membantu jika ada logika tambahan
            // Anda bisa menghapusnya jika tidak perlu
        }

        // Kirim data ke view
        return view('pages/menu', $data);
    }
}