<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<main>
    <section id="artikel-page" class="py-20 pt-32 bg-slate-200/30">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <a href="<?= base_url('id/artikel/rekomendasi/'. $featured_article['slug'])?>" class="neu-flat p-4 flex flex-col gap-4 group hover:bg-white transition-colors duration-300" data-tilt>
                            <div class="w-full h-48 flex-shrink-0">
                                <img src="<?= base_url('img/'. $featured_article['image'])?>" class="w-full h-full object-cover rounded-lg" alt="<?= $featured_article['title']?>">
                            </div>
                            <div class="w-full flex flex-col px-1 h-full">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs text-slate-400 font-medium">Oleh Tim Furnetic | <?= $featured_article['date']?></span>
                                </div>
                                <h2 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 mb-2 leading-snug"><?= $featured_article['title']?></h2>
                                <p class="text-sm text-slate-500 line-clamp-3"><?= $featured_article['snippet']?></p>
                            </div>
                        </a>

                        <?php foreach ($side_articles as $article):?>
                        <a href="<?= base_url('id/artikel/kategori/'. $article['slug'])?>" class="neu-flat p-4 flex flex-col gap-4 group hover:bg-white transition-colors duration-300" data-tilt>
                            <div class="w-full h-48 flex-shrink-0">
                                <img src="<?= base_url('img/'. $article['image'])?>" class="w-full h-full object-cover rounded-lg" alt="<?= $article['title']?>">
                            </div>
                            <div class="w-full flex flex-col px-1 h-full">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs text-slate-400 font-medium">Oleh Tim Furnetic | <?= $article['date']?></span>
                                </div>
                                <h2 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 mb-2 leading-snug"><?= $article['title']?></h2>
                                <p class="text-sm text-slate-500 line-clamp-3">Klik untuk membaca selengkapnya tentang <?= strtolower($article['category'])?>.</p>
                            </div>
                        </a>
                        <?php endforeach;?>

                    </div>
                </div>

                <aside class="lg:col-span-4">
                    <div class="space-y-8 sticky top-28">
                        <div class="neu-flat p-6">
                            <h3 class="text-xl font-bold text-slate-700 mb-4 border-b pb-2">Artikel Lainnya</h3>
                            <div class="space-y-4">
                                
                                <?php foreach ($side_articles as $article):?>
                                <a href="<?= base_url('id/artikel/kategori/'. $article['slug'])?>" class="flex gap-4 items-center group">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="<?= base_url('img/'. $article['image'])?>" class="w-full h-full object-cover" alt="<?= $article['title']?>">
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm text-slate-800 group-hover:text-blue-600 leading-tight"><?= $article['title']?></h4>
                                        <span class="text-xs text-slate-400"><?= $article['date']?></span>
                                    </div>
                                </a>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="<?= base_url('assets/js/vanilla-tilt.min.js')?>"></script>
<script>
    // Since the main layout already loads GSAP, we just use it.
    // We also need to ensure lucide and vanilla-tilt are loaded if they aren't in the main layout.
    lucide.createIcons();
    
    // GSAP Animations for this page specifically
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        document.querySelectorAll("section h2, section p, .neu-flat:not(.no-scroll-anim)").forEach(el => {
            gsap.from(el, {
                scrollTrigger: {
                    trigger: el,
                    start: "top 85%",
                    toggleActions: "play none none none"
                },
                y: 30,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });
    }
    
    // Vanilla Tilt Initialization for this page
    if (typeof VanillaTilt !== 'undefined') {
         VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
            max: 15,
            speed: 400,
            glare: true,
            "max-glare": 0.2,
        });
    }
</script>
<?= $this->endSection() ?>
