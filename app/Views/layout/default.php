<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batu Group</title>

    <!-- Google Fonts: Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Tailwind CSS with Custom Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Work Sans', 'sans-serif'],
                    },
                    colors: {
                        'mind-blue': '#292F6F',
                        'dark-navy': '#1A1E29',
                        'mind-red': '#D91B23',
                        'footer-blue': '#101828',
                        'text-dark': '#2F3133',
                        'text-secondary': '#616367',
                    }
                }
            }
        }
    </script>

    <style>
        .hero-gradient {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4), transparent);
            pointer-events: none;
        }
        .section-fade-in {
            opacity: 0;
            transform: translateY(2rem); /* 32px */
        }
        .hero-text-element {
            opacity: 0;
            transform: translateY(30px);
        }
        .swiper-pagination-bullet {
            width: 0.75rem; /* 12px */
            height: 0.75rem; /* 12px */
            background-color: rgba(255, 255, 255, 0.5);
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        .swiper-pagination-bullet-active {
            background-color: #D91B23; /* mind-red */
            transform: scale(1.25);
        }
        .members-nav {
            color: #000;
            background-color: #fff;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border-radius: 9999px;
            width: 3rem; /* 48px */
            height: 3rem; /* 48px */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .members-nav:hover {
            background-color: #E5E7EB; /* gray-200 */
        }
    </style>
    
    <!-- Custom Hamburger Menu Style -->
    <style>
        /* Sembunyikan scrollbar saat menu terbuka */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ANIMASI MENU ITEM: Soft Fade Up Stagger */
        .nav-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .menu-active .nav-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered Delays (Muncul berurutan) */
        .menu-active .nav-item:nth-child(1) { transition-delay: 0.2s; }
        .menu-active .nav-item:nth-child(2) { transition-delay: 0.3s; }
        .menu-active .nav-item:nth-child(3) { transition-delay: 0.4s; }
        .menu-active .nav-item:nth-child(4) { transition-delay: 0.5s; }
        .menu-active .nav-item:nth-child(5) { transition-delay: 0.6s; }
        .menu-active .nav-item:nth-child(6) { transition-delay: 0.7s; }

        /* Background Pattern Halus */
        .topo-bg {
            background-color: #16325C;
            background-image: radial-gradient(#1e4278 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>

    <!-- Custom App CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>

<body class="bg-white text-text-dark font-sans antialiased">

    <?= $this->include('layout/header') ?>

    <?= $this->renderSection('content') ?>

    <?= $this->include('layout/footer') ?>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        window.baseUrl = '<?= base_url() ?>';
    </script>
    <!-- Custom App JS -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>