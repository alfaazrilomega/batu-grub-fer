<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\AnggotaModel;
use App\Models\MetaModel;
use App\Models\SliderModel;
use App\Models\KontakModel;
use App\Models\KomoditasModel;
use App\Models\TentangModel;

class Home extends BaseController
{
    protected $artikelModel;
    protected $anggotaModel;
    protected $metaModel;
    protected $sliderModel;
    protected $kontakModel;
    protected $komoditasModel;
    protected $tentangModel;

    public function __construct()
    {
        // Load all models
        $this->artikelModel = new ArtikelModel();
        $this->anggotaModel = new AnggotaModel();
        $this->metaModel    = new MetaModel();
        $this->sliderModel  = new SliderModel();
        $this->kontakModel  = new KontakModel();
        $this->komoditasModel = new KomoditasModel();
        $this->tentangModel = new TentangModel();
    }

    /**
     * Menampilkan halaman beranda.
     */
    public function index(): string
    {
        $locale = service('request')->getLocale();

        // 1. Ambil Meta Beranda
        // Note: Adjust 'nama_halaman_id' value if it's different in your database
        $meta = $this->metaModel->where('nama_halaman_id', 'Beranda')->first();

        // 2. Data Lainnya
        $latestNews = $this->artikelModel->orderBy('created_at', 'DESC')->limit(3)->findAll();
        $members    = $this->anggotaModel->findAll();
        $slider     = $this->sliderModel->findAll();
        $kontak     = $this->kontakModel->first();
        $commodities = $this->komoditasModel->orderBy('created_at', 'ASC')->limit(4)->findAll();
        $tentang = $this->tentangModel->first(); // Fetch "tentang" data

        // 3. Ambil Deskripsi Khusus (Komoditas & Anggota)
        $commodity_meta = $this->metaModel->where('nama_halaman_id', 'Komoditas')->first();
        $members_meta = $this->metaModel->where('nama_halaman_id', 'Anggota')->first();


        $data = [
            'locale'     => $locale,
            'meta'       => $meta, // For SEO purposes
            'news'       => $latestNews,
            'members'    => $members,
            'slider'     => $slider,
            'kontak'     => $kontak,
            'commodities' => $commodities,
            'tentang'    => $tentang, // Pass "tentang" data to the view
            'commodity_description' => $commodity_meta ? $commodity_meta['deskripsi_halaman_id'] : 'Teks komoditas default jika tidak ditemukan.',
            'members_description' => $members_meta ? $members_meta['deskripsi_halaman_id'] : 'Teks anggota default jika tidak ditemukan.',
            'canonical'  => base_url(),
        ];

        return view('pages/home', $data);
    }
}
