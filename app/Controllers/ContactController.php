<?php

namespace App\Controllers;

use App\Models\KontakModel;
use App\Models\MetaModel; // 1. Use MetaModel
use App\Controllers\BaseController;

class ContactController extends BaseController
{
    protected $kontakModel;
    protected $metaModel; // 2. Declare MetaModel

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
        $this->metaModel = new MetaModel(); // 3. Instantiate MetaModel
    }

    public function index()
    {
        $locale = service('request')->getLocale();

        // Mengambil data meta untuk halaman kontak
        $metaData = $this->metaModel->where('slug_meta_id', 'kontak')->first();
        
        // Mengambil data kontak dari model
        $kontakData = $this->kontakModel->first();

        $data = [
            'locale'        => $locale,
            'kontak'        => $kontakData,
            'meta_title'    => $metaData['title_id'] ?? 'Hubungi Kami',
            'meta_desc'     => $metaData['meta_desc_id'] ?? 'Hubungi kami untuk informasi lebih lanjut.',
            'canonical_url' => base_url($locale . '/kontak'),
        ];

        return view('pages/contact', $data);
    }
}
