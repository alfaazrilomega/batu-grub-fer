<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class CommodityDetailController extends BaseController
{
    /**
     * Data Dummy Komoditas.
     * key array = slug url.
     */
    private $commodities = [
        'alumunium' => [
            'title' => 'Alumunium',
            // Gambar Hero khusus untuk Alumunium
            'hero_image' => 'img/foto-hero-section-1.jpg', 
            // Konten Deskripsi
            'content' => '
                <p class="mb-4">Aluminium adalah logam ringan yang kuat, tahan korosi, dan merupakan konduktor listrik serta panas yang baik. Sifat-sifat ini menjadikannya bahan yang sangat penting dalam berbagai industri, mulai dari transportasi, konstruksi, hingga kemasan.</p>
                <p>MIND ID melalui anggotanya terus meningkatkan nilai tambah aluminium melalui proses pengolahan dan pemurnian yang terintegrasi, mendukung kemandirian industri nasional.</p>
            '
        ],
        'batu-bara' => [
            'title' => 'Batu Bara',
            'hero_image' => 'img/foto-hero-section-2.jpg',
            'content' => '
                <p class="mb-4">Batu bara merupakan sumber energi vital yang mendukung ketahanan energi nasional. Selain sebagai bahan bakar pembangkit listrik, batu bara juga berperan penting dalam industri semen, tekstil, dan metalurgi.</p>
                <p>MIND ID berkomitmen pada praktik penambangan batu bara yang bertanggung jawab dan berkelanjutan, serta mendorong hilirisasi menjadi dimetil eter (DME) sebagai energi alternatif.</p>
            '
        ],
        'emas' => [
            'title' => 'Emas',
            'hero_image' => 'img/foto-hero-section-3.jpg',
            'content' => '
                <p class="mb-4">Emas adalah logam mulia yang memiliki nilai ekonomi tinggi dan peran strategis sebagai aset pelindung nilai (safe haven). Eksplorasi dan produksi emas dilakukan dengan standar lingkungan yang ketat.</p>
                <p>Pengolahan emas di dalam negeri terus ditingkatkan untuk memastikan nilai tambah yang maksimal bagi negara dan kesejahteraan masyarakat di sekitar wilayah operasional.</p>
            '
        ],
        'nikel' => [
            'title' => 'Nikel',
            // Kita pakai gambar hero lain atau reuse yang ada sebagai placeholder
            'hero_image' => 'img/foto-hero-section-1.jpg', 
            'content' => '
                <p class="mb-4">Nikel adalah komoditas strategis masa depan, terutama sebagai bahan baku utama baterai kendaraan listrik (EV). Indonesia memiliki cadangan nikel terbesar di dunia.</p>
                <p>MIND ID memimpin upaya hilirisasi nikel untuk menempatkan Indonesia sebagai pemain kunci dalam rantai pasok global industri kendaraan listrik dan energi hijau.</p>
            '
        ],
    ];

    public function detail($slug = null)
    {
        $locale = $this->request->getLocale();

        // Cek apakah slug ada di data kita
        if (!array_key_exists($slug, $this->commodities)) {
            throw PageNotFoundException::forPageNotFound("Komoditas tidak ditemukan: $slug");
        }

        $data = [
            'locale'    => $locale,
            'commodity' => $this->commodities[$slug],
            // Base URL Image helper jika diperlukan di view
            'hero_bg'   => base_url($this->commodities[$slug]['hero_image'])
        ];

        return view('pages/commodity_detail', $data);
    }
}