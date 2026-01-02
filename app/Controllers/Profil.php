<?php

namespace App\Controllers;

use App\Models\TentangModel; // Gunakan TentangModel

class Profil extends BaseController
{
    protected $tentangModel;

    public function __construct()
    {
        $this->tentangModel = new TentangModel();
    }

    public function index()
    {
        $locale = service('request')->getLocale();

        // Mengambil data profil perusahaan (baris pertama dari tabel tb_tentang)
        $profil = $this->tentangModel->first();

        $data = [
            'locale' => $locale,
            'page_title' => 'Profil Perusahaan',
            'profil' => $profil,
        ];

        return view('pages/profil', $data);
    }
}
