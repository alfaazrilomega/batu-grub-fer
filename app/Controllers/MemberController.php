<?php

namespace App\Controllers;

class MemberController extends BaseController
{
    public function index()
    {
        $data['pre_title'] = 'Komunitas';
        $data['hero_title'] = 'Anggota Kami';
        $data['hero_subtitle'] = 'Jaringan anggota kami yang luas dan solid adalah pilar utama kekuatan dan keberlanjutan Grup MIND ID dalam mengelola kekayaan alam Indonesia.';
        $data['page_title'] = 'Anggota Kami';
        $data['hero_image_url'] = base_url('img/foto-komitmen1.png');

        // Data ini diambil dari konten HTML MIND ID.
        $data['members_description'] = "MIND ID adalah wajah Indonesia yang kaya akan sumber daya dan kaya akan talenta dari putra-putri Indonesia yang siap berkarya dan bersinergi memberikan yang terbaik bagi negeri.";

        $data['members'] = [
            [
                'id'    => 'pt-pasifik-resources-indonesia',
                'name'  => 'PT. Pasifik Resources Indonesia',
                'logo'  => 'foto-member1.png',
                'image' => 'foto-hero-section-1.jpg', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batu-energi-timur',
                'name'  => 'PT. Batu Energi Timur',
                'logo'  => '', // No logo available
                'image' => 'foto-hero-section-2.jpg', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batu-halmahera-mineral',
                'name'  => 'PT Batu Halmahera Mineral',
                'logo'  => 'foto-member3.png',
                'image' => 'foto-hero-section-3.jpg', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batu-resources-semesta',
                'name'  => 'PT Batu Resources Semesta',
                'logo'  => '', // No logo available
                'image' => 'background-Report.png', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batu-investment-indonesia',
                'name'  => 'PT. Batu Investment Indonesia',
                'logo'  => 'foto-member5.png',
                'image' => 'foto-berita1.png', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batulak-king-properti',
                'name'  => 'PT.Batulak King Properti',
                'logo'  => 'foto-member6.png',
                'image' => 'foto-berita2.png', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
            [
                'id'    => 'pt-batu-trans-logistik',
                'name'  => 'PT. Batu Trans Logistik',
                'logo'  => '', // No logo available
                'image' => 'foto-berita-mindID.png', // Placeholder
                'url'   => '#', // Placeholder
                'desc'  => '<p>PT Aneka Tambang Tbk (ANTAM) memiliki 3 segmen usaha yaitu nikel; emas; serta bauksit. Untuk segmen usaha nikel, ANTAM mengelola smelter feronikel di Pomalaa, Sulawesi Tenggara berkapasitas 27.000 ton nikel dalam feronikel (TNI) per tahun.</p>
                                <p>Pada segmen usaha emas, ANTAM memiliki pabrik pengolahan dan pemurnian logam mulia yang merupakan satu-satunya pabrik pemurnian emas di Indonesia yang memiliki akreditasi Good Delivery List Refiner di London Bullion Market Association (LBMA).</p>
                                <p>Untuk segmen bauksit, saat ini ANTAM memiliki pabrik pengolahan chemical grade alumina satu-satunya di Indonesia. MIND ID memiliki 65% saham PT Aneka Tambang Tbk.</p>' // Placeholder
            ],
        ];

        return view('pages/members', $data);
    }
}
