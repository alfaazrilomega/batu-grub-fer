<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\MetaModel;

class MemberController extends BaseController
{
    protected $anggotaModel;
    protected $metaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->metaModel = new MetaModel();
    }

    public function index()
    {
        $locale = service('request')->getLocale();

        // Mengambil data meta untuk halaman anggota
        $metaData = $this->metaModel->where('slug_meta_id', 'members')->first();

        // Mengambil semua data anggota dari model
        $members = $this->anggotaModel->findAll();

        $data = [
            'locale'        => $locale,
            'members'       => $members,
            'meta_title'    => $metaData['title_id'] ?? 'Anggota Kami',
            'meta_desc'     => $metaData['meta_desc_id'] ?? 'Lihat daftar anggota yang menjadi bagian dari jaringan kami.',
            // Deskripsi ini bisa digunakan di dalam view jika diperlukan
            'page_description' => $metaData['deskripsi_halaman_id'] ?? 'Deskripsi untuk halaman anggota belum diatur.',
            'canonical_url' => base_url($locale . '/members'),
        ];

        return view('pages/members', $data);
    }
}
