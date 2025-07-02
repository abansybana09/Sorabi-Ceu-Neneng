<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'features' => [
                ['title' => 'Menu Kami', 'image' => 'img/catering.png', 'link' => base_url('menu')],
                ['title' => 'Cabang Kami', 'image' => 'img/kerjasama.png', 'link' => base_url('lokasi')],
                ['title' => 'Katering', 'image' => 'img/paket.png', 'link' => base_url('kontak')]
            ],
            'location' => [
                'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9462.79866544154!2d108.46693337759008!3d-6.983095362156694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f15d36ed8fcf5%3A0xacdb4f934ae96e20!2sJl.%20Otista%20No.55%2C%20Kuningan%2C%20Kec.%20Kuningan%2C%20Kabupaten%20Kuningan%2C%20Jawa%20Barat%2045511%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1744793606396!5m2!1sen!2sus',
                'whatsapp_number' => '6289630152631',
                'whatsapp_message' => 'Halo Warung Mang Oman, saya ingin bertanya tentang...'
            ],
            'branch' => ['link' => base_url('lokasi')],
            'hero' => [
                'title' => 'Warung Mang Oman', 'subtitle' => 'Ayam Enak Harga Murah', 'image' => 'img/bakar.jpg'
            ]
        ];
        return view('pages/home', $data);
    }
}