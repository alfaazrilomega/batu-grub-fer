<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Menampilkan halaman beranda.
     * 
     * Controller ini akan memanggil view 'pages/home', 
     * yang secara otomatis akan menggunakan layout dari 'layout/default'.
     *
     * Pastikan file-file berikut sudah dipindahkan ke lokasi yang benar:
     * - '_layout_default.php' -> 'app/Views/layout/default.php'
     * - '_home_page.php'      -> 'app/Views/pages/home.php'
     */
    public function index(): string
    {
        $locale = service('request')->getLocale();

        return view('pages/home', ['locale' => $locale]);
    }
}
