<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<?php
    // Fallback Data Protection
    $title = $title ?? 'Berita & Siaran Pers';
    $locale = $locale ?? 'id';
    $hero_image = $hero_image ?? base_url('img/default-hero.jpg');
    $featured = $featured_article ?? [];
    $latest = $latest_articles ?? [];
?>

<!-- HERO SECTION -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden text-white" style="background-image: url('https://mind.id/storage/193/member-inalum.jpg'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
    <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-4xl">
            <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                Berita & Publikasi
            </div>
            
            <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                Kabar Terkini <br>
                <span class="text-yellow-500">dari MIND ID.</span>
            </h1>
            
            <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                Ikuti perkembangan terbaru, inovasi, dan pencapaian dari seluruh penjuru Grup Industri Pertambangan Indonesia.
            </p>
            
            <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                <a href="<?= site_url($locale) ?>" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-yellow-500">Berita</span>
            </div>
        </div>
    </div>
</section>

<!-- 
    MAIN CONTENT SECTION
    Menggunakan desain grid yang Anda berikan
-->
<main class="py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-6">
        
        <h2 class="text-[#16325C] font-bold text-2xl md:text-3xl mb-8 lg:mb-12 uppercase tracking-wide border-l-4 border-[#ED1C24] pl-4">
            Semua Berita
        </h2>

        <?php if (!empty($artikel)) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($artikel as $index => $item): ?>
                <a href="<?= site_url($locale . '/berita/' . ($item['slug_artikel_id'] ?? '#')) ?>" 
                   class="group flex flex-col bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 h-full">
                    
                    <div class="relative h-48 overflow-hidden">
                        <img src="<?= base_url('uploads/artikel/' . esc($item['foto_artikel'])) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="<?= esc($item['alt_artikel_id']) ?>">
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="text-xs text-gray-400 mb-2 flex items-center gap-2">
                            <i class="ph-bold ph-calendar-blank"></i> <?= esc(date('d M Y', strtotime($item['created_at']))) ?>
                        </div>
                        <h3 class="text-lg font-bold text-[#16325C] mb-3 leading-snug group-hover:text-[#ED1C24] transition-colors line-clamp-2">
                            <?= esc($item['judul_artikel_id']) ?>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                            <?= esc($item['snippet_id']) ?>
                        </p>
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between text-xs font-medium text-gray-500">
                            <span>Baca Artikel</span>
                            <i class="ph-bold ph-caret-right text-[#ED1C24]"></i>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- PAGINATION -->
            <div class="mt-12 lg:mt-16">
                <?= $pager->links('default', 'custom_full') ?>
            </div>

        <?php else : ?>
            <div class="text-center py-16">
                <p class="text-gray-500">Saat ini belum ada berita yang tersedia.</p>
            </div>
        <?php endif; ?>

    </div>
</main>

<!-- Inject Custom Config & Scripts for this page -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
    });
</script>

<?= $this->endSection() ?>
