<?php

namespace App\Controllers;

use App\Models\LowonganModel;
use App\Models\KarirModel; // Tambahkan KarirModel
use CodeIgniter\Exceptions\PageNotFoundException;

class Karir extends BaseController
{
    protected $lowonganModel;
    protected $karirModel; // Tambahkan properti

    public function __construct()
    {
        $this->lowonganModel = new LowonganModel();
        $this->karirModel = new KarirModel(); // Inisialisasi KarirModel
    }

    public function index()
    {
        $locale = service('request')->getLocale();
        
        // Mengambil data lowongan dengan paginasi
        $lowongan = $this->lowonganModel->paginate(5, 'default');
        
        // Mengambil konten halaman karir dari KarirModel (baris pertama)
        $karirPage = $this->karirModel->first();

        $data = [
            'locale' => $locale,
            'page_title' => 'Karir',
            'lowongan' => $lowongan,
            'pager' => $this->lowonganModel->pager,
            'karir_page' => $karirPage, // Kirim data halaman karir ke view
        ];

        return view('pages/karir', $data);
    }

    public function detail($slug)
    {
        $locale = service('request')->getLocale();
        $job = $this->lowonganModel->where('slug_lowongan_id', $slug)->first();

        // Jika data lowongan tidak ditemukan, tampilkan halaman 404
        if (!$job) {
            throw new PageNotFoundException('Lowongan dengan slug ' . $slug . ' tidak ditemukan.');
        }

        $data = [
            'locale' => $locale,
            'page_title' => $job['nama_lowongan_id'],
            'job' => $job,
        ];
        
        return view('pages/karir_detail', $data);
    }
}
