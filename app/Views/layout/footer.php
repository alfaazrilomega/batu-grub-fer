
<!-- 8. CAREER BANNER -->
    <section class="py-24 bg-cover bg-center section-fade-in"
        style="background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop')">
        <div class="container mx-auto px-6 text-center">
            <div class="bg-black/40 inline-block p-10 rounded-lg text-white">
                <h2 class="text-4xl font-bold"><?= lang('Home.career_heading') ?></h2>
                <p class="mt-2"><?= lang('Home.career_text') ?></p>
                <a href="<?= site_url(service('request')->getLocale() . '/contact') ?>"
                    class="mt-8 inline-flex items-center gap-3 bg-mind-red text-white font-bold py-3 px-8 rounded-full"><?= lang('Home.career_cta') ?></a>
            </div>
        </div>
    </section>

<footer class="bg-footer-blue text-white pt-20 pb-8">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="md:col-span-2 lg:col-span-1">
                <a href="#" class="flex items-center gap-2 text-2xl font-extrabold text-white">
                    <span class="logo-cover"></span>
                    <span data-i18n="logo">Batu Group</span>
                </a>
                <p class="mt-4 text-gray-300/80 text-sm" data-i18n="footer_address">Gedung Energy, 17th Floor,
                    SCBD, Jakarta Selatan 12190, Indonesia</p>
            </div>
            <div>
                <h5 class="font-bold text-lg uppercase tracking-wider" data-i18n="footer_links_title">Tautan
                </h5>
                <nav class="mt-4 flex flex-col space-y-3">
                    <a href="<?= base_url($locale . '/') ?>" class="text-gray-300 hover:text-white" data-i18n="nav_home">Beranda</a>
                    <a href="<?= base_url($locale . '/profil-perusahaan') ?>" class="text-gray-300 hover:text-white" data-i18n="nav_company">Profil Perusahaan</a>
                    <a href="<?= base_url($locale . '/members') ?>" class="text-gray-300 hover:text-white" data-i18n="nav_members">Anggota</a>
                    <a href="<?= base_url($locale . '/kontak') ?>" class="text-gray-300 hover:text-white"
                        data-i18n="nav_contact">Kontak</a>
                    <a href="<?= base_url($locale . '/karir') ?>" class="text-gray-300 hover:text-white" data-i18n="nav_career">Karir</a>
                </nav>
            </div>
            <div>
                <h5 class="font-bold text-lg uppercase tracking-wider" data-i18n="footer_legal_title">Legal</h5>
                <nav class="mt-4 flex flex-col space-y-3">
                    <a href="#" class="text-gray-300 hover:text-white" data-i1tns-p="footer_privacy">Kebijakan
                        Privasi</a>
                    <a href="#" class="text-gray-300 hover:text-white" data-i18n="footer_terms">Syarat &
                        Ketentuan</a>
                </nav>
            </div>
            <div>
                <h5 class="font-bold text-lg uppercase tracking-wider" data-i18n="footer_social_title">Sosial
                </h5>
                <div class="mt-4 flex space-x-5">
                    <a href="#" class="text-gray-300 hover:text-white"><i
                            class="ph-fill ph-facebook-logo text-2xl"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white"><i
                            class="ph-fill ph-linkedin-logo text-2xl"></i></a>
                    <a href="#" class="text-gray-300 hover:text-white"><i
                            class="ph-fill ph-instagram-logo text-2xl"></i></a>
                </div>
            </div>
        </div>
        <div class="mt-16 border-t border-white/10 pt-8 text-center text-sm text-gray-400">
            <p data-i18n="footer_copyright">&copy; 2025 Batu Group. All Rights Reserved.</p>
        </div>
    </div>
</footer>