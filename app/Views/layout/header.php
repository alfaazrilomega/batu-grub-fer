<?php
$locale = service('request')->getLocale();
$uri = service('request')->getUri();

// Build the URL for the other language
$segments = $uri->getSegments();
$otherLocale = ($locale === 'id') ? 'en' : 'id';

// Find and replace the locale segment
$found = false;
foreach ($segments as $i => $segment) {
    if ($segment === $locale) {
        $segments[$i] = $otherLocale;
        $found = true;
        break;
    }
}
// If no locale segment was found (e.g., on the root page), prepend it
if (!$found) {
    array_unshift($segments, $otherLocale);
}

// Construct the final URL for the language switcher
$otherLangUrl = site_url(implode('/', $segments));

// Determine the current page for active nav state
$currentPage = $uri->getSegment(2, 'home'); // default to 'home' if segment 2 is not present
?>

<!-- FULL SCREEN MENU OVERLAY -->
<div id="mobile-menu-overlay" class="fixed inset-0 z-40 bg-mind-blue topo-bg transform -translate-y-full transition-transform duration-[600ms] cubic-bezier(0.85, 0, 0.15, 1) flex flex-col pt-32 px-6 pb-10 h-screen w-full lg:hidden">
    
    <!-- Nav Links -->
    <nav class="flex-1 flex flex-col justify-center container mx-auto">
        <ul class="space-y-6">
            <li class="nav-item">
                <a href="<?= site_url($locale) ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_home') ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url($locale . '/profil-perusahaan') ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_company') ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url($locale . '/members') ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_members') ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url($locale . '/berita') ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_news') ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url($locale . '/karir') ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_career') ?>
                </a>
            </li>
             <li class="nav-item">
                <a href="<?= site_url($locale . '/contact') ?>" class="block text-3xl md:text-5xl font-bold text-white/90 hover:text-mind-red transition-colors group flex items-center justify-start gap-4">
                    <span class="w-0 group-hover:w-8 h-[3px] bg-mind-red transition-all duration-300 block"></span>
                    <?= lang('Home.nav_contact') ?>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer Info di Menu -->
    <div class="nav-item mt-auto border-t border-white/10 pt-6 container mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between text-white/50 text-sm gap-4">
            <p>MIND ID Head Office - Jakarta</p>
            <div class="flex gap-6 text-white">
                <a href="#" class="hover:text-mind-red transition"><i class="ph-fill ph-instagram-logo text-2xl"></i></a>
                <a href="#" class="hover:text-mind-red transition"><i class="ph-fill ph-linkedin-logo text-2xl"></i></a>
                <a href="#" class="hover:text-mind-red transition"><i class="ph-fill ph-youtube-logo text-2xl"></i></a>
            </div>
        </div>
    </div>
</div>


<!-- UTAMA HEADER -->
<header id="main-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur-lg shadow-sm">
    <div class="w-full px-6 lg:px-10 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="<?= site_url($locale) ?>" class="flex items-center gap-2 text-xl font-extrabold text-mind-blue z-50">
                <span class="logo-cover"></span>
                <span><?= lang('Home.logo') ?></span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden lg:flex items-center space-x-6">
                 <div class="relative group" data-nav="nav_home">
                    <a href="<?= site_url($locale) ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'home') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_home') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'home') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
                <div class="relative group" data-nav="nav_company">
                    <a href="<?= site_url($locale . '/profil-perusahaan') ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'profil-perusahaan') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_company') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'profil-perusahaan') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
                <div class="relative group" data-nav="nav_members">
                    <a href="<?= site_url($locale . '/members') ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'members') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_members') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'members') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
                <div class="relative group" data-nav="nav_news">
                    <a href="<?= site_url($locale . '/berita') ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'berita') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_news') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'berita') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
                <div class="relative group" data-nav="nav_career">
                    <a href="<?= site_url($locale . '/karir') ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'karir') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_career') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'karir') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
                <div class="relative group" data-nav="nav_contact">
                    <a href="<?= site_url($locale . '/contact') ?>" class="text-sm uppercase font-semibold tracking-wider <?= ($currentPage === 'contact') ? 'text-mind-blue' : 'text-text-secondary' ?> transition-colors duration-300 group-hover:text-mind-blue"><?= lang('Home.nav_contact') ?></a>
                    <div class="absolute -bottom-1 left-0 h-0.5 <?= ($currentPage === 'contact') ? 'w-full' : 'w-0' ?> bg-mind-red transition-all duration-300 group-hover:w-full"></div>
                </div>
            </nav>

            <!-- Language & Hamburger -->
            <div class="flex items-center space-x-4">
                <div class="text-sm hidden">
                    <!-- <a href="<?= $locale === 'id' ? '#' : $otherLangUrl ?>" class="lang-switch <?= $locale === 'id' ? 'font-bold text-mind-blue' : 'font-semibold text-text-secondary' ?>">ID</a>
                    <span class="text-gray-300 mx-1">|</span>
                    <a href="<?= $locale === 'en' ? '#' : $otherLangUrl ?>" class="lang-switch <?= $locale === 'en' ? 'font-bold text-mind-blue' : 'font-semibold text-text-secondary' ?>">EN</a> -->
                </div>
                
                <!-- HAMBURGER BUTTON (INTERAKTIF) -->
                <button id="mobile-menu-btn" class="lg:hidden z-50 relative group w-12 h-12 flex flex-col items-end justify-center gap-1.5 transition-all duration-300 focus:outline-none">
                    <span class="h-[3px] w-8 bg-mind-blue rounded-full transition-all duration-300 origin-center group-hover:bg-mind-red group-hover:w-6 line-span"></span>
                    <span class="h-[3px] w-6 bg-mind-blue rounded-full transition-all duration-300 origin-center group-hover:bg-mind-red group-hover:w-8 line-span"></span>
                    <span class="h-[3px] w-4 bg-mind-blue rounded-full transition-all duration-300 origin-center group-hover:bg-mind-red group-hover:w-6 line-span"></span>
                </button>
            </div>
        </div>
    </div>
</header>
