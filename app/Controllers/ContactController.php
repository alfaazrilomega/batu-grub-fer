<?php

namespace App\Controllers;

use App\Models\KontakModel;
use App\Controllers\BaseController;

class ContactController extends BaseController
{
    protected $kontakModel;

    public function __construct()
    {
        $this->kontakModel = new KontakModel();
    }

    public function index()
    {
        // Fetch dynamic data from the model
        $kontakData = $this->kontakModel->first();

        $locale = service('request')->getLocale();

        // Mengumpulkan semua data untuk view
        $data = [
            'locale'     => $locale,
            'page_title' => 'Kontak',
            'activeMenu' => 'contact',
            'lang'       => $this->lang ?? 'id',
            'canonical'  => base_url(($this->lang ?? 'id') . '/' . (($this->lang ?? 'id') === 'id' ? 'kontak' : 'contact')),
            'kontak'     => $kontakData,
        ];

        // View diarahkan ke 'pages/contact' agar konsisten dengan struktur folder
        return view('pages/contact', $data);
    }
}
