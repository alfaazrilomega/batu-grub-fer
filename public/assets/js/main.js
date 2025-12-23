document.addEventListener('DOMContentLoaded', function () {
    // --- GSAP SCROLL-TRIGGERED ANIMATIONS ---
    gsap.registerPlugin(ScrollTrigger);
    const sections = document.querySelectorAll('.section-fade-in');
    sections.forEach(section => {
        gsap.to(section, {
            autoAlpha: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });



    // --- HERO SLIDER ---
    const heroSwiper = new Swiper('.mySwiper', {
        loop: true,
        effect: 'fade',
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        on: {
            init: function () {
                const activeSlide = this.slides[this.activeIndex];
                const elements = activeSlide.querySelectorAll('.hero-text-element');
                gsap.fromTo(elements, { opacity: 0, y: 30 }, { duration: 0.8, opacity: 1, y: 0, stagger: 0.2, ease: "power3.out", delay: 0.2 });
            },
            slideChangeTransitionStart: function () {
                const prevElements = this.slides[this.previousIndex].querySelectorAll('.hero-text-element');
                gsap.set(prevElements, { opacity: 0, y: 30 });
            },
            slideChangeTransitionEnd: function () {
                const activeSlide = this.slides[this.activeIndex];
                const elements = activeSlide.querySelectorAll('.hero-text-element');
                gsap.fromTo(elements, { opacity: 0, y: 30 }, { duration: 0.8, opacity: 1, y: 0, stagger: 0.2, ease: "power3.out", delay: 0.2 });
            }
        }
    });

    // --- MEMBERS SLIDER ---
    const membersSwiper = new Swiper('.members-slider', {
        loop: true,
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: '.members-next',
            prevEl: '.members-prev',
        },
        breakpoints: {
            768: { slidesPerView: 3, spaceBetween: 30 },
            1024: { slidesPerView: 5, spaceBetween: 40 },
        }
    });

    // --- BILINGUAL LOGIC ---
    const dictionary = {
        logo: { id: "Batu Grub", en: "Batu Grub" },
        nav_home: { id: "Beranda", en: "Home" },
        nav_company: { id: "Profil Perusahaan", en: "Profile Company" },
        nav_members: { id: "Anggota", en: "Members" },
        nav_contact: { id: "Kontak", en: "Contact" },
        nav_news: { id: "Berita", en: "News" },
        nav_career: { id: "Karir", en: "Career" },
        hero_title: { id: "Menambang Potensi Menggerakkan Ekonomi", en: "Mining Potential to Move the Economy" },
        hero2_title: { id: "Menjaga Kelestarian Alam Indonesia", en: "Preserving Indonesia's Nature" },
        hero3_title: { id: "Inovasi Pertambangan untuk Masa Depan", en: "Mining Innovation for the Future" },
        hero_cta: { id: "SELANJUTNYA <i class='ph-bold ph-arrow-right'></i>", en: "READ MORE <i class='ph-bold ph-arrow-right'></i>" },
        profile_heading: { id: "Profil", en: "Profile" },
        profile_text: { id: "Mining Industry Indonesia (MIND ID) adalah BUMN Holding Industri Pertambangan yang mengelola sumber daya mineral strategis Indonesia untuk kemakmuran bangsa.", en: "Mining Industry Indonesia (MIND ID) is the State-Owned Holding for the Mining Industry that manages Indonesia's strategic mineral resources for the nation's prosperity." },
        profile_cta: { id: "BACA SELANJUTNYA <i class='ph-bold ph-arrow-right'></i>", en: "READ MORE <i class='ph-bold ph-arrow-right'></i>" },
        commodity_heading: { id: "Komoditas kami", en: "Our Commodities" },
        commodity_text: { id: "Dari aluminium hingga timah, kami menambang kekayaan alam untuk peradaban, kemakmuran, dan masa depan yang lebih cerah.", en: "From aluminum to tin, we mine natural resources for civilization, prosperity, and a brighter future." },
        comm_aluminium: { id: "Aluminium", en: "Aluminum" },
        comm_coal: { id: "Batu Bara", en: "Coal" },
        comm_gold: { id: "Emas", en: "Gold" },
        comm_nickel: { id: "Nikel", en: "Nickel" },
        sustainability_heading: { id: "Komitmen Kami untuk Keberlanjutan", en: "Our Commitment to Sustainability" },
        sustainability_text: { id: "Keberlanjutan adalah prinsip yang tidak terpisahkan dalam menetapkan strategi, tujuan bisnis, dan operasi sehari-hari MIND ID dan semua anggota MIND ID. Kami menjunjung tinggi prinsip-prinsip keberlanjutan dengan integritas penuh untuk memastikan bahwa apa yang kami kelola saat ini dapat memberikan manfaat berkelanjutan dan lestari untuk masa depan yang lebih cerah bagi semua orang.", en: "Sustainability is an integral principle in establishing the strategy, business objectives, and daily operations of MIND ID and all MIND ID members. We uphold sustainability principles with full integrity to ensure that what we manage today can provide sustainable and lasting benefits for a brighter future for everyone." },
        sustainability_people: { id: "Insan MIND ID", en: "MIND ID People" },
        sustainability_community: { id: "Kemasyarakatan", en: "Community" },
        sustainability_environment: { id: "Lingkungan", en: "Environment" },
        sustainability_cta: { id: "Selengkapnya <i class='ph-bold ph-arrow-right'></i>", en: "Read More <i class='ph-bold ph-arrow-right'></i>" },
        report_sustainability_title: { id: "Laporan Keberlanjutan 2024", en: "Sustainability Report 2024" },
        report_sustainability_desc: { id: "Laporan keberlanjutan atau sustainability report adalah laporan kinerja yang dilakukan oleh perusahaan untuk mengukur, mengungkapkan, dan mengelola perubahan dalam rangka membuat kegiatan yang berkelanjutan.", en: "A sustainability report is a performance report conducted by a company to measure, disclose, and manage change in order to create sustainable activities." },
        report_tjsl_title: { id: "Laporan TJSL 2024", en: "TJSL Report 2024" },
        report_tjsl_desc: { id: "Grup MIND ID berkomitmen untuk terus mengambil peran strategis dalam mendorong peningkatan potensi daerah melalui penyelenggaran program Tanggung Jawab Sosial dan Lingkungan (TJSL) yang dilakukan secara terstruktur dan bersinergi dengan masyarakat maupun Pemerintah untuk mendukung pembangunan berkelanjutan.", en: "The MIND ID Group is committed to continuing to take a strategic role in encouraging the enhancement of regional potential through the implementation of the Social and Environmental Responsibility (TJSL) program, which is carried out in a structured manner and in synergy with the community and the Government to support sustainable development." },
        report_cta: { id: "UNDUH <i class='ph-bold ph-arrow-down'></i>", en: "DOWNLOAD <i class='ph-bold ph-arrow-down'></i>" },
        news_heading: { id: "Berita Terbaru", en: "Latest News" },
        news_all: { id: "SEMUA BERITA", en: "ALL NEWS" },
        news1_date: { id: "18 Des 2025", en: "Dec 18, 2025" },
        news1_title: { id: "MIND ID Dorong Inovasi Digital di Sektor Pertambangan", en: "MIND ID Pushes for Digital Innovation in the Mining Sector" },
        news_cta: { id: "Selengkapnya", en: "Read More" },
        news2_date: { id: "15 Des 2025", en: "Dec 15, 2025" },
        news2_title: { id: "Program Pemberdayaan Masyarakat oleh MIND ID Raih Penghargaan", en: "MIND ID's Community Empowerment Program Wins Award" },
        news3_date: { id: "12 Des 2025", en: "Dec 12, 2025" },
        news3_title: { id: "Ekspansi Hilirisasi, MIND ID Bangun Smelter Baru", en: "Downstream Expansion, MIND ID Builds a New Smelter" },
        members_heading: { id: "Anggota Kami", en: "Our Members" },
        members_text: { id: "MIND ID adalah wajah Indonesia yang kaya akan sumber daya dan kaya akan talenta dari putra-putri Indonesia yang siap berkarya dan bersinergi memberikan yang terbaik bagi negeri.", en: "MIND ID is the face of an Indonesia rich in resources and rich in talent from the sons and daughters of Indonesia who are ready to work and synergize to give the best for the country." },
        career_heading: { id: "Berkarya Bersama Kami", en: "Work With Us" },
        career_text: { id: "Jadilah bagian dari transformasi industri pertambangan Indonesia.", en: "Be a part of Indonesia's mining industry transformation." },
        career_cta: { id: "BERGABUNG <i class='ph-bold ph-arrow-right'></i>", en: "JOIN US <i class='ph-bold ph-arrow-right'></i>" },
        footer_address: { id: "Gedung Energy, 17th Floor, SCBD, Jakarta Selatan 12190, Indonesia", en: "Energy Building, 17th Floor, SCBD, South Jakarta 12190, Indonesia" },
        footer_links_title: { id: "Tautan", en: "Links" },
        footer_legal_title: { id: "Legal", en: "Legal" },
        footer_privacy: { id: "Kebijakan Privasi", en: "Privacy Policy" },
        footer_terms: { id: "Syarat & Ketentuan", en: "Terms & Conditions" },
        footer_social_title: { id: "Sosial", en: "Social" },
        footer_copyright: { id: "&copy; 2025 MIND ID. All Rights Reserved.", en: "&copy; 2025 MIND ID. All Rights Reserved." }
    };

    const langIdBtn = document.getElementById('lang-id');
    const langEnBtn = document.getElementById('lang-en');
    const i18nElements = document.querySelectorAll('[data-i18n]');

    function updateContent(lang) {
        i18nElements.forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (dictionary[key] && dictionary[key][lang]) {
                el.innerHTML = dictionary[key][lang];
            }
        });
        document.documentElement.lang = lang;

        if (lang === 'id') {
            langIdBtn.classList.add('text-mind-blue', 'font-bold');
            langIdBtn.classList.remove('text-text-secondary', 'font-semibold');
            langEnBtn.classList.add('text-text-secondary', 'font-semibold');
            langEnBtn.classList.remove('text-mind-blue', 'font-bold');
        } else {
            langEnBtn.classList.add('text-mind-blue', 'font-bold');
            langEnBtn.classList.remove('text-text-secondary', 'font-semibold');
            langIdBtn.classList.add('text-text-secondary', 'font-semibold');
            langIdBtn.classList.remove('text-mind-blue', 'font-bold');
        }
    }

    function setLanguage(lang) {
        localStorage.setItem('mind_lang', lang);
        updateContent(lang);
    }

    langIdBtn.addEventListener('click', () => setLanguage('id'));
    langEnBtn.addEventListener('click', () => setLanguage('en'));

    // Initial language setup
    const savedLang = localStorage.getItem('mind_lang') || 'id';
    setLanguage(savedLang);
});
