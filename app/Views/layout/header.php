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
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-lg shadow-sm">
    <div class="w-full px-6 lg:px-10 py-4">
        <div class="flex items-center justify-between">
            <a href="<?= site_url($locale) ?>" class="flex items-center gap-2 text-xl font-extrabold text-mind-blue ">
                <span class="logo-cover"></span>
                <span><?= lang('Home.logo') ?></span>
            </a>

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

            <div class="flex items-center space-x-4">
                <div class="text-sm">
                    <a href="<?= $locale === 'id' ? '#' : $otherLangUrl ?>" class="lang-switch <?= $locale === 'id' ? 'font-bold text-mind-blue' : 'font-semibold text-text-secondary' ?>">ID</a>
                    <span class="text-gray-300 mx-1">|</span>
                    <a href="<?= $locale === 'en' ? '#' : $otherLangUrl ?>" class="lang-switch <?= $locale === 'en' ? 'font-bold text-mind-blue' : 'font-semibold text-text-secondary' ?>">EN</a>
                </div>
                <button id="hamburger-btn" class="lg:hidden text-mind-blue"><i
                        class="ph-bold ph-list text-3xl"></i></button>
            </div>
        </div>
        <div id="mobile-menu" class="hidden lg:hidden">...</div>
    </div>
</header>
