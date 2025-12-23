<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<?php
    // Data Fallback
    $article = $article ?? [];
    $related = $related_articles ?? [];
    $locale = $locale ?? 'id';
?>

<!-- 
    HEADER SECTION (REDESIGNED)
    Layout: Cinematic Bottom-Left Alignment
-->
<div class="relative w-full h-[500px] lg:h-[600px] bg-[#16325C] overflow-hidden group">
    <!-- Background Image Dynamic -->
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-105" 
         style="background-image: url('<?= $article['image'] ?? '' ?>')">
    </div>
    
    <!-- Advanced Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#16325C] via-[#16325C]/80 to-transparent opacity-95"></div>

    <!-- Header Content Container -->
    <div class="absolute inset-0 flex flex-col justify-end pb-24 md:pb-32 px-6">
        <div class="container mx-auto">
            <div class="max-w-5xl">
                <!-- Date Line -->
                <div class="flex items-center gap-3 mb-6 text-yellow-400 font-bold tracking-widest uppercase text-sm md:text-base animate-fade-in-up drop-shadow-md">
                    <span class="w-12 h-1 bg-yellow-400 rounded-full shadow-sm"></span>
                    <span><?= $article['date'] ?? '' ?></span>
                </div>

                <!-- Title Creative Typography -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-lg mb-4">
                    <?= $article['title'] ?? 'Judul Artikel' ?>
                </h1>
            </div>
        </div>
    </div>

    <!-- Breadcrumbs di Bawah -->
    <div class="absolute bottom-0 w-full border-t border-white/10 backdrop-blur-md bg-[#16325C]/30 z-20">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center text-xs md:text-sm font-medium text-gray-300 space-x-2">
                <a href="<?= base_url('/') ?>" class="hover:text-yellow-400 transition">Beranda</a>
                <span class="text-gray-500">/</span>
                <a href="<?= base_url($locale . '/berita') ?>" class="hover:text-yellow-400 transition">Berita</a>
                <span class="text-gray-500">/</span>
                <span class="text-gray-100 truncate max-w-[200px] md:max-w-md font-semibold">
                    <?= $article['title'] ?? '' ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- 
    MAIN CONTENT
-->
<main class="py-16 -mt-10 relative z-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 relative">
            
            <!-- ARTICLE CONTENT (8 Cols) -->
            <article class="lg:col-span-8 bg-white p-6 md:p-12 rounded-2xl shadow-lg border border-gray-100">
                
                <!-- Content Body -->
                <!-- Menggunakan Typography Plugin Tailwind -->
                <div class="prose prose-lg max-w-none prose-headings:text-[#16325C] prose-headings:font-bold prose-p:text-gray-600 prose-p:leading-relaxed prose-blockquote:border-[#ED1C24] prose-blockquote:bg-gray-50 prose-blockquote:py-2 prose-blockquote:pr-4 prose-a:text-[#ED1C24] hover:prose-a:text-[#16325C] transition-colors">
                    <?= $article['content'] ?? '' ?>
                </div>

                <!-- Share Section -->
                <div class="border-t border-gray-100 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <h4 class="text-sm font-bold text-[#16325C] uppercase tracking-wide">Bagikan Artikel Ini:</h4>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200">
                                <i class="ph-bold ph-facebook-logo text-xl"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:bg-sky-600 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200">
                                <i class="ph-bold ph-twitter-logo text-xl"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-[#0A66C2] text-white flex items-center justify-center hover:bg-blue-800 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200">
                                <i class="ph-bold ph-linkedin-logo text-xl"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:bg-green-600 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200">
                                <i class="ph-bold ph-whatsapp-logo text-xl"></i>
                            </a>
                            <button onclick="alert('Link tersalin!')" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition shadow-sm hover:shadow-md hover:-translate-y-1 transform duration-200" title="Salin Link">
                                <i class="ph-bold ph-link text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <!-- SIDEBAR (4 Cols) -->
            <aside class="lg:col-span-4 space-y-8 h-full">
                
                <!-- Related News Widget -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 sticky top-24">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-[#16325C]">Berita Terkait</h3>
                        <div class="w-1 h-4 bg-[#ED1C24] rounded-full"></div>
                    </div>
                    
                    <div class="space-y-6">
                        <?php foreach($related as $item): ?>
                        <!-- Related Item -->
                        <a href="<?= base_url($locale . '/berita/' . ($item['slug'] ?? '#')) ?>" class="group flex gap-4 items-start">
                            <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 relative shadow-sm">
                                <img src="<?= $item['image'] ?? '' ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" alt="<?= $item['title'] ?>">
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-[#16325C] group-hover:text-[#ED1C24] leading-snug line-clamp-2 transition-colors mb-2">
                                    <?= $item['title'] ?? '' ?>
                                </h4>
                                <span class="text-xs text-gray-400 flex items-center gap-1">
                                    <i class="ph-bold ph-calendar-blank"></i> <?= $item['date'] ?? '' ?>
                                </span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?= base_url($locale . '/berita') ?>" class="block mt-8 py-3 text-center text-sm font-bold text-white bg-[#16325C] hover:bg-[#2A5C96] rounded-lg transition shadow-sm hover:shadow-md">
                        Lihat Semua Berita
                    </a>
                </div>

            </aside>

        </div>
    </div>
</main>

<!-- Scripts & Config -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // // Tailwind Config Injection (Safety Check)
    // if (typeof tailwind !== 'undefined') {
    //     tailwind.config = {
    //         theme: {
    //             extend: {
    //                 colors: {
    //                     'mind-blue': '#16325C',
    //                     'mind-blue-light': '#2A5C96',
    //                     'mind-red': '#ED1C24',
    //                     'text-secondary': '#4A5568',
    //                 },
    //                 fontFamily: {
    //                     sans: ['Gotham', 'Arial', 'sans-serif'],
    //                 }
    //             }
    //         }
    //     }
    // }

    // Init AOS
    AOS.init({
        duration: 800,
        once: true,
    });
</script>

<?= $this->endSection() ?>