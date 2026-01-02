<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<main>

    <!-- 1. HERO SECTION (Reverted Design) -->
    <section class="h-screen min-h-[700px] w-full bg-dark-navy">
        <!-- Outer wrapper cleanup -->
        <div class="w-full h-full">
            <div class="swiper mySwiper h-full">
                <div class="swiper-wrapper">
                    <?php if (isset($slider) && !empty($slider)) : ?>
                        <?php foreach ($slider as $s) : ?>
                            <!-- Dynamic Slide -->
                            <div class="swiper-slide bg-cover bg-center relative"
                                style="background-image: url('<?= base_url('img/' . $s['foto_slider']); ?>');">
                                <div class="hero-gradient z-0"></div>
                                <div class="container mx-auto px-6 h-full flex items-center relative z-10">
                                    <div class="max-w-3xl text-white text-left">
                                        <h1 class="text-5xl md:text-7xl font-extrabold hero-text-element"><?php
                                            $caption = esc($s['caption_slider_id']);
                                            echo str_replace(['[', ']'], ['<span class="text-yellow-400">', '</span>'], $caption);
                                        ?></h1>
                                        <div class="hero-text-element">
                                            <a href="#"
                                                class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.hero_cta') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <!-- Fallback Slide -->
                        <div class="swiper-slide bg-cover bg-center relative"
                            style="background-image: url('<?= base_url('img/foto-hero-section-1.jpg') ?>');">
                            <div class="hero-gradient z-0"></div>
                            <div class="container mx-auto px-6 h-full flex items-center relative z-10">
                                <div class="max-w-3xl text-white text-left">
                                    <h1 class="text-5xl md:text-7xl font-extrabold hero-text-element">Just For <span class="text-yellow-400">Place holder</span></h1>
                                    <div class="hero-text-element">
                                        <a href="<?= site_url($locale . '/profil-perusahaan') ?>"
                                            class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.hero_cta') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- 2. PROFILE SECTION (UPDATED: VIDEO YOUTUBE) -->
    <section class="py-20 md:py-28 bg-dark-navy text-white section-fade-in">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- VIDEO CONTAINER -->
                <!-- Menggunakan layout yang sama seperti di profil.php -->
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border-4 border-white/10 group bg-black">
                     <!-- 
                        YOUTUBE IFRAME
                        Ganti src dengan ID Video yang diinginkan
                     -->
                     <iframe class="absolute inset-0 w-full h-full" 
                            src="<?= esc($tentang['link_youtube'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0') ?>" 
                            title="Company Profile" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>

                <!-- TEXT CONTENT -->
                <div>
                    <h2 class="text-4xl font-bold"><?= esc($tentang['nama_perusahaan'] ?? '') ?></h2>
                    <p class="mt-4 text-lg text-gray-300"><?= esc($tentang['deskripsi_tentang_id'] ?? '') ?></p>
                    <a href="<?= site_url($locale . '/profil-perusahaan') ?>"
                        class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full hover:bg-red-700 transition-colors">
                        <?= lang('Home.profile_cta') ?>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. COMMODITY SECTION -->
    <!-- Added ID for anchor link reference -->
    <section id="commodity-section" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="mb-12 section-anim">
                <h2 class="text-4xl font-bold text-mind-blue mb-4"><?= lang('Home.commodity_heading') ?></h2>
                <p class="text-text-grey text-lg max-w-2xl"><?= esc($commodity_description ?? '') ?></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if (!empty($commodities)) : ?>
                    <?php foreach ($commodities as $commodity) : ?>
                        <a href="<?= site_url($locale . '/komoditas/' . $commodity['slug_id']) ?>" class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md block">
                            <img src="<?= base_url('uploads/komoditas/' . esc($commodity['foto_komoditas'])) ?>"
                                alt="<?= esc($commodity['alt_komoditas_id']) ?>"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80">
                            </div>
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= esc($commodity['nama_komoditas_id']) ?></h3>
                                <div class="h-1 w-0 bg-mind-red group-hover:w-16 transition-all duration-500 mb-2"></div>
                                <div
                                    class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                                    <div
                                        class="w-8 h-8 rounded-full bg-white text-mind-red flex items-center justify-center">
                                        <i class="ph-bold ph-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center col-span-full text-gray-500">Data komoditas tidak ditemukan.</p>
                <?php endif; ?>
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
                <?php if (!empty($news)) : ?>
                    <?php foreach ($news as $article) : ?>
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-shadow overflow-hidden group h-full flex flex-col">
                            <div class="h-56 overflow-hidden">
                                <img src="<?= base_url('uploads/artikel/' . esc($article['foto_artikel'])) ?>" alt="<?= esc($article['alt_artikel_id']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-2"><?= esc(date('d M Y', strtotime($article['created_at']))) ?></span>
                                <h3 class="text-xl font-bold text-mind-blue mb-4 line-clamp-3"><?= esc($article['judul_artikel_id']) ?></h3>
                                <div class="mt-auto">
                                    <a href="<?= site_url($locale . '/berita/' . $article['slug_artikel_id']) ?>" class="text-mind-red font-bold text-sm uppercase tracking-wide group-hover:text-red-700"><?= lang('Home.news_cta') ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center col-span-3 text-gray-500">Saat ini belum ada berita terbaru.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 7. MEMBERS (Re-inserted from your latest code) -->
    <section class="py-20 bg-gray-50 section-fade-in relative">
        <!-- Decorative Background Element -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>

        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-mind-blue mb-6"><?= lang('Home.members_heading') ?></h2>
                <p class="text-text-secondary text-lg leading-relaxed">
                    <?= esc($members_description ?? '') ?>
                </p>
                <div class="mt-6 w-24 h-1 bg-mind-red mx-auto rounded-full"></div>
            </div>

            <!-- FLEX LAYOUT: CENTERED & WRAPPED -->
            <div class="flex flex-wrap justify-center -mx-4">
                <?php if (!empty($members)) : ?>
                    <?php foreach ($members as $member) : ?>
                        <!-- ITEM WRAPPER -->
                        <div class="w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-8 md:mb-12 flex justify-center">
                            <!-- Circle Card -->
                            <a href="#" class="group relative block w-32 h-32 sm:w-40 sm:h-40 md:w-44 md:h-44 bg-white rounded-full shadow-lg border-4 border-white hover:border-white transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl flex items-center justify-center overflow-hidden shrink-0">
                                <!-- Hover Ring Effect -->
                                <div class="absolute inset-0 rounded-full border-4 border-transparent group-hover:border-mind-blue/10 transition-colors duration-300"></div>
                                <!-- Logo Container -->
                                <div class="w-3/4 h-3/4 flex items-center justify-center relative z-10 p-2">
                                    <?php if (!empty($member['logo_anggota'])) : ?>
                                        <img src="<?= base_url('uploads/anggota/' . esc($member['logo_anggota'])) ?>" 
                                             alt="<?= esc($member['nama_perusahaan_anggota']) ?>" 
                                             class="w-full h-full object-contain filter grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
                                    <?php else : ?>
                                        <div class="text-center text-xs sm:text-sm font-bold text-gray-400 group-hover:text-mind-blue transition-colors leading-tight px-2">
                                            <?= esc($member['nama_perusahaan_anggota']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                     <p class="text-center col-span-full text-gray-500">Data anggota tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?= $this->endSection() ?>