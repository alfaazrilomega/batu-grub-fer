<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" 
         style="background-image: url('<?= $hero_image_url ?? base_url('img/default-hero.jpg') ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <?php if (!empty($pre_title)) : ?>
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                <?= $pre_title ?>
            </div>
            <?php endif; ?>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                <?= $hero_title ?? '' ?>
            </h1>
            
            <?php if (!empty($hero_subtitle)) : ?>
            <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                <?= $hero_subtitle ?>
            </p>
            <?php endif; ?>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= base_url('/') ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500"><?= $page_title ?? '' ?></span>
            </div>
        </div>
    </div>
</section>

<!-- 
    MAIN CONTENT SECTION
-->
<div class="bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap lg:flex-nowrap py-12 lg:py-24 lg:space-x-24">
            
            <!-- Kolom Kiri: Judul Halaman -->
            <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                <h1 class="text-mind-blue font-bold text-xl md:text-2xl mb-8 uppercase tracking-wide border-l-4 border-red-600 pl-4">
                    <?= $page_title ?>
                </h1>
                
                <!-- Placeholder Blockquote (Sesuai original HTML) -->
                <blockquote class="text-2xl font-thin leading-relaxed mb-8 text-gray-500 italic">
                </blockquote>
            </div>

            <!-- Kolom Kanan: Isi Konten -->
            <div class="w-full lg:w-2/3">
                <div class="prose max-w-none text-center lg:text-left">
                    
                    <!-- Heading Konten (Statis di view) -->
                    <h3 class="text-2xl md:text-3xl font-bold text-mind-blue mb-8 leading-snug">
                        Saat ini tersedia lowongan pekerjaan di <br>lingkungan Grup MIND ID
                    </h3>

                    <!-- Body Konten (Statis di view) -->
                    <div class="text-lg leading-relaxed text-gray-700">
                        <p class="mb-4">Silakan kunjungi portal rekrutmen resmi kami untuk melihat daftar posisi yang dibuka dan melakukan pendaftaran melalui tautan berikut:</p>
            
                        <p class="mb-6">Link Portal Rekrutmen Grup MIND ID: 
                            <a href="https://career.mind.id/" target="_blank" rel="noopener" class="text-blue-700 font-bold hover:underline break-all">
                                https://career.mind.id
                            </a>
                        </p>
                        
                        <p class="font-bold mt-12 text-gray-800">Seluruh proses rekrutmen MIND ID Group tidak dipungut biaya apa pun.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>