<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthGuardUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('url');
        // Cek apakah sudah login atau belum
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu diubah
        return $response;
    }
}