<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- 
    1. HERO SECTION 
    Background Image berbeda tiap komoditas (dari controller)
-->
<section class="relative h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden">
    <!-- Dynamic Background Image -->
    <div class="absolute inset-0 bg-cover bg-center" 
         style="background-image: url('<?= $hero_bg ?>');">
    </div>
    
    <!-- Overlay Gradient (Agar teks terbaca) -->
    <div class="absolute inset-0 bg-black/50 z-10"></div>

    <!-- Hero Content -->
    <div class="container mx-auto px-6 relative z-20 text-center text-white">
        <!-- Pre-title Hardcoded -->
        <span class="inline-block py-1 px-3 rounded-full border border-white/30 bg-white/10 backdrop-blur-md text-sm font-bold tracking-widest uppercase mb-4 animate-fade-in-up">
            Komoditas Kami
        </span>
        
        <!-- Title Dynamic -->
        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 drop-shadow-lg animate-fade-in-up delay-100">
            <?= $commodity['title'] ?>
        </h1>

        <!-- Breadcrumb Simple -->
        <div class="flex items-center justify-center gap-2 text-gray-300 text-sm animate-fade-in-up delay-200">
            <a href="<?= base_url($locale . '/') ?>" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-white font-semibold"><?= $commodity['title'] ?></span>
        </div>
    </div>
</section>

<!-- 
    2. DESCRIPTION SECTION
    Layout simpel di tengah
-->
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Decorative Line -->
            <div class="w-20 h-1.5 bg-mind-red mb-8"></div>
            
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold text-mind-blue mb-8">
                Tentang <?= $commodity['title'] ?>
            </h2>

            <!-- Content HTML -->
            <div class="prose prose-lg prose-headings:text-mind-blue prose-p:text-gray-600 max-w-none text-justify leading-relaxed">
                <?= $commodity['content'] ?>
            </div>

            <!-- Back Button -->
            <div class="mt-12 pt-8 border-t border-gray-100">
                <a href="<?= base_url($locale . '/') ?>" class="inline-flex items-center gap-2 text-mind-blue font-bold hover:text-mind-red transition-colors">
                    <i class="ph-bold ph-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>