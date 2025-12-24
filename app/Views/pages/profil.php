<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<!-- Chosen Palette: Corporate Navy & Gold (GESID Identity) -->
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

    .profil-page-content {
        font-family: 'Inter', sans-serif;
    }

    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .hero-bg {
        background-color: #0a2540;
        background-image: url("https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<div class="profil-page-content bg-gray-50 text-gray-800">

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-bg text-white">
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
        <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-4xl">
                <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                    Tentang Kami
                </div>

                <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                    Membangun Desa, <br>
                    <span class="text-yellow-500">Memajukan Indonesia.</span>
                </h1>

                <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                    Kami adalah wajah baru pergerakan pemuda yang berfokus pada pengembangan desa berkelanjutan melalui teknologi dan kearifan lokal.
                </p>

                <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                    <a href="<?= base_url('/') ?>" class="hover:text-white transition">Beranda</a>
                    <span class="mx-2">/</span>
                    <span class="text-yellow-500">Tentang Kami</span>
                </div>
            </div>
        </div>
    </section>

    <!-- INTRO SECTION (UPDATED LAYOUT: TEXT LEFT, VIDEO RIGHT) -->
    <section class="py-20 lg:py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <!-- Grid Layout: 1 Kolom di Mobile, 2 Kolom di Desktop -->
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- KOLOM KIRI: TEXT -->
                <div class="fade-up">
                    <h2 class="text-yellow-600 font-bold uppercase tracking-wide text-sm mb-2">Siapa Kami</h2>
                    <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Generasi Penggerak Perubahan</h3>

                    <div class="prose text-gray-600 leading-relaxed text-lg text-justify mb-8">
                        <p class="mb-4">
                            Generasi Emas Indonesia (GESID) bukan sekadar organisasi, melainkan sebuah gerakan. Kami hadir sebagai jembatan yang menghubungkan potensi desa yang tak terbatas dengan semangat inovasi pemuda.
                        </p>
                        <p>
                            Di era globalisasi, desa seringkali tertinggal. Namun bagi kami, desa adalah masa depan. Melalui sinergi dan kolaborasi, kami berkomitmen untuk menciptakan ekosistem yang mandiri.
                        </p>
                    </div>

                    <div class="inline-block border-l-4 border-yellow-500 pl-6 py-2 bg-yellow-50 rounded-r-lg text-left shadow-sm">
                        <p class="text-xl font-light italic text-gray-800">
                            "Bergerak Bersama Membangun Desa Untuk Indonesia"
                        </p>
                        <p class="text-sm font-bold mt-2 text-gray-500">— Visi GESID</p>
                    </div>
                </div>

                <!-- KOLOM KANAN: VIDEO -->
                <div class="fade-up delay-100 relative">
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border-4 border-white group bg-black">

                        <!-- 
                             YOUTUBE IFRAME
                             1. Class 'absolute inset-0 w-full h-full' memaksa iframe memenuhi wrapper okayyy.
                             2. URL harus format /embed/ bukan /watch?v=  okayyy.
                        -->
                        <iframe class="absolute inset-0 w-full h-full"
                            src="https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0"
                            title="Company Profile"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Elemen Dekoratif di belakang video -->
                    <div class="absolute -bottom-6 -right-6 w-full h-full border-2 border-yellow-500/20 rounded-2xl -z-10"></div>
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-yellow-500/10 rounded-full blur-3xl -z-10"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- VISI & MISI (CLEAN - NO HEADER TEXT) -->
    <section class="py-24 bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <div class="absolute right-0 bottom-0 w-96 h-96 bg-blue-500 rounded-full blur-[120px]"></div>
            <div class="absolute left-0 top-0 w-96 h-96 bg-yellow-500 rounded-full blur-[120px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">

            <!-- Balanced Grid -->
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-stretch">

                <!-- KOLOM 1: VISI (Left) -->
                <div class="group bg-gray-800 p-10 lg:p-14 rounded-3xl border border-gray-700 hover:border-yellow-500 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-500/10 fade-up h-full flex flex-col justify-center text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-500/10 to-transparent rounded-bl-full"></div>

                    <h4 class="text-yellow-500 font-bold uppercase tracking-widest mb-6 text-sm">Visi Kami</h4>
                    <p class="text-3xl lg:text-4xl text-white font-serif italic leading-snug">
                        "Bergerak Bersama Membangun Desa Untuk Indonesia"
                    </p>
                    <div class="w-16 h-1 bg-gray-600 mx-auto mt-8 group-hover:bg-yellow-500 transition-colors duration-300"></div>
                </div>

                <!-- KOLOM 2: MISI (Right) -->
                <div class="group bg-gray-800 p-10 lg:p-14 rounded-3xl border border-gray-700 hover:border-yellow-500 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-500/10 fade-up delay-100 h-full flex flex-col justify-center">

                    <h4 class="text-yellow-500 font-bold uppercase tracking-widest mb-8 text-sm text-center md:text-left">Misi Kami</h4>

                    <ul class="space-y-6 text-gray-300">
                        <li class="flex gap-4 items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center mt-1 group-hover:bg-yellow-500 group-hover:text-blue-900 transition-colors duration-300">
                                <span class="font-bold text-sm">1</span>
                            </div>
                            <div>
                                <strong class="block text-white text-lg mb-1">Adaptasi Teknologi</strong>
                                <span class="text-sm text-gray-400">Menciptakan lingkungan desa yang adaptif terhadap teknologi terbarukan.</span>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center mt-1 group-hover:bg-yellow-500 group-hover:text-blue-900 transition-colors duration-300">
                                <span class="font-bold text-sm">2</span>
                            </div>
                            <div>
                                <strong class="block text-white text-lg mb-1">Daya Saing Pemuda</strong>
                                <span class="text-sm text-gray-400">Meningkatkan Knowledge, Leadership, dan Entrepreneurship pemuda desa.</span>
                            </div>
                        </li>
                        <li class="flex gap-4 items-start">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center mt-1 group-hover:bg-yellow-500 group-hover:text-blue-900 transition-colors duration-300">
                                <span class="font-bold text-sm">3</span>
                            </div>
                            <div>
                                <strong class="block text-white text-lg mb-1">Ruang Aktualisasi</strong>
                                <span class="text-sm text-gray-400">Menyediakan panggung lokal dan global bagi inovasi anak desa.</span>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- STRUCTURE MEMBER SECTION -->
    <section class="h-[60vh]">
        <img src="<?= base_url('img/foto-profile-perusahaan.png') ?>" alt="Structure Member" class="w-full h-full object-cover">
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elementsToAnimate = document.querySelectorAll('.profil-page-content .fade-up');

        if (elementsToAnimate.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            elementsToAnimate.forEach(el => {
                observer.observe(el);
            });
        }
    });
</script>

<?= $this->endSection() ?>