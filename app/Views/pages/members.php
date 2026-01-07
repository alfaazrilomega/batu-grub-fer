<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" style="background-image: url('<?= base_url('img/foto-komitmen1.png') ?>'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                Anggota Kami
            </div>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                Jaringan Solid, <br>
                <span class="text-yellow-500">Kekuatan Inti.</span>
            </h1>
            
            <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                Mengenal lebih dekat pilar-pilar yang membentuk Grup Batu Group, dari Sabang sampai Merauke.
            </p>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= site_url($locale) ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500">Anggota</span>
            </div>
        </div>
    </div>
</section>

<!-- MEMBERS CIRCLE LAYOUT -->
<section class="py-20 bg-gray-50 section-fade-in relative">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>

    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-mind-blue mb-6"><?= lang('Home.members_heading') ?></h2>
            <p class="text-text-secondary text-lg leading-relaxed">
                <?= $page_description ?>
            </p>
            <div class="mt-6 w-24 h-1 bg-mind-red mx-auto rounded-full"></div>
        </div>

        <?php if (isset($members) && !empty($members)) : ?>
            <!-- FLEX LAYOUT: CENTERED & WRAPPED -->
            <div class="flex flex-wrap justify-center -mx-4">
                <?php foreach ($members as $member) : ?>
                    <div class="w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-8 md:mb-12 flex justify-center">
                        <div class="group relative block w-32 h-32 sm:w-40 sm:h-40 md:w-44 md:h-44 bg-white rounded-full shadow-lg border-4 border-white hover:border-white transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl flex items-center justify-center overflow-hidden shrink-0">
                            <div class="absolute inset-0 rounded-full border-4 border-transparent group-hover:border-mind-blue/10 transition-colors duration-300"></div>
                            <div class="w-3/4 h-3/4 flex items-center justify-center relative z-10 p-2">
                                <?php if (!empty($member['logo_anggota'])) : ?>
                                    <img src="<?= base_url('img/anggota/' . $member['logo_anggota']) ?>" 
                                         alt="<?= $member['nama_perusahaan_anggota'] ?>" 
                                         class="w-full h-full object-contain filter grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
                                <?php else : ?>
                                    <div class="text-center text-xs sm:text-sm font-bold text-gray-400 group-hover:text-mind-blue transition-colors leading-tight px-2">
                                        <?= $member['nama_perusahaan_anggota'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- SECTION 2: DETAIL LIST -->
            <section class="py-12 lg:py-24 bg-white">
                <div class="container mx-auto px-6">
                    
                    <?php foreach ($members as $member) : ?>
                    <div class="pb-12 lg:pt-16 border-b border-gray-200 last:border-0 scroll-mt-24" id="<?= $member['id_anggota'] ?>">
                        <div class="w-full h-64 md:h-[400px] bg-gray-100 bg-center bg-no-repeat bg-cover rounded-2xl overflow-hidden mb-8 shadow-lg group" 
                            style="background-image: url('<?php echo (!empty($member['image_anggota'])) ? base_url('img/anggota/' . $member['image_anggota']) : 'https://via.placeholder.com/800x400.png?text=Image+Not+Available'; ?>')">
                            <!-- Overlay tipis -->
                            <div class="w-full h-full bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                        </div>
                        <div class="flex flex-wrap md:-mx-6">
                            <div class="w-full md:px-6">
                                <div class="prose max-w-none mb-8 text-gray-700">
                                    <h2 class="text-3xl font-bold text-mind-blue mb-6 border-l-4 border-red-600 pl-4"><?= $member['nama_perusahaan_anggota'] ?></h2>
                                    <div class="leading-relaxed text-gray-600 space-y-4 text-justify">
                                    <?= $member['deskripsi_anggota_id'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </section>

        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-gray-500">Data anggota tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>