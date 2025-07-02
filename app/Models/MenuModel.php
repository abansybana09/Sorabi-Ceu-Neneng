<?php

namespace App\Models; // APAKAH INI SUDAH BENAR?

use CodeIgniter\Model;

class MenuModel extends Model // APAKAH NAMA CLASS-NYA SUDAH BENAR?
{
    protected $table            = 'tb_daftarmenu';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_menu', 'deskripsi_menu', 'harga', 'stok', 'foto'];
}