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

        $commodityData = $this->komoditasModel->where('slug_id', $slug)->first();

        if (!$commodityData) {
            throw PageNotFoundException::forPageNotFound("Komoditas dengan slug '$slug' tidak ditemukan.");
        }

        // Membuat deskripsi meta dari isi deskripsi (155 karakter, tanpa HTML)
        $meta_desc = substr(strip_tags($commodityData['deskripsi_komoditas_id']), 0, 155) . '...';

        $data = [
            'locale'        => $locale,
            'hero_bg'       => base_url('img/komoditas/' . $commodityData['foto_komoditas']),
            'commodity'     => [
                'title'   => $commodityData['nama_komoditas_id'],
                'content' => $commodityData['deskripsi_komoditas_id'],
            ],
            'meta_title'    => $commodityData['nama_komoditas_id'] ?? 'Detail Komoditas',
            'meta_desc'     => $meta_desc,
            'canonical_url' => base_url($locale . '/komoditas/' . $slug),
        ];

        return view('pages/commodity_detail', $data);
    }
}