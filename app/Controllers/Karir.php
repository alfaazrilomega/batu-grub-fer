<?php

namespace App\Controllers;

use App\Models\LowonganModel;
use App\Models\KarirModel;
use App\Models\MetaModel; // 1. Use MetaModel
use CodeIgniter\Exceptions\PageNotFoundException;

class Karir extends BaseController
{
    protected $lowonganModel;
    protected $karirModel;
    protected $metaModel; // 2. Declare MetaModel

    public function __construct()
    {
        $this->lowonganModel = new LowonganModel();
        $this->karirModel = new KarirModel();
        $this->metaModel = new MetaModel(); // 3. Instantiate MetaModel
    }

    public function index()
    {
        $locale = service('request')->getLocale();
        
        // Mengambil data meta untuk halaman karir
        $metaData = $this->metaModel->where('slug_meta_id', 'karir')->first();

        $lowongan = $this->lowonganModel->paginate(5, 'default');
        $karirPage = $this->karirModel->first();

        $data = [
            'locale'        => $locale,
            'lowongan'      => $lowongan,
            'pager'         => $this->lowonganModel->pager,
            'karir_page'    => $karirPage,
            'meta_title'    => $metaData['title_id'] ?? 'Karir',
            'meta_desc'     => $metaData['meta_desc_id'] ?? 'Temukan peluang karir bersama kami.',
            'canonical_url' => base_url($locale . '/karir'),
        ];

        return view('pages/karir', $data);
    }

    public function detail($slug)
    {
        $locale = service('request')->getLocale();
        $job = $this->lowonganModel->where('slug_lowongan_id', $slug)->first();

        if (!$job) {
            throw new PageNotFoundException('Lowongan dengan slug ' . $slug . ' tidak ditemukan.');
        }

        // Membuat deskripsi meta dari isi deskripsi (155 karakter, tanpa HTML)
        $meta_desc = substr(strip_tags($job['deskripsi_lowongan_id']), 0, 155) . '...';

        $data = [
            'locale'        => $locale,
            'job'           => $job,
            'meta_title'    => $job['nama_lowongan_id'] ?? 'Detail Lowongan',
            'meta_desc'     => $meta_desc,
            'canonical_url' => base_url($locale . '/karir/detail/' . $slug),
        ];
        
        return view('pages/karir_detail', $data);
    }
}
