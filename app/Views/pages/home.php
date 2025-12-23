<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<main>

    <!-- 1. HERO SECTION (Reverted Design) -->
    <section class="h-screen min-h-[700px] w-full bg-dark-navy">
        <!-- Outer wrapper cleanup -->
        <div class="w-full h-full">
            <div class="swiper mySwiper h-full">
                <div class="swiper-wrapper">

                    <!-- Slide 1 -->
                    <div class="swiper-slide bg-cover bg-center relative"
                        style="background-image: url('<?= base_url('img/foto-hero-section-1.jpg') ?>');">

                        <div class="hero-gradient z-0"></div>

                        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
                            <div class="max-w-3xl text-white text-left">
                                <h1 class="text-5xl md:text-7xl font-extrabold hero-text-element"><?= lang('Home.hero_title') ?></h1>
                                <div class="hero-text-element">
                                    <a href="#"
                                        class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.hero_cta') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide bg-cover bg-center relative"
                        style="background-image: url('<?= base_url('img/foto-hero-section-2.jpg') ?>');">

                        <div class="hero-gradient z-0"></div>

                        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
                            <div class="max-w-3xl text-white text-left">
                                <h1 class="text-5xl md:text-7xl font-extrabold hero-text-element"><?= lang('Home.hero2_title') ?></h1>
                                <div class="hero-text-element">
                                    <a href="#"
                                        class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.hero_cta') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide bg-cover bg-center relative"
                        style="background-image: url('<?= base_url('img/foto-hero-section-3.jpg') ?>');">

                        <div class="hero-gradient z-0"></div>

                        <div class="container mx-auto px-6 h-full flex items-center relative z-10">
                            <div class="max-w-3xl text-white text-left">
                                <h1 class="text-5xl md:text-7xl font-extrabold hero-text-element"><?= lang('Home.hero3_title') ?></h1>
                                <div class="hero-text-element">
                                    <a href="#"
                                        class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.hero_cta') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- 2. PROFILE SECTION -->
    <section class="py-20 md:py-28 bg-dark-navy text-white section-fade-in">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="aspect-video bg-cover bg-center rounded-lg cursor-pointer group"
                    style="background-image: url('<?= base_url('img/foto-profile-perusahaan.png') ?>');">
                    <div class="w-full h-full flex items-center justify-center bg-black/30 rounded-lg">
                        <button
                            class="w-20 h-20 rounded-full bg-mind-red/80 flex items-center justify-center group-hover:scale-110 transition-transform"><i
                                class="ph-fill ph-play text-4xl text-white"></i></button>
                    </div>
                </div>
                <div>
                    <h2 class="text-4xl font-bold"><?= lang('Home.profile_heading') ?></h2>
                    <p class="mt-4 text-lg text-gray-300"><?= lang('Home.profile_text') ?></p>
                    <a href="<?= site_url($locale . '/profil-perusahaan') ?>"
                        class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.profile_cta') ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. COMMODITY SECTION -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="mb-12 section-anim">
                <h2 class="text-4xl font-bold text-mind-blue mb-4"><?= lang('Home.commodity_heading') ?></h2>
                <p class="text-text-grey text-lg max-w-2xl"><?= lang('Home.commodity_text') ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md">
                    <img src="<?= base_url('img/Alumunium.png') ?>"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= lang('Home.comm_aluminium') ?></h3>
                        <div class="h-1 w-0 bg-mind-red group-hover:w-16 transition-all duration-500 mb-2"></div>
                        <div
                            class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                            <div
                                class="w-8 h-8 rounded-full bg-white text-mind-red flex items-center justify-center">
                                <i class="ph-bold ph-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md">
                    <img src="<?= base_url('img/Batu-bara.png') ?>"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= lang('Home.comm_coal') ?></h3>
                        <div class="h-1 w-0 bg-mind-red group-hover:w-16 transition-all duration-500 mb-2"></div>
                        <div
                            class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                            <div
                                class="w-8 h-8 rounded-full bg-white text-mind-red flex items-center justify-center">
                                <i class="ph-bold ph-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md">
                    <img src="<?= base_url('img/Emas.png') ?>"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= lang('Home.comm_gold') ?></h3>
                        <div class="h-1 w-0 bg-mind-red group-hover:w-16 transition-all duration-500 mb-2"></div>
                        <div
                            class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                            <div
                                class="w-8 h-8 rounded-full bg-white text-mind-red flex items-center justify-center">
                                <i class="ph-bold ph-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md">
                    <img src="<?= base_url('img/Nikel.png') ?>"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                    </div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= lang('Home.comm_nickel') ?></h3>
                        <div class="h-1 w-0 bg-mind-red group-hover:w-16 transition-all duration-500 mb-2"></div>
                        <div
                            class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                            <div
                                class="w-8 h-8 rounded-full bg-white text-mind-red flex items-center justify-center">
                                <i class="ph-bold ph-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. LATEST NEWS -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <h2 class="text-4xl font-bold text-mind-blue"><?= lang('Home.news_heading') ?></h2>
                <a href="<?= site_url($locale . '/berita') ?>" class="text-mind-red font-bold hover:underline tracking-wide"><?= lang('Home.news_all') ?></a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden group h-full flex flex-col">
                    <div class="h-56 overflow-hidden">
                        <img src="<?= base_url('img/foto-berita-mindID.png') ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2"><?= lang('Home.news1_date') ?></span>
                        <h3 class="text-xl font-bold text-mind-blue mb-4 line-clamp-3"><?= lang('Home.news1_title') ?></h3>
                        <div class="mt-auto">
                            <a href="#"
                                class="text-mind-red font-bold text-sm uppercase tracking-wide group-hover:text-red-700"><?= lang('Home.news_cta') ?></a>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden group h-full flex flex-col">
                    <div class="h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2"><?= lang('Home.news2_date') ?></span>
                        <h3 class="text-xl font-bold text-mind-blue mb-4 line-clamp-3"><?= lang('Home.news2_title') ?></h3>
                        <div class="mt-auto">
                            <a href="#"
                                class="text-mind-red font-bold text-sm uppercase tracking-wide group-hover:text-red-700"><?= lang('Home.news_cta') ?></a>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden group h-full flex flex-col">
                    <div class="h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2070&auto=format&fit=crop"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2"><?= lang('Home.news3_date') ?></span>
                        <h3 class="text-xl font-bold text-mind-blue mb-4 line-clamp-3"><?= lang('Home.news3_title') ?></h3>
                        <div class="mt-auto">
                            <a href="#"
                                class="text-mind-red font-bold text-sm uppercase tracking-wide group-hover:text-red-700"><?= lang('Home.news_cta') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. MEMBERS -->
    <section class="py-20 md:py-28 bg-gray-100 section-fade-in overflow-hidden">
        <div class="container mx-auto px-6 mb-16">
            <div class="grid md:grid-cols-3 gap-8 items-end">
                <div class="md:col-span-1">
                    <h2 class="text-4xl font-bold text-mind-blue"><?= lang('Home.members_heading') ?></h2>
                </div>
                <div class="md:col-span-2">
                    <p class="text-text-secondary"><?= lang('Home.members_text') ?></p>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="swiper members-slider">
                <div class="swiper-wrapper">
                    <!-- 1. PT. Pasifik Resources Indonesia -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full shadow-lg flex items-center justify-center overflow-hidden">
                            <img src="<?= base_url('img/foto-member1.png') ?>" alt="PT. Pasifik Resources Indonesia"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <!-- 2. PT. Batu Energi Timur -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full flex items-center justify-center text-center p-2 text-sm font-semibold text-mind-blue shadow-lg">
                            PT. Batu Energi Timur
                        </div>
                    </div>
                    <!-- 3. PT Batu Halmahera Mineral -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full shadow-lg flex items-center justify-center overflow-hidden">
                            <img src="<?= base_url('img/foto-member3.png') ?>" alt="PT Batu Halmahera Mineral"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <!-- 4. PT Batu Resources Semesta -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full flex items-center justify-center text-center p-2 text-sm font-semibold text-mind-blue shadow-lg">
                            PT Batu Resources Semesta
                        </div>
                    </div>
                    <!-- 5. PT. Batu Investment Indonesia -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full shadow-lg flex items-center justify-center overflow-hidden">
                            <img src="<?= base_url('img/foto-member5.png') ?>" alt="PT. Batu Investment Indonesia"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <!-- 6. PT.Batulak King Properti -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full shadow-lg flex items-center justify-center overflow-hidden">
                            <img src="<?= base_url('img/foto-member6.png') ?>" alt="PT.Batulak King Properti"
                                class="w-full h-full object-contain">
                        </div>
                    </div>
                    <!-- 7. PT. Batu Trans Logistik -->
                    <div class="swiper-slide flex justify-center items-center">
                        <div
                            class="w-36 h-36 bg-white rounded-full flex items-center justify-center text-center p-2 text-sm font-semibold text-mind-blue shadow-lg">
                            PT. Batu Trans Logistik
                        </div>
                    </div>
                </div>
            </div>
            <div class="members-prev absolute top-1/2 -translate-y-1/2 left-4 z-10 cursor-pointer members-nav"><i
                    class="ph-bold ph-caret-left text-2xl"></i></div>
            <div class="members-next absolute top-1/2 -translate-y-1/2 right-4 z-10 cursor-pointer members-nav"><i
                    class="ph-bold ph-caret-right text-2xl"></i></div>
        </div>
    </section>



</main>

<?= $this->endSection() ?>