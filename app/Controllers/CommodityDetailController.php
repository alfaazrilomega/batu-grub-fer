<?php

namespace App\Controllers;

use App\Models\KomoditasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class CommodityDetailController extends BaseController
{
    protected $komoditasModel;

    public function __construct()
    {
        $this->komoditasModel = new KomoditasModel();
    }

    public function detail($slug = null)
    {
        $locale = $this->request->getLocale();

        // Cari komoditas di database berdasarkan slug
        $commodityData = $this->komoditasModel->where('slug_id', $slug)->first();

        // Jika tidak ditemukan, tampilkan halaman 404
        if (!$commodityData) {
            throw PageNotFoundException::forPageNotFound("Komoditas dengan slug '$slug' tidak ditemukan.");
        }

        // Siapkan data untuk dikirim ke view
        $data = [
            'locale'    => $locale,
            'hero_bg'   => base_url('uploads/komoditas/' . $commodityData['foto_komoditas']),
            'commodity' => [
                'title'   => $commodityData['nama_komoditas_id'],
                'content' => $commodityData['deskripsi_komoditas_id'],
            ]
        ];

        return view('pages/commodity_detail', $data);
    }
}