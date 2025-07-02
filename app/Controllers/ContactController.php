<?php
namespace App\Controllers;

class ContactController extends BaseController
{
    public function index()
    {
        // Menampilkan halaman kontak dengan data session jika ada (setelah redirect)
        return view('pages/kontak', [
            'errors' => session()->getFlashdata('errors'),
            'success' => session()->getFlashdata('success')
        ]);
    }

    public function submit()
    {
        // 1. Aturan Validasi
        $rules = [
            'name'      => 'required|min_length[3]',
            'telephone' => 'required|numeric|min_length[10]',
            'email'     => 'required|valid_email',
            'purpose'   => 'required',
            'message'   => 'required|min_length[10]'
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form dengan pesan error
            return redirect()->to('kontak')
                             ->withInput() // Mengirim kembali input lama
                             ->with('errors', $this->validator->getErrors());
        }

        // 3. Jika validasi berhasil
        $data = $this->request->getPost();

        // Membuat pesan WhatsApp
        $waMessage = "Halo Mang Oman,\n\n"
                   . "Nama: " . $data['name'] . "\n"
                   . "Telepon: " . $data['telephone'] . "\n"
                   . "Email: " . $data['email'] . "\n"
                   . "Tujuan: " . $data['purpose'] . "\n"
                   . "Pesan:\n" . $data['message'];

        $waNumber = '6289630152631';
        $whatsappUrl = "https://wa.me/{$waNumber}?text=" . rawurlencode($waMessage);

        // Alihkan pengguna ke WhatsApp
        return redirect()->to($whatsappUrl);
    }
}