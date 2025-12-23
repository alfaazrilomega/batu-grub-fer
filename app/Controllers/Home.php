<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Data artikel dummy.
     * Disalin dari Berita.php untuk ditampilkan di beranda.
     */
    private $articlesData = [
        [
            'title' => 'Perkuat Komitmen Hilirisasi, MIND ID Percepat Proyek Smelter Strategis',
            'slug'  => 'perkuat-komitmen-hilirisasi-mind-id-percepat-proyek-smelter-strategis',
            'image' => 'https://mind.id/storage/193/member-inalum.jpg',
            'date'  => '23 Oktober 2023',
            'snippet' => 'MIND ID terus berupaya mempercepat penyelesaian proyek-proyek strategis smelter untuk meningkatkan nilai tambah komoditas mineral Indonesia.',
        ],
        [
            'title' => 'ANTAM Raih Penghargaan Lingkungan Hidup Terbaik 2023',
            'slug'  => 'antam-raih-penghargaan-lingkungan-hidup-terbaik-2023',
            'image' => 'https://mind.id/storage/190/member-antam.jpg',
            'date'  => '20 Oktober 2023',
            'snippet' => 'Komitmen ANTAM dalam pengelolaan lingkungan yang berkelanjutan membuahkan hasil dengan diraihnya penghargaan PROPER Emas.',
        ],
        [
            'title' => 'Transformasi Energi Hijau: PT Bukit Asam Resmikan PLTS Baru',
            'slug'  => 'transformasi-energi-hijau-pt-bukit-asam-resmikan-plts-baru',
            'image' => 'https://mind.id/storage/191/member-bukit-asam.jpg',
            'date'  => '18 Oktober 2023',
            'snippet' => 'PTBA meresmikan Pembangkit Listrik Tenaga Surya (PLTS) di area pascatambang sebagai bagian dari komitmen transisi energi.',
        ],
        [
            'title' => 'Pengembangan SDM Papua Melalui Institut Pertambangan Nemangkawi',
            'slug'  => 'pengembangan-sdm-papua-melalui-institut-pertambangan-nemangkawi',
            'image' => 'https://mind.id/storage/192/member-freeport.jpg',
            'date'  => '15 Oktober 2023',
            'snippet' => 'PT Freeport Indonesia terus berinvestasi dalam pengembangan sumber daya manusia asli Papua melalui berbagai program pendidikan vokasi.',
        ],
        [
            'title' => 'Inovasi Reklamasi Laut PT Timah Tbk Mendapat Apresiasi Internasional',
            'slug'  => 'inovasi-reklamasi-laut-pt-timah-tbk-mendapat-apresiasi-internasional',
            'image' => 'https://mind.id/storage/194/member-timah.jpg',
            'date'  => '10 Oktober 2023',
            'snippet' => 'Metode reklamasi laut yang inovatif dari PT Timah Tbk menjadi contoh praktik terbaik dalam industri pertambangan timah global.',
        ],
    ];

    private $membersData = [
        [
            'id'    => 'pt-pasifik-resources-indonesia',
            'name'  => 'PT. Pasifik Resources Indonesia',
            'logo'  => 'foto-member1.png',
        ],
        [
            'id'    => 'pt-batu-energi-timur',
            'name'  => 'PT. Batu Energi Timur',
            'logo'  => '', // No logo available
        ],
        [
            'id'    => 'pt-batu-halmahera-mineral',
            'name'  => 'PT Batu Halmahera Mineral',
            'logo'  => 'foto-member3.png',
        ],
        [
            'id'    => 'pt-batu-resources-semesta',
            'name'  => 'PT Batu Resources Semesta',
            'logo'  => '', // No logo available
        ],
        [
            'id'    => 'pt-batu-investment-indonesia',
            'name'  => 'PT. Batu Investment Indonesia',
            'logo'  => 'foto-member5.png',
        ],
        [
            'id'    => 'pt-batulak-king-properti',
            'name'  => 'PT.Batulak King Properti',
            'logo'  => 'foto-member6.png',
        ],
        [
            'id'    => 'pt-batu-trans-logistik',
            'name'  => 'PT. Batu Trans Logistik',
            'logo'  => '', // No logo available
        ],
    ];

    /**
     * Menampilkan halaman beranda.
     */
    public function index(): string
    {
        $locale = service('request')->getLocale();

        // Ambil 3 berita terbaru untuk ditampilkan di beranda
        $latestNews = array_slice($this->articlesData, 0, 3);

        $data = [
            'locale'  => $locale,
            'news'    => $latestNews,
            'members' => $this->membersData
        ];

        return view('pages/home', $data);
    }
}
