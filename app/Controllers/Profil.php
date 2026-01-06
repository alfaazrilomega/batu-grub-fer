<?php

namespace App\Controllers;

use App\Models\TentangModel;
use App\Models\MetaModel; // 1. Use MetaModel

class Profil extends BaseController
{
    protected $tentangModel;
    protected $metaModel; // 2. Declare MetaModel

    public function __construct()
    {
        $this->tentangModel = new TentangModel();
        $this->metaModel = new MetaModel(); // 3. Instantiate MetaModel
    }

    public function index()
    {
        $locale = service('request')->getLocale();

        // Mengambil data profil perusahaan
        $profil = $this->tentangModel->first();
        
        // Mengambil data meta untuk halaman profil
        $metaData = $this->metaModel->where('slug_meta_id', 'profil-perusahaan')->first();

        $data = [
            'locale'        => $locale,
            'profil'        => $profil,
            'meta_title'    => $metaData['title_id'] ?? 'Profil Perusahaan',
            'meta_desc'     => $metaData['meta_desc_id'] ?? 'Jelajahi profil perusahaan kami untuk mempelajari lebih lanjut tentang sejarah, misi, dan nilai-nilai kami.',
            'canonical_url' => base_url($locale . '/profil-perusahaan'),
        ];

        return view('pages/profil', $data);
    }
}
