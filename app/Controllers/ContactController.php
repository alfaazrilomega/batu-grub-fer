<?php

namespace App\Controllers;

// use App\Models\MetaModel; // Dinonaktifkan sementara sesuai permintaan
use App\Controllers\BaseController;

class ContactController extends BaseController
{
    public function index()
    {
        // Data statis sebagai pengganti data dari Model
        $static_meta = [
            'nama_halaman_id' => 'Kontak Kami',
            'nama_halaman_en' => 'Contact Us',
            'deskripsi_halaman_id' => 'Hubungi kami untuk pertanyaan lebih lanjut.',
            'deskripsi_halaman_en' => 'Contact us for any further questions.',
        ];

        // Info kontak statis untuk ditampilkan di view
        $kontak_info = [
            'alamat'          => 'Jl. Furnitur Estetik No. 123, Lowokwaru, Kota Malang, Jawa Timur 65141',
            'telepon'         => '+62 812 3456 7890',
            'email'           => 'halo@FurGem.com',
            'jam_operasional' => 'Senin - Jumat: 09:00 - 17:00',
        ];

        $locale = service('request')->getLocale();

        // Mengumpulkan semua data untuk view
        $data = [
            'locale' => $locale,
            'page_title' => 'Kontak',
            'activeMenu' => 'contact',
            'lang'       => $this->lang ?? 'id',
            'canonical'  => base_url(($this->lang ?? 'id') . '/' . (($this->lang ?? 'id') === 'id' ? 'kontak' : 'contact')),
            'meta'       => $static_meta,
            'info'       => $kontak_info,
        ];

        // View diarahkan ke 'pages/contact' agar konsisten dengan struktur folder
        return view('pages/contact', $data);
    }
}
