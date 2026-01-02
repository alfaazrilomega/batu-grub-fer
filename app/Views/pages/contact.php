<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" style="background-image: url('<?= base_url('img/foto-hero-section-1.jpg') ?>'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                Hubungi Kami
            </div>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                <?= esc($kontak['judul_kontak_id'] ?? 'Mari Terhubung.') ?>
            </h1>
            
            <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                <?= esc($kontak['subjudul_kontak_id'] ?? 'Kami siap mendengarkan pertanyaan, masukan, dan menjajaki peluang kolaborasi bersama Anda.') ?>
            </p>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= site_url($locale) ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500">Kontak</span>
            </div>
        </div>
    </div>
</section>

<!-- 
    MAIN CONTENT SECTION
-->
<div class="bg-white py-12 lg:py-24">
    <div class="container mx-auto px-6">

        <!-- Section Title -->
        <div class="text-center mb-12">
            <h1 class="text-3xl lg:text-4xl font-bold text-mind-blue">
                <?= esc($kontak['judul_kontak_id'] ?? 'Kontak Kami') ?>
            </h1>
            <p class="text-gray-600 mt-2 text-lg"><?= esc($kontak['deskripsi_kontak_id'] ?? 'Hubungi kami untuk pertanyaan lebih lanjut.') ?></p>
        </div>

        <!-- Main Grid: Info Kiri, Peta Kanan -->
        <div class="flex flex-wrap lg:flex-nowrap gap-12">
            
            <!-- Kolom Kiri: Info Kontak -->
            <div class="w-full lg:w-2/5">
                <div class="bg-gray-50 p-8 rounded-lg border h-full">
                    <h2 class="text-2xl font-bold text-mind-blue mb-6">Informasi Kontak</h2>
                    
                    <ul class="space-y-6 text-gray-700">
                        <li class="flex items-start">
                            <i class="ph-fill ph-map-pin-line text-2xl text-mind-blue-light mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Alamat</h3>
                                <p class="leading-relaxed"><?= esc($kontak['alamat_id'] ?? '') ?></p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="ph-fill ph-phone text-2xl text-mind-blue-light mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Telepon</h3>
                                <p><?= esc($kontak['telepon'] ?? '') ?></p>
                            </div>
                        </li>
                         <li class="flex items-start">
                            <i class="ph-fill ph-whatsapp-logo text-2xl text-mind-blue-light mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg mb-1">WhatsApp</h3>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', esc($kontak['link_wa'] ?? '')) ?>" target="_blank" class="text-gray-700 hover:text-mind-blue transition-colors"><?= esc($kontak['link_wa'] ?? '') ?></a>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="ph-fill ph-envelope-simple text-2xl text-mind-blue-light mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Email</h3>
                                 <a href="mailto:<?= esc($kontak['email'] ?? '') ?>" class="text-gray-700 hover:text-mind-blue transition-colors"><?= esc($kontak['email'] ?? '') ?></a>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="ph-fill ph-clock text-2xl text-mind-blue-light mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Jam Operasional</h3>
                                <p><?= esc($kontak['jam_operasional'] ?? '') ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Kolom Kanan: Peta -->
            <div class="w-full lg:w-3/5">
                <div class="w-full h-[500px] bg-gray-200 rounded-lg overflow-hidden border">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.525694167994!2d112.61282937401006!3d-7.9445006920797265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827489ab9d67%3A0xcad03ec85e51098!2sJl.%20Simpang%20Remujung%20No.3%2C%20Jatimulyo%2C%20Kec.%20Lowokwaru%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065141!5e0!3m2!1sid!2sid!4v1739112900065!5m2!1sid!2sid" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
