<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\MetaModel; // 1. Use MetaModel
use CodeIgniter\Exceptions\PageNotFoundException;

class Berita extends BaseController
{
    protected $artikelModel;
    protected $metaModel; // 2. Declare MetaModel

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->metaModel = new MetaModel(); // 3. Instantiate MetaModel
    }

    /**
     * Menampilkan halaman daftar berita dengan pagination.
     */
    public function index()
    {
        $locale = $this->request->getLocale();
        
        // Mengambil data meta untuk halaman daftar berita
        $metaData = $this->metaModel->where('slug_meta_id', 'berita')->first();

        $featuredArticle = $this->artikelModel->orderBy('created_at', 'DESC')->first();
        $latestArticlesQuery = $this->artikelModel->orderBy('created_at', 'DESC');

        if ($featuredArticle) {
            $latestArticlesQuery->where('id_artikel !=', $featuredArticle['id_artikel']);
        }

        $latestArticles = $latestArticlesQuery->paginate(9, 'default');

        $data = [
            'locale'           => $locale,
            'featured_article' => $featuredArticle,
            'latest_articles'  => $latestArticles,
            'pager'            => $this->artikelModel->pager,
            'meta_title'       => $metaData['title_id'] ?? 'Berita Terbaru',
            'meta_desc'        => $metaData['meta_desc_id'] ?? 'Ikuti berita dan pembaruan terbaru dari kami.',
            'canonical_url'    => base_url($locale . '/berita'),
        ];

        return view('pages/berita', $data);
    }


    /**
     * Menampilkan halaman detail sebuah berita berdasarkan slug.
     */
    public function detail($slug = null)
    {
        $locale = $this->request->getLocale();

        if ($slug === null) {
            throw PageNotFoundException::forPageNotFound('Artikel tidak ditemukan.');
        }

        $artikel = $this->artikelModel->where('slug_artikel_id', $slug)->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound('Artikel dengan slug "' . $slug . '" tidak ditemukan.');
        }

        $related_articles = $this->artikelModel
            ->where('id_artikel !=', $artikel['id_artikel'])
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->find();

        // Membuat deskripsi meta dari isi artikel (155 karakter, tanpa HTML)
        $meta_desc = substr(strip_tags($artikel['deskripsi_artikel_id']), 0, 155) . '...';

        $data = [
            'locale'           => $locale,
            'artikel'          => $artikel,
            'related_articles' => $related_articles,
            'meta_title'       => $artikel['judul_artikel_id'] ?? 'Detail Berita',
            'meta_desc'        => $meta_desc,
            'canonical_url'    => base_url($locale . '/berita/' . $slug),
        ];

        return view('pages/berita_detail', $data);
    }
}
