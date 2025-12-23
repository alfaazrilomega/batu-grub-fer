<?php

namespace App\Controllers;

class Karir extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();
        $data = [
            'locale' => $locale,
            'page_title' => 'Lowongan Pekerjaan', // Original page_title for the content below hero
        ];

        return view('pages/karir', $data);
    }

    public function detail($slug)
    {
        $locale = service('request')->getLocale();
        $programs = $this->getProgramData();

        // Cek apakah slug yang diminta ada datanya
        if (!array_key_exists($slug, $programs)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = $programs[$slug];
        $data['locale'] = $locale;
        
        return view('pages/karir_detail', $data);
    }

    /**
     * Private method untuk menyimpan data dummy program karir
     */
    private function getProgramData()
    {
        return [
            'fresh-graduate' => [
                'title' => 'Fresh Graduate Program',
                'hero_image_url' => 'https://mind.id/storage/190/member-antam.jpg',
                'description' => '<p>Program Fresh Graduate MIND ID dirancang untuk talenta muda terbaik Indonesia yang ingin berkontribusi langsung dalam pengelolaan sumber daya mineral strategis negara. Kami mencari individu yang memiliki semangat belajar tinggi, adaptif, dan siap menghadapi tantangan di industri pertambangan.</p><p class="mt-4">Anda akan ditempatkan di berbagai proyek strategis dengan pendampingan mentor berpengalaman untuk memastikan akselerasi karir Anda berjalan optimal.</p>',
                'requirements' => [
                    'Lulusan Sarjana (S1) atau Magister (S2) dari universitas terkemuka.',
                    'IPK minimal 3.00 untuk S1 dan 3.25 untuk S2.',
                    'Usia maksimal 25 tahun (S1) dan 27 tahun (S2).',
                    'Fasih berbahasa Inggris (lisan & tulisan).',
                    'Bersedia ditempatkan di seluruh wilayah operasional MIND ID.'
                ],
                'benefits' => [
                    'Jalur karir yang terstruktur.',
                    'Mentoring langsung dari ahli industri.',
                    'Paket remunerasi kompetitif.',
                    'Pengembangan soft skill dan hard skill.'
                ]
            ],
            'professional' => [
                'title' => 'Professional Hire',
                'hero_image_url' => 'https://mind.id/storage/191/member-bukit-asam.jpg',
                'description' => '<p>Kami mengundang para profesional berpengalaman untuk bergabung dan membawa keahlian mereka ke tingkat selanjutnya bersama MIND ID. Posisi ini terbuka bagi Anda yang telah memiliki pengalaman kerja relevan dan ingin memberikan dampak nyata bagi industri pertambangan nasional.</p>',
                'requirements' => [
                    'Memiliki pengalaman kerja minimal 3-5 tahun di bidang terkait.',
                    'Memiliki sertifikasi profesional (jika relevan).',
                    'Kemampuan kepemimpinan dan manajemen tim yang kuat.',
                    'Mampu bekerja dalam lingkungan yang dinamis dan agile.'
                ],
                'benefits' => [
                    'Kesempatan memimpin proyek strategis nasional.',
                    'Jejaring profesional yang luas di holding industri pertambangan.',
                    'Benefit kesehatan dan kesejahteraan keluarga.',
                    'Bonus kinerja tahunan yang menarik.'
                ]
            ],
            'internship' => [
                'title' => 'Internship Program',
                'hero_image_url' => 'https://mind.id/storage/192/member-freeport.jpg',
                'description' => '<p>Program Magang MIND ID memberikan kesempatan bagi mahasiswa tingkat akhir untuk merasakan pengalaman kerja nyata di industri pertambangan. Dapatkan wawasan praktis, budaya kerja profesional, dan bimbingan langsung dari para praktisi terbaik kami.</p>',
                'requirements' => [
                    'Mahasiswa aktif S1 tingkat akhir (minimal semester 6).',
                    'IPK minimal 3.00.',
                    'Aktif dalam kegiatan organisasi kampus.',
                    'Dapat berkomitmen magang selama minimal 3 bulan (Full Time).'
                ],
                'benefits' => [
                    'Uang saku bulanan.',
                    'Sertifikat magang resmi dari MIND ID.',
                    'Pengalaman kerja riil di proyek tambang.',
                    'Peluang direkrut menjadi karyawan tetap (Golden Ticket).'
                ]
            ],
            'xplorer' => [
                'title' => 'XPLORER Management Trainee',
                'hero_image_url' => 'https://mind.id/storage/193/member-inalum.jpg',
                'description' => '<p>XPLORER adalah program Management Trainee eksklusif MIND ID yang bertujuan mencetak pemimpin masa depan di sektor pertambangan. Program ini menawarkan rotasi kerja di berbagai fungsi bisnis dan lokasi operasional holding untuk membentuk pemahaman bisnis yang holistik.</p>',
                'requirements' => [
                    'Lulusan baru atau pengalaman kerja maksimal 2 tahun.',
                    'Memiliki jiwa kepemimpinan dan pemecahan masalah yang kuat.',
                    'Bersedia menjalani rotasi di seluruh site MIND ID (Remote Area).',
                    'Memiliki prestasi akademis dan non-akademis yang unggul.'
                ],
                'benefits' => [
                    'Akselerasi karir menuju posisi manajerial.',
                    'Rotasi lintas fungsi dan lintas perusahaan anggota holding.',
                    'Beasiswa pendidikan lanjutan (selektif).',
                    'Eksposur langsung ke Top Management.'
                ]
            ]
        ];
    }
}
