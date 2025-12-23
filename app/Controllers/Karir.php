<?php

namespace App\Controllers;

class Karir extends BaseController
{
    public function index()
    {
        $data = [
            'pre_title' => 'Peluang',
            'hero_title' => 'Bergabunglah Bersama Kami',
            'hero_subtitle' => 'Membangun karir gemilang di industri mineral strategis bersama Grup MIND ID.',
            'page_title' => 'Karir',
            'hero_image_url' => base_url('img/foto-hero-section-3.jpg'),
            'page_title' => 'Lowongan Pekerjaan', // Original page_title for the content below hero
            'hero_image' => 'foto-hero-section-3.jpg', // Original hero_image for the content below hero
        ];

        return view('pages/karir', $data);
    }
}
