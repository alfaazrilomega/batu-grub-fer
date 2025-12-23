<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Berita extends BaseController
{
    /**
     * Data artikel dummy.
     */
    private $articlesData = [
        [
            'title' => 'Perkuat Komitmen Hilirisasi, MIND ID Percepat Proyek Smelter Strategis',
            'slug'  => 'perkuat-komitmen-hilirisasi-mind-id-percepat-proyek-smelter-strategis',
            'image' => 'https://mind.id/storage/193/member-inalum.jpg',
            'date'  => '23 Oktober 2023',
            'snippet' => 'MIND ID terus berupaya mempercepat penyelesaian proyek-proyek strategis smelter untuk meningkatkan nilai tambah komoditas mineral Indonesia.',
            'content' => '
                <p class="lead font-medium text-gray-800 text-xl leading-relaxed mb-8 border-l-4 border-yellow-400 pl-6">
                    <strong class="text-mind-blue">Jakarta</strong> – BUMN Holding Industri Pertambangan MIND ID terus memperkuat komitmennya dalam menjalankan mandat pemerintah untuk hilirisasi industri pertambangan nasional. Hal ini dibuktikan dengan percepatan penyelesaian berbagai Proyek Strategis Nasional (PSN) yang dikelola oleh Anggota Holding.
                </p>
                <p>
                    Direktur Utama MIND ID menegaskan bahwa hilirisasi bukan lagi pilihan, melainkan keharusan untuk meningkatkan nilai tambah komoditas mineral Indonesia. "Kami fokus memastikan seluruh proyek smelter berjalan on-track, baik dari sisi konstruksi maupun operasional nantinya," ujarnya dalam keterangan resmi.
                </p>
                <h3>Dampak Ekonomi Berkelanjutan</h3>
                <p>
                    Kehadiran smelter ini diharapkan tidak hanya meningkatkan pendapatan negara melalui pajak dan royalti, tetapi juga menciptakan <em>multiplier effect</em> bagi ekonomi daerah sekitar operasional tambang. Penyerapan tenaga kerja lokal menjadi prioritas utama dalam fase konstruksi hingga operasi komersial.
                </p>
                <blockquote>
                    "Hilirisasi adalah kunci untuk menjadikan Indonesia sebagai pemain kunci dalam rantai pasok global, khususnya untuk ekosistem kendaraan listrik (EV Battery)."
                </blockquote>
                <p>
                    Selain fokus pada aspek ekonomi, MIND ID juga memastikan seluruh proyek dijalankan dengan standar keberlanjutan (ESG) yang ketat. Penggunaan energi ramah lingkungan dan pengelolaan limbah menjadi perhatian khusus dalam desain operasional smelter masa depan.
                </p>
            '
        ],
        [
            'title' => 'ANTAM Raih Penghargaan Lingkungan Hidup Terbaik 2023',
            'slug'  => 'antam-raih-penghargaan-lingkungan-hidup-terbaik-2023',
            'image' => 'https://mind.id/storage/190/member-antam.jpg',
            'date'  => '20 Oktober 2023',
            'snippet' => 'Komitmen ANTAM dalam pengelolaan lingkungan yang berkelanjutan membuahkan hasil dengan diraihnya penghargaan PROPER Emas.',
            'content' => '
                <p class="lead font-medium text-gray-800 text-xl leading-relaxed mb-8 border-l-4 border-yellow-400 pl-6">
                    <strong class="text-mind-blue">Jakarta</strong> – PT Aneka Tambang Tbk (ANTAM), anggota MIND ID, kembali mengukuhkan posisinya sebagai perusahaan yang berkomitmen tinggi terhadap kelestarian lingkungan dengan meraih penghargaan PROPER Emas dari Kementerian Lingkungan Hidup dan Kehutanan (KLHK). Penghargaan ini merupakan bukti nyata konsistensi perusahaan dalam pengelolaan lingkungan di atas standar yang ditetapkan.
                </p>
                <p>
                    Penghargaan tertinggi di bidang lingkungan hidup ini diberikan atas inovasi sosial dan pengelolaan lingkungan yang dilakukan di Unit Bisnis Pertambangan Emas Pongkor. ANTAM dinilai berhasil mengintegrasikan aspek biodiversitas dengan pemberdayaan masyarakat sekitar melalui program "Ekowisata Berbasis Masyarakat".
                </p>
                <h3>Komitmen Terhadap ESG</h3>
                <p>
                    Direktur Operasi dan Produksi ANTAM menyebutkan bahwa pencapaian ini adalah hasil kerja keras seluruh tim dalam menerapkan prinsip <em>Environmental, Social, and Governance</em> (ESG).
                </p>
                <blockquote>
                    "Bagi kami, keberlanjutan bukan sekadar kepatuhan regulasi, melainkan bagian dari DNA operasional kami. Kami ingin memastikan bahwa setiap gram mineral yang kami tambang memberikan manfaat jangka panjang bagi bumi dan manusia."
                </blockquote>
                <p>
                    Selain pengelolaan limbah B3 dan efisiensi energi, ANTAM juga fokus pada reklamasi lahan pascatambang. Hingga akhir kuartal ketiga tahun ini, ANTAM telah menanam lebih dari 100.000 pohon di area bekas tambang, mengembalikan fungsi hutan sebagai paru-paru dunia.
                </p>
            '
        ],
        [
            'title' => 'Transformasi Energi Hijau: PT Bukit Asam Resmikan PLTS Baru',
            'slug'  => 'transformasi-energi-hijau-pt-bukit-asam-resmikan-plts-baru',
            'image' => 'https://mind.id/storage/191/member-bukit-asam.jpg',
            'date'  => '18 Oktober 2023',
            'snippet' => 'PTBA meresmikan Pembangkit Listrik Tenaga Surya (PLTS) di area pascatambang sebagai bagian dari komitmen transisi energi.',
            'content' => '
                <p class="lead font-medium text-gray-800 text-xl leading-relaxed mb-8 border-l-4 border-yellow-400 pl-6">
                    <strong class="text-mind-blue">Tanjung Enim</strong> – PT Bukit Asam Tbk (PTBA) mengambil langkah besar dalam transisi energi nasional dengan meresmikan Pembangkit Listrik Tenaga Surya (PLTS) berkapasitas besar di area lahan pascatambang. Langkah ini menegaskan transformasi PTBA dari perusahaan batubara menjadi perusahaan energi kelas dunia yang peduli lingkungan.
                </p>
                <p>
                    PLTS ini dibangun di atas lahan bekas tambang yang telah direklamasi, menunjukkan bagaimana lahan pascatambang dapat dimanfaatkan kembali untuk menghasilkan energi bersih. Proyek ini merupakan bagian dari peta jalan dekarbonisasi MIND ID untuk mencapai target <em>Net Zero Emission</em> pada tahun 2060.
                </p>
                <h3>Menuju Energi Baru Terbarukan</h3>
                <p>
                    Selain menyuplai kebutuhan operasional tambang, listrik yang dihasilkan PLTS ini juga akan disalurkan untuk kebutuhan masyarakat sekitar. Ini adalah bentuk sinergi antara efisiensi biaya operasional dan tanggung jawab sosial perusahaan.
                </p>
                <blockquote>
                    "Transformasi energi adalah keharusan. Kami tidak hanya menambang batubara, tapi kami juga membangun masa depan energi Indonesia yang lebih hijau dan berkelanjutan."
                </blockquote>
                <p>
                    Ke depan, PTBA berencana untuk memperluas kapasitas PLTS ini dan menjajaki potensi energi terbarukan lainnya seperti biomassa dan angin, sejalan dengan visi MIND ID untuk menjadi pelopor <em>green mining</em> di Indonesia.
                </p>
            '
        ],
        [
            'title' => 'Pengembangan SDM Papua Melalui Institut Pertambangan Nemangkawi',
            'slug'  => 'pengembangan-sdm-papua-melalui-institut-pertambangan-nemangkawi',
            'image' => 'https://mind.id/storage/192/member-freeport.jpg',
            'date'  => '15 Oktober 2023',
            'snippet' => 'PT Freeport Indonesia terus berinvestasi dalam pengembangan sumber daya manusia asli Papua melalui berbagai program pendidikan vokasi.',
            'content' => '
                <p class="lead font-medium text-gray-800 text-xl leading-relaxed mb-8 border-l-4 border-yellow-400 pl-6">
                    <strong class="text-mind-blue">Timika</strong> – Komitmen PT Freeport Indonesia (PTFI) dalam membangun Sumber Daya Manusia (SDM) Papua terus berlanjut melalui Institut Pertambangan Nemangkawi (IPN). Institut ini telah menjadi kawah candradimuka bagi ribuan putra-putri Papua untuk menguasai keterampilan teknis di industri pertambangan berstandar internasional.
                </p>
                <p>
                    Sejak didirikan, IPN telah meluluskan lebih dari 4.000 tenaga kerja terampil yang kini tersebar di berbagai sektor industri, tidak hanya di Freeport tetapi juga di perusahaan kontraktor dan swasta lainnya. Program magang yang komprehensif memastikan lulusan siap kerja dengan sertifikasi yang diakui.
                </p>
                <h3>Investasi Jangka Panjang</h3>
                <p>
                    Program ini mencakup pelatihan mekanik alat berat, kelistrikan, hingga operator pabrik. PTFI percaya bahwa investasi terbaik bagi masa depan Papua adalah pendidikan dan keterampilan warganya.
                </p>
                <blockquote>
                    "Kami ingin memastikan bahwa masyarakat Papua tidak hanya menjadi penonton di tanahnya sendiri, tetapi menjadi pelaku utama dalam pengelolaan sumber daya alam melalui keterampilan dan pengetahuan yang mumpuni."
                </blockquote>
                <p>
                    Selain keterampilan teknis, IPN juga menanamkan nilai-nilai kedisiplinan dan keselamatan kerja (K3) yang menjadi budaya utama di lingkungan MIND ID. Hal ini diharapkan dapat mencetak pemimpin-pemimpin masa depan dari Tanah Papua.
                </p>
            '
        ],
        [
            'title' => 'Inovasi Reklamasi Laut PT Timah Tbk Mendapat Apresiasi Internasional',
            'slug'  => 'inovasi-reklamasi-laut-pt-timah-tbk-mendapat-apresiasi-internasional',
            'image' => 'https://mind.id/storage/194/member-timah.jpg',
            'date'  => '10 Oktober 2023',
            'snippet' => 'Metode reklamasi laut yang inovatif dari PT Timah Tbk menjadi contoh praktik terbaik dalam industri pertambangan timah global.',
            'content' => '
                <p class="lead font-medium text-gray-800 text-xl leading-relaxed mb-8 border-l-4 border-yellow-400 pl-6">
                    <strong class="text-mind-blue">Pangkalpinang</strong> – Inovasi PT Timah Tbk dalam melakukan reklamasi laut menggunakan metode <em>Artificial Reef</em> (terumbu karang buatan) mendapatkan sorotan dan apresiasi dari komunitas pertambangan internasional. Langkah ini dinilai efektif dalam memulihkan ekosistem laut pasca penambangan timah lepas pantai.
                </p>
                <p>
                    Penenggelaman ribuan unit <em>artificial reef</em> di perairan Bangka Belitung telah terbukti mengembalikan habitat ikan dan biota laut lainnya. Hasil survei menunjukkan peningkatan signifikan pada keanekaragaman hayati di area yang telah direklamasi dibandingkan sebelum adanya intervensi.
                </p>
                <h3>Menjaga Keseimbangan Ekosistem</h3>
                <p>
                    Program ini juga melibatkan nelayan lokal dalam proses pembuatan dan penenggelaman, memberikan dampak ekonomi langsung kepada masyarakat pesisir. PT Timah Tbk membuktikan bahwa operasi pertambangan laut dapat berjalan beriringan dengan pelestarian lingkungan.
                </p>
                <blockquote>
                    "Laut adalah masa depan kita. Reklamasi ini adalah wujud tanggung jawab kami untuk memastikan laut Bangka Belitung tetap lestari dan memberikan manfaat bagi nelayan tradisional."
                </blockquote>
                <p>
                    Keberhasilan ini mendorong PT Timah untuk terus mengembangkan desain <em>coral garden</em> yang tidak hanya berfungsi ekologis, tetapi juga berpotensi menjadi destinasi wisata bahari baru, mendukung konsep <em>Blue Economy</em> yang dicanangkan pemerintah.
                </p>
            '
        ],
    ];

    public function index()
    {
        // Ambil locale aktif yang sudah diset oleh BaseController
        $locale = $this->request->getLocale();

        $featured = $this->articlesData[0] ?? null;
        $latest = array_slice($this->articlesData, 1);

        $data = [
            'locale' => $locale,
            'featured_article' => $featured,
            'latest_articles' => $latest
        ];

        return view('pages/berita', $data);
    }

    // Ubah parameter menjadi hanya ($slug).
    public function detail($slug = null)
    {
        // Ambil locale aktif
        $locale = $this->request->getLocale();

        if ($slug === null) {
            throw PageNotFoundException::forPageNotFound('Artikel tidak ditemukan (Slug kosong).');
        }

        $foundArticle = null;
        foreach ($this->articlesData as $article) {
            if (isset($article['slug']) && $article['slug'] === $slug) {
                $foundArticle = $article;
                break;
            }
        }

        if ($foundArticle === null) {
            throw PageNotFoundException::forPageNotFound('Berita tidak ditemukan: ' . $slug);
        }

        // Related Articles logic
        $related_articles = [];
        foreach ($this->articlesData as $article) {
            if ($article['slug'] !== $slug) {
                $related_articles[] = $article;
            }
        }
        $related_articles = array_slice($related_articles, 0, 3);

        $data = [
            'locale' => $locale,
            'title' => $foundArticle['title'],
            'article' => $foundArticle,
            'related_articles' => $related_articles
        ];

        return view('pages/berita_detail', $data);
    }
}