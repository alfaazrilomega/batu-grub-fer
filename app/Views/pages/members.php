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
    SECTION 1: MEMBERS SLIDER
-->
<section class="py-20 md:py-28 bg-gray-100 section-fade-in overflow-hidden">
        <div class="container mx-auto px-6 mb-16">
            <div class="grid md:grid-cols-3 gap-8 items-end">
                <div class="md:col-span-1">
                    <h2 class="text-4xl font-bold text-mind-blue"><?= lang('Home.members_heading') ?></h2>
                </div>
                <div class="md:col-span-2">
                    <p class="text-text-secondary"><?= lang('Home.members_text') ?></p>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="swiper members-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($members as $member) : ?>
                        <div class="swiper-slide flex justify-center items-center">
                            <a href="#<?= $member['id'] ?>" class="block w-36 h-36 bg-white rounded-full shadow-lg flex items-center justify-center overflow-hidden p-2 group">
                                <?php if (!empty($member['logo'])) : ?>
                                    <img src="<?= base_url('img/' . $member['logo']) ?>" alt="<?= $member['name'] ?>" class="w-full h-full object-contain transition duration-300 group-hover:scale-110">
                                <?php else : ?>
                                    <div class="text-center p-2 text-sm font-semibold text-mind-blue">
                                        <?= $member['name'] ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="members-prev absolute top-1/2 -translate-y-1/2 left-4 z-10 cursor-pointer members-nav"><i
                    class="ph-bold ph-caret-left text-2xl"></i></div>
            <div class="members-next absolute top-1/2 -translate-y-1/2 right-4 z-10 cursor-pointer members-nav"><i
                    class="ph-bold ph-caret-right text-2xl"></i></div>
        </div>
    </section>

<!-- 
    SECTION 2: DETAIL LIST
-->
<section class="py-12 lg:py-24 bg-white">
    <div class="container mx-auto px-6">
        
        <?php foreach ($members as $member) : ?>
        <div class="pb-12 lg:pt-16 border-b border-gray-200 last:border-0 scroll-mt-24" id="<?= $member['id'] ?>">
            <div class="w-full h-64 md:h-[400px] bg-gray-100 bg-center bg-no-repeat bg-cover rounded-2xl overflow-hidden mb-8 shadow-lg" 
                 style="background-image: url('<?= base_url('img/' . $member['image']) ?>')">
            </div>
            <div class="flex flex-wrap md:-mx-6">
                <div class="w-full md:px-6">
                    <div class="prose max-w-none mb-8 text-gray-700">
                        <h2 class="text-3xl font-bold text-mind-blue mb-6 border-l-4 border-red-600 pl-4"><?= $member['name'] ?></h2>
                        <div class="leading-relaxed text-gray-600 space-y-4 text-justify">
                           <?= $member['desc'] ?>
                        </div>
                    </div>
                    <a href="<?= $member['url'] ?>" target="_blank" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-sm font-bold rounded-full text-white bg-red-600 hover:bg-red-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 uppercase tracking-wider">
                        Selengkapnya
                        <span class="pl-2"><i class="ph-bold ph-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<?= $this->endSection() ?>
