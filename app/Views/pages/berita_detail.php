<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<?php
    // Setup Data & Helper
    $artikel = $artikel ?? [];
    $related_articles = $related_articles ?? [];
    $locale = $locale ?? 'id';

    // Helper Tanggal Indo
    function tanggal_indo($tanggal) {
        if(empty($tanggal)) return '-';
        $bulan = array (
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $split = explode('-', date('Y-m-d', strtotime($tanggal)));
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }

    $tgl_tayang = tanggal_indo($artikel['created_at'] ?? '');
    
    // Helper Gambar
    $bg_image = !empty($artikel['foto_artikel']) 
        ? base_url('img/' . $artikel['foto_artikel']) 
        : base_url('img/default-news.jpg'); 
?>

<div class="relative w-full h-[500px] lg:h-[600px] bg-[#16325C] overflow-hidden group">
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-105" 
         style="background-image: url('<?= $bg_image ?>')">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#16325C] via-[#16325C]/80 to-transparent opacity-95"></div>

    <div class="absolute inset-0 flex flex-col justify-end pb-24 md:pb-32 px-6">
        <div class="container mx-auto">
            <div class="max-w-5xl">
                <div class="flex items-center gap-3 mb-6 text-yellow-400 font-bold tracking-widest uppercase text-sm md:text-base animate-fade-in-up drop-shadow-md">
                    <span class="w-12 h-1 bg-yellow-400 rounded-full shadow-sm"></span>
                    <span><?= $tgl_tayang ?></span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-lg mb-4">
                    <?= esc($artikel['judul_artikel_id'] ?? 'Judul Tidak Tersedia') ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 w-full border-t border-white/10 backdrop-blur-md bg-[#16325C]/30 z-20">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center text-xs md:text-sm font-medium text-gray-300 space-x-2">
                <a href="<?= base_url('/') ?>" class="hover:text-yellow-400 transition">Beranda</a>
                <span class="text-gray-500">/</span>
                <a href="<?= base_url($locale . '/berita') ?>" class="hover:text-yellow-400 transition">Berita</a>
                <span class="text-gray-500">/</span>
                <span class="text-gray-100 truncate max-w-[200px] md:max-w-md font-semibold">
                    <?= esc($artikel['judul_artikel_id'] ?? '') ?>
                </span>
            </div>
        </div>
    </div>
</div>

<main class="py-16 -mt-10 relative z-20">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 relative">
            
            <article class="lg:col-span-8 bg-white p-6 md:p-12 rounded-2xl shadow-lg border border-gray-100">
                
                <div class="prose prose-lg max-w-none 
                    text-gray-600 leading-relaxed
                    
                    /* 1. Style untuk Judul Sub-Bab (H2, H3) */
                    prose-headings:text-[#16325C] prose-headings:font-bold prose-headings:mb-4
                    
                    /* 2. Style untuk Link */
                    prose-a:text-[#ED1C24] hover:prose-a:text-[#16325C]
                    
                    /* 3. Style untuk HURUF TEBAL (Lokasi seperti 'KONAWE SELATAN') */
                    prose-strong:text-[#16325C] prose-strong:font-extrabold
                    
                    /* 4. MAGIC: Style Paragraf PERTAMA (Lead Paragraph) agar ada garis kuning */
                    [&>p:first-of-type]:text-xl 
                    [&>p:first-of-type]:font-medium 
                    [&>p:first-of-type]:text-gray-800 
                    [&>p:first-of-type]:leading-relaxed
                    [&>p:first-of-type]:border-l-4 
                    [&>p:first-of-type]:border-yellow-400 
                    [&>p:first-of-type]:pl-6 
                    [&>p:first-of-type]:mb-8
                    
                    
                    /* 5. MAGIC: Style Quote agar miring & ada garis merah */
                    [&>blockquote]:border-l-4 
                    [&>blockquote]:border-[#ED1C24] 
                    [&>blockquote]:bg-gray-50 
                    [&>blockquote]:py-4 
                    [&>blockquote]:px-6 
                    [&>blockquote]:italic
                    [&>blockquote]:text-gray-700
                    [&>blockquote]:my-8
                    [&>blockquote]:rounded-r-lg
                ">
                    
                    <?= $artikel['deskripsi_artikel_id'] ?? '<p>Konten artikel sedang disiapkan.</p>' ?>
                
                </div>

                <div class="border-t border-gray-100 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <h4 class="text-sm font-bold text-[#16325C] uppercase tracking-wide">Bagikan Artikel Ini:</h4>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:-translate-y-1 transition shadow-sm">
                                <i class="ph-bold ph-facebook-logo text-xl"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= urlencode($artikel['judul_artikel_id']) ?>" target="_blank" class="w-10 h-10 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:-translate-y-1 transition shadow-sm">
                                <i class="ph-bold ph-twitter-logo text-xl"></i>
                            </a>
                            <a href="https://wa.me/?text=<?= urlencode($artikel['judul_artikel_id'] . ' ' . current_url()) ?>" target="_blank" class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:-translate-y-1 transition shadow-sm">
                                <i class="ph-bold ph-whatsapp-logo text-xl"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link tersalin!')" class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 hover:-translate-y-1 transition shadow-sm" title="Salin Link">
                                <i class="ph-bold ph-link text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <aside class="lg:col-span-4 space-y-8 h-full">
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 sticky top-24">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-[#16325C]">Berita Terkait</h3>
                        <div class="w-1 h-4 bg-[#ED1C24] rounded-full"></div>
                    </div>
                    
                    <div class="space-y-6">
                        <?php if(!empty($related_articles)): ?>
                            <?php foreach($related_articles as $item): ?>
                            <a href="<?= base_url($locale . '/berita/' . esc($item['slug_artikel_id'] ?? '#')) ?>" class="group flex gap-4 items-start">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 relative shadow-sm border border-gray-100">
                                    <img src="<?= base_url('img/' . esc($item['foto_artikel'] ?? 'default-thumb.jpg')) ?>" 
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                         alt="Thumbnail">
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-[#16325C] group-hover:text-[#ED1C24] leading-snug line-clamp-2 transition-colors mb-2">
                                        <?= esc($item['judul_artikel_id'] ?? 'Judul Artikel') ?>
                                    </h4>
                                    <span class="text-xs text-gray-400 flex items-center gap-1">
                                        <i class="ph-bold ph-calendar-blank"></i> 
                                        <?= tanggal_indo($item['created_at']) ?>
                                    </span>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm text-gray-500 italic text-center py-4">Belum ada berita terkait.</p>
                        <?php endif; ?>
                    </div>

                    <a href="<?= base_url($locale . '/berita') ?>" class="block mt-8 py-3 text-center text-sm font-bold text-white bg-[#16325C] hover:bg-[#2A5C96] rounded-lg transition shadow-sm hover:shadow-md">
                        Lihat Semua Berita
                    </a>
                </div>
            </aside>
        </div>
    </div>
</main>

<script src="https://unpkg.com/@phosphor-icons/web"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>

<?= $this->endSection() ?>