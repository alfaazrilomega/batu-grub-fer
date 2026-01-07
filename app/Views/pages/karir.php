<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" style="background-image: url('<?= base_url('img/slider/foto-hero-section-3.jpg') ?>'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                Karir
            </div>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                Berkarya, Berdampak, <br>
                <span class="text-yellow-500">Bersama Kami.</span>
            </h1>
            
            <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                Jadilah bagian dari perjalanan kami dalam mengelola kekayaan mineral Indonesia untuk masa depan yang lebih baik.
            </p>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= site_url($locale) ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500">Karir</span>
            </div>
        </div>
    </div>
</section>

<!-- 
    MAIN CONTENT SECTION
    Revisi: Menggunakan desain baru dengan Grid System dan Warna Brand yang presisi
-->
<!-- Load Phosphor Icons untuk panah -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>

<div class="bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap lg:flex-nowrap py-12 lg:py-24 lg:space-x-24">
            
            <!-- Kolom Kiri: Judul Halaman -->
            <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                <!-- Menggunakan arbitrary value [#16325C] untuk mind-blue dan [#ED1C24] untuk mind-red agar warna akurat tanpa config global -->
                <h1 class="text-[#16325C] font-bold text-xl md:text-2xl mb-8 uppercase tracking-wide border-l-4 border-[#ED1C24] pl-4">
                    <?= $page_title ?? 'Lowongan Pekerjaan' ?>
                </h1>
                <blockquote class="text-2xl font-thin leading-relaxed mb-8 text-gray-500 italic">
                </blockquote>
            </div>

            <!-- Kolom Kanan: Isi Konten -->
            <div class="w-full lg:w-2/3">
                <div class="prose max-w-none text-center lg:text-left text-lg leading-relaxed text-gray-700">
                    <?php if (isset($karir_page) && !empty($karir_page['deskripsi_karir_id'])) : ?>
                        <?= $karir_page['deskripsi_karir_id'] ?>
                    <?php else : ?>
                        <p>Informasi karir sedang tidak tersedia saat ini. Silakan periksa kembali nanti.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- 
    CAREER AREAS GRID SECTION
    Bagian ini sekarang dinamis dan mengambil data dari database.
-->
<section class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-[#16325C] mb-12 text-center">Lowongan Pekerjaan</h2>
        
        <?php if (isset($lowongan) && !empty($lowongan)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <?php foreach ($lowongan as $job) : ?>
                    <a href="<?= base_url($locale . '/karir/detail/' . $job['slug_lowongan_id']) ?>" class="group relative aspect-[3/4] overflow-hidden rounded-lg cursor-pointer shadow-md block">
                        <?php 
                            $poster_url = !empty($job['poster_lowongan']) 
                                ? base_url('img/lowongan/' . $job['poster_lowongan']) 
                                : base_url('img/default-job-poster.jpg'); // Fallback image
                        ?>
                        <img src="<?= $poster_url ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="<?= $job['nama_lowongan_id'] ?>">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <h3 class="text-white text-xl font-bold mb-2 uppercase tracking-wide"><?= esc($job['nama_lowongan_id']) ?></h3>
                            <div class="h-1 w-0 bg-[#ED1C24] group-hover:w-16 transition-all duration-500 mb-2"></div>
                            <div class="flex justify-end opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0">
                                <div class="w-8 h-8 rounded-full bg-white text-[#ED1C24] flex items-center justify-center">
                                    <i class="ph-bold ph-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>

            <!-- PAGINATION -->
            <div class="mt-16">
                <?= $pager->links('default', 'custom_full') ?>
            </div>
            
        <?php else : ?>
            <div class="text-center py-12 border border-gray-200 rounded-lg">
                <p class="text-gray-500 text-lg">Saat ini belum ada lowongan pekerjaan yang tersedia.</p>
                <p class="text-gray-400 mt-2">Silakan cek kembali di lain waktu.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?= $this->endSection() ?>