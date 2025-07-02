<?php

namespace App\Controllers;

use App\Models\MenuModel;

class AdminMenuController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        // Memuat helper 'form' untuk validasi (opsional tapi bagus)
        helper(['form']);
    }

    // Method index() tidak berubah...
    public function index()
    {
        $data['menu_items'] = $this->menuModel->findAll();
        return view('admin/menu/index', $data);
    }

    // Method new() tidak berubah...
    public function new()
    {
        return view('admin/menu/create');
    }

    // === CREATE (DENGAN LOGIKA UPLOAD) ===
    public function create()
    {
        // 1. Ambil file gambar dari request
        $fileFoto = $this->request->getFile('foto');

        // 2. Cek apakah ada file yang di-upload dan valid
        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // 3. Generate nama file random agar unik
            $namaFoto = $fileFoto->getRandomName();

            // 4. Pindahkan file ke folder tujuan (public/img/menu)
            $fileFoto->move('img/menu/', $namaFoto);
        } else {
            // Jika tidak ada file di-upload, gunakan nama default
            $namaFoto = 'default.jpg';
        }

        // 5. Siapkan data untuk disimpan ke database
        $data = [
            'nama_menu'      => $this->request->getPost('nama_menu'),
            'deskripsi_menu' => $this->request->getPost('deskripsi_menu'),
            'harga'          => $this->request->getPost('harga'),
            'stok'           => $this->request->getPost('stok'),
            'foto'           => $namaFoto // Simpan nama file yang sudah di-generate
        ];

        // 6. Simpan data ke database melalui model
        $this->menuModel->insert($data);

        return redirect()->to('/admin/menu')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Method edit() tidak berubah...
    public function edit($id)
    {
        $data['item'] = $this->menuModel->find($id);
        if (empty($data['item'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Menu tidak ditemukan: ' . $id);
        }
        return view('admin/menu/edit', $data);
    }

    // === UPDATE (DENGAN LOGIKA UPLOAD & HAPUS FILE LAMA) ===
    public function update($id)
    {
        // Ambil data menu lama dari database
        $menuLama = $this->menuModel->find($id);

        // Ambil file gambar dari request
        $fileFoto = $this->request->getFile('foto');
        
        // Cek apakah ada file baru yang di-upload
        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // File baru di-upload, proses seperti create
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('img/menu/', $namaFoto);

            // Hapus file foto lama jika bukan default.jpg
            if ($menuLama['foto'] != 'default.jpg' && file_exists('img/menu/' . $menuLama['foto'])) {
                unlink('img/menu/' . $menuLama['foto']);
            }
        } else {
            // Tidak ada file baru, gunakan nama foto lama
            $namaFoto = $menuLama['foto'];
        }

        // Siapkan data untuk di-update
        $data = [
            'nama_menu'      => $this->request->getPost('nama_menu'),
            'deskripsi_menu' => $this->request->getPost('deskripsi_menu'),
            'harga'          => $this->request->getPost('harga'),
            'stok'           => $this->request->getPost('stok'),
            'foto'           => $namaFoto
        ];
        
        $this->menuModel->update($id, $data);

        return redirect()->to('/admin/menu')->with('success', 'Menu berhasil diperbarui!');
    }


    // === DELETE (DENGAN LOGIKA HAPUS FILE) ===
    public function delete($id)
    {
        // Cari data menu yang akan dihapus
        $menu = $this->menuModel->find($id);

        // Hapus file foto dari server jika ada dan bukan default
        if ($menu && $menu['foto'] != 'default.jpg' && file_exists('img/menu/' . $menu['foto'])) {
            unlink('img/menu/' . $menu['foto']);
        }
        
        // Hapus data dari database
        $this->menuModel->delete($id);

        return redirect()->to('/admin/menu')->with('success', 'Menu berhasil dihapus!');
    }
}