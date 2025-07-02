<?php
namespace App\Controllers;

class LokasiController extends BaseController
{
    public function index()
    {
        // Pastikan key-nya 'data' seperti yang digunakan di view
        $data['data'] = [
            [
                'image' => 'img/menu/lokasi.jpg', // Path gambar baru
                'title' => 'Lokasi Sorabi Ceu Neneng',
                'maps_url' => 'https://www.google.com/maps/place/Balai+Desa+Karang+Muncang' // Ganti dengan link Google Maps yang benar
            ],
        ];
        return view('pages/lokasi', $data);
    }
}