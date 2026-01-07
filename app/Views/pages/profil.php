<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
    
    .profil-page-content { font-family: 'Inter', sans-serif; }
    
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

    /* --- PERBAIKAN LOGIC ANGKA MISI (FIXED) --- */
    /* Kita gunakan CSS Murni agar counter pasti jalan */
    .misi-content ul {
        list-style: none;
        padding: 0;
        counter-reset: misi-counter; /* Reset penghitung */
    }
    .misi-content ul li {
        position: relative;
        padding-left: 3.5rem; /* Jarak teks dari angka */
        margin-bottom: 1.5rem;
        counter-increment: misi-counter; /* Tambah angka setiap baris */
        display: flex;
        flex-direction: column;
    }
    /* Lingkaran Angka */
    .misi-content ul li::before {
        content: counter(misi-counter); /* Tampilkan Angka 1, 2, 3... */
        position: absolute;
        left: 0;
        top: 0;
        width: 2.5rem;  /* w-10 */
        height: 2.5rem; /* h-10 */
        background-color: #374151; /* gray-700 */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.875rem;
        color: white;
        transition: all 0.3s ease;
    }
    /* Efek Hover Lingkaran */
    .misi-content ul li:hover::before {
        background-color: #EAB308; /* yellow-500 */
        color: #1e3a8a; /* blue-900 (Navy) */
    }
    /* Styling Teks List */
    .misi-content ul li {
        color: #d1d5db; /* gray-300 */
        font-size: 1.125rem; /* text-lg */
    }
    .misi-content ul li strong {
        color: white;
        display: block;
    }
</style>

<div class="profil-page-content bg-gray-50 text-gray-800">

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-bg text-white">
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/60 to-transparent z-10"></div>
        <div class="absolute -right-20 top-20 w-96 h-96 bg-yellow-500 rounded-full opacity-10 blur-3xl z-0"></div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-4xl">
                <div class="inline-block px-3 py-1 mb-4 border border-yellow-500/50 rounded-full text-yellow-400 text-xs font-bold tracking-widest uppercase fade-up">
                    Tentang Kami
                </div>
                
                <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight fade-up delay-100 drop-shadow-lg">
                    <?= esc($profil['nama_perusahaan'] ?? 'Batu Group') ?>
                </h1>
                
                <?php if (!empty($profil['snippet_id'])) : ?>
                <p class="text-lg lg:text-xl text-gray-200 mb-8 max-w-2xl fade-up delay-200 leading-relaxed font-light">
                    <?= esc($profil['snippet_id']) ?>
                </p>
                <?php endif; ?>
                
                <div class="flex items-center text-sm text-gray-400 fade-up delay-300">
                    <a href="<?= base_url('/') ?>" class="hover:text-white transition">Beranda</a>
                    <span class="mx-2">/</span>
                    <span class="text-yellow-500">Tentang Kami</span>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($profil)) : ?>
        <section class="py-20 lg:py-24 bg-white overflow-hidden">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    
                    <div class="fade-up">
                        <h2 class="text-yellow-600 font-bold uppercase tracking-wide text-sm mb-2">Siapa Kami</h2>
                        <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Generasi Penggerak Perubahan</h3>
                        
                        <div class="prose text-gray-600 leading-relaxed text-lg text-justify mb-8">
                            <?= $profil['deskripsi_tentang_id'] ?? '' ?>
                        </div>
                        
                        <div class="inline-block border-l-4 border-yellow-500 pl-6 py-2 bg-yellow-50 rounded-r-lg text-left shadow-sm">
                            <p class="text-xl font-light italic text-gray-800">
                                "<?= esc($profil['visi_id'] ?? 'Menjadi Perusahaan Global Berkelanjutan') ?>"
                            </p>
                            <p class="text-sm font-bold mt-2 text-gray-500">— Visi Perusahaan</p>
                        </div>
                    </div>

                    <div class="fade-up delay-100 relative">
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border-4 border-white group bg-black">
                            <iframe class="absolute inset-0 w-full h-full" 
                                    src="<?= esc($profil['link_youtube'] ?? '') ?>" 
                                    title="Company Profile" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-full h-full border-2 border-yellow-500/20 rounded-2xl -z-10"></div>
                        <div class="absolute -top-10 -left-10 w-32 h-32 bg-yellow-500/10 rounded-full blur-3xl -z-10"></div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-24 bg-gray-900 text-white relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute right-0 bottom-0 w-96 h-96 bg-blue-500 rounded-full blur-[120px]"></div>
                <div class="absolute left-0 top-0 w-96 h-96 bg-yellow-500 rounded-full blur-[120px]"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="grid md:grid-cols-2 gap-8 lg:gap-12 items-stretch">
                    
                    <div class="group bg-gray-800 p-10 lg:p-14 rounded-3xl border border-gray-700 hover:border-yellow-500 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-500/10 fade-up h-full flex flex-col justify-center text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-500/10 to-transparent rounded-bl-full"></div>
                        <h4 class="text-yellow-500 font-bold uppercase tracking-widest mb-6 text-sm">Visi Kami</h4>
                        <p class="text-3xl lg:text-4xl text-white font-serif italic leading-snug">
                           "<?= esc($profil['visi_id'] ?? 'Visi tidak tersedia') ?>"
                        </p>
                        <div class="w-16 h-1 bg-gray-600 mx-auto mt-8 group-hover:bg-yellow-500 transition-colors duration-300"></div>
                    </div>

                    <div class="group bg-gray-800 p-10 lg:p-14 rounded-3xl border border-gray-700 hover:border-yellow-500 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-500/10 fade-up delay-100 h-full flex flex-col justify-center">
                        <h4 class="text-yellow-500 font-bold uppercase tracking-widest mb-8 text-sm text-center md:text-left">Misi Kami</h4>
                        
                        <div class="misi-content prose prose-invert max-w-none">
                            <?= $profil['misi_id'] ?? '' ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-20 lg:py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12 fade-up">
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#16325C] uppercase tracking-wide">
                        Struktur Perusahaan
                    </h2>
                    <div class="w-24 h-1.5 bg-yellow-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="relative w-full shadow-2xl rounded-2xl overflow-hidden border-4 border-white bg-white fade-up delay-100">
                    <img src="<?= base_url('img/tentang/' . ($profil['struktur_organisasi'] ?? 'default-structure.png')) ?>" 
                         alt="Struktur Perusahaan" 
                         class="w-full h-auto object-contain">
                </div>
            </div>
        </section>
    <?php else : ?>
        <section class="py-20 lg:py-24 bg-white">
            <div class="container mx-auto px-6 text-center">
                <p class="text-gray-500">Informasi profil perusahaan tidak tersedia saat ini.</p>
            </div>
        </section>
    <?php endif; ?>

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
            }, { threshold: 0.1 });
            elementsToAnimate.forEach(el => observer.observe(el));
        }
    });
</script>

<?= $this->endSection() ?>