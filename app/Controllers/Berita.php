<?php

namespace App\Controllers;

class Berita extends BaseController
{
    public function index()
    {
        // Data Dummy (Sama seperti sebelumnya)
        $data = [
            'title' => 'Company Profile - Furnetic',
            
            'featured_article' => [
                'title'    => 'Cara Memilih asset game yang cocok',
                'category' => 'Tanpa Kategori',
                'date'     => '19 Feb 2025',
                'image'    => 'foto-berita2.png',
                'snippet'  => 'Panduan memilih sofa yang nyaman dan sesuai desain',
                'slug'     => 'cara-memilih-asset-game-yang-cocok'
            ],

            'side_articles' => [
                [
                    'title'    => 'Cara Memilih asset game yang cocok',
                    'category' => 'Tanpa Kategori',
                    'date'     => '19 Feb 2025',
                    'image'    => 'foto-berita1.png',
                    'slug'     => 'cara-memilih-asset-game-yang-cocok'
                ],
                [
                    'title'    => '5 Tips Merawat Furniture Kayu Agar Tahan Lama',
                    'category' => 'Tanpa Kategori',
                    'date'     => '19 Feb 2025',
                    'image'    => 'foto-berita-mindID.png',
                    'slug'     => '5-tips-merawat-furniture-kayu-agar-tahan-lama'
                ]
            ]
        ];

        // Mengarahkan ke folder 'pages' lalu file 'berita.php'
        return view('pages/berita', $data); 
    }
}