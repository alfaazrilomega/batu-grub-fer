<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<?php
    // Data Fallback / Default Values untuk mencegah error jika data tidak dikirim dari Controller
    $title = $title ?? 'Detail Program Karir';
    $hero_image_url = $hero_image_url ?? base_url('img/default-hero.jpg');
    $description = $description ?? '<p>Informasi detail mengenai program ini sedang dalam pembaruan. Silakan hubungi tim rekrutmen kami untuk informasi lebih lanjut.</p>';
    
    $requirements = $requirements ?? [
        'Kualifikasi detail belum tersedia saat ini.',
        'Silakan cek kembali secara berkala.'
    ];
    
    $benefits = $benefits ?? [
        'Informasi benefit belum tersedia.',
        'Hubungi kami untuk info lebih lanjut.'
    ];
?>

<!-- 
    HERO SECTION 
    Konsisten dengan karir.php: Menggunakan background image, gradient overlay, dan typography yang sama.
-->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" 
         style="background-image: url('<?= $hero_image_url ?? base_url('img/default-hero.jpg') ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                Career Program
            </div>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                <?= $title ?? 'Fresh Graduate Program' ?>
            </h1>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= base_url('/') ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <a href="<?= base_url($locale . '/karir') ?>" class="hover:text-white transition">Karir</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500"><?= $title ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Load Phosphor Icons (Jika belum ada di layout utama) -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>

<!-- 
    CONTENT SECTION: OVERVIEW
    Layout: Split Column (Left Title, Right Description)
    Menggunakan warna brand [#16325C] dan [#ED1C24] sesuai standar karir.php
-->
<div class="bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap lg:flex-nowrap py-12 lg:py-24 lg:space-x-24">
            
            <!-- Kolom Kiri: Judul Section -->
            <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                <h2 class="text-[#16325C] font-bold text-xl md:text-2xl mb-6 uppercase tracking-wide border-l-4 border-[#ED1C24] pl-4">
                    Tentang Program
                </h2>
            </div>

            <!-- Kolom Kanan: Deskripsi -->
            <div class="w-full lg:w-2/3">
                <div class="prose max-w-none text-gray-600 leading-relaxed text-lg text-justify">
                    <?= $description ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 
    DETAILS GRID: REQUIREMENTS & BENEFITS
    Background abu-abu muda untuk memisahkan visual section
-->
<section class="bg-gray-50 py-16 border-y border-gray-200">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12">
            
            <!-- Requirements -->
            <div>
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-full bg-[#16325C]/10 flex items-center justify-center text-[#16325C] mr-4">
                        <i class="ph-bold ph-list-checks text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#16325C]">Kualifikasi Umum</h3>
                </div>
                <ul class="space-y-4 text-gray-600">
                    <?php foreach ($requirements as $req) : ?>
                    <li class="flex items-start group">
                        <i class="ph-fill ph-check-circle text-[#ED1C24] mt-1 mr-3 flex-shrink-0 text-xl group-hover:scale-110 transition-transform"></i>
                        <span><?= $req ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Benefits -->
            <div>
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-full bg-[#16325C]/10 flex items-center justify-center text-[#16325C] mr-4">
                        <i class="ph-bold ph-gift text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#16325C]">Apa yang Kami Tawarkan</h3>
                </div>
                <ul class="space-y-4 text-gray-600">
                    <?php foreach ($benefits as $benefit) : ?>
                    <li class="flex items-start group">
                        <i class="ph-fill ph-star text-yellow-500 mt-1 mr-3 flex-shrink-0 text-xl group-hover:scale-110 transition-transform"></i>
                        <span><?= $benefit ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>