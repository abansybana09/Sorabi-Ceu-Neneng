<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthGuard implements FilterInterface
{
    /**
     * Do whatever you want here.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Muat helper 'url' agar fungsi redirect() berjalan dengan baik
        helper('url');

        // Cek 1: Apakah ada session 'isLoggedIn'?
        if (! session()->get('isLoggedIn')) {
            // Jika TIDAK ADA, paksa pengguna ke halaman login.
            return redirect()->to(site_url('login'))->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Cek 2: Jika SUDAH login, apakah rolenya BUKAN 'admin'?
        if (session()->get('role') !== 'admin') {
            // Jika BUKAN admin (misalnya 'user'), lempar ke halaman utama.
            return redirect()->to(site_url('/'))->with('error', 'Anda tidak memiliki hak akses ke halaman admin.');
        }

        // Jika semua pengecekan di atas lolos, berarti dia adalah admin yang sudah login.
        // Biarkan request berlanjut ke controller yang dituju (jangan lakukan apa-apa).
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu ada kode di sini untuk kasus kita.
    }
}