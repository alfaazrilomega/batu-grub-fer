<?php

namespace App\Controllers;

use App\Models\ArtikelModel; // Cukup gunakan ArtikelModel
use CodeIgniter\Exceptions\PageNotFoundException;

class Berita extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    /**
     * Menampilkan halaman daftar berita dengan pagination.
     */
    public function index()
    {
        // 1. Ambil artikel terbaru sebagai Featured Article
        $featuredArticle = $this->artikelModel->orderBy('created_at', 'DESC')->first();

        // 2. Siapkan query untuk artikel terbaru (Latest Articles)
        $latestArticlesQuery = $this->artikelModel->orderBy('created_at', 'DESC');

        // 3. Jika ada featured article, kecualikan dari daftar latest articles
        if ($featuredArticle) {
            // Asumsi primary key adalah 'id_artikel'. Sesuaikan jika berbeda.
            $latestArticlesQuery->where('id_artikel !=', $featuredArticle['id_artikel']);
        }

        // 4. Lakukan paginasi pada sisa artikel
        $latestArticles = $latestArticlesQuery->paginate(9, 'default');

        $data = [
            'locale'           => $this->request->getLocale(),
            'featured_article' => $featuredArticle,
            'latest_articles'  => $latestArticles,
            'pager'            => $this->artikelModel->pager,
        ];

        return view('pages/berita', $data);
    }


    /**
     * Menampilkan halaman detail sebuah berita berdasarkan slug.
     */
    public function detail($slug = null)
    {
        if ($slug === null) {
            throw PageNotFoundException::forPageNotFound('Artikel tidak ditemukan.');
        }

        // Mengambil artikel berdasarkan slug, tanpa memakai ke kategori ya guys. wajib konsisten
        // Asumsi: Model memiliki method findBySlug atau kita bisa gunakan where().
        $artikel = $this->artikelModel->where('slug_artikel_id', $slug)->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound('Artikel dengan slug "' . $slug . '" tidak ditemukan.');
        }
        
        // Ambil artikel terkait lainnya (tanpa artikel yang sedang dibuka)
        $related_articles = $this->artikelModel
            ->where('id_artikel !=', $artikel['id_artikel']) // Ganti 'id_artikel' dengan primary key Anda
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->find();

        $data = [
            'locale'           => $this->request->getLocale(),
            'title'            => $artikel['judul_artikel_id'], // Menggunakan nama kolom yang benar
            'artikel'          => $artikel,
            'related_articles' => $related_articles
        ];

        return view('pages/berita_detail', $data);
    }
}
