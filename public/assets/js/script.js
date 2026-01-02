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

    // --- NAVBAR ACTIVE STATE ---
    const navItems = document.querySelectorAll('.nav-item');
    const currentPath = window.location.pathname;
    
    // Determine the active page based on the URL path
    let activePage = 'nav_home'; // Default
    if (currentPath.includes('/company')) {
        activePage = 'nav_company';
    } else if (currentPath.includes('/members')) {
        activePage = 'nav_members';
    } else if (currentPath.includes('/news')) {
        activePage = 'nav_news';
    } else if (currentPath.includes('/career')) {
        activePage = 'nav_career';
    } else if (currentPath.includes('/contact')) {
        activePage = 'nav_contact';
    }

    // Set the active class on the correct nav item
    navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-nav') === activePage) {
            item.classList.add('active');
        }
    });

    // --- ADVANCED MOBILE MENU LOGIC ---
    const btn = document.getElementById('mobile-menu-btn');
    const overlay = document.getElementById('mobile-menu-overlay');
    const mainHeader = document.getElementById('main-header');
    const lines = document.querySelectorAll('.line-span');
    const body = document.body;

    if (btn && overlay && mainHeader && lines.length > 0) {
        let isOpen = false;

        btn.addEventListener('click', () => {
            isOpen = !isOpen;

            // Use a class on the body to handle state
            body.classList.toggle('menu-open', isOpen);

            if (isOpen) {
                // --- BUKA MENU ---
                mainHeader.classList.remove('bg-white/95', 'backdrop-blur-lg', 'shadow-sm');
                mainHeader.classList.add('bg-transparent');

                lines.forEach(line => line.classList.add('bg-white'));
                lines[0].classList.add('rotate-45', 'translate-y-[9px]', 'w-8');
                lines[1].classList.add('opacity-0');
                lines[2].classList.add('-rotate-45', '-translate-y-[9px]', 'w-8');
                
                overlay.classList.remove('-translate-y-full');
                body.classList.add('overflow-hidden', 'no-scrollbar');

                setTimeout(() => {
                    overlay.classList.add('menu-active');
                }, 100);

            } else {
                // --- TUTUP MENU ---
                setTimeout(() => {
                    mainHeader.classList.add('bg-white/95', 'backdrop-blur-lg', 'shadow-sm');
                    mainHeader.classList.remove('bg-transparent');
                    lines.forEach(line => line.classList.remove('bg-white'));
                }, 400);

                lines[0].classList.remove('rotate-45', 'translate-y-[9px]', 'w-8');
                lines[1].classList.remove('opacity-0');
                lines[2].classList.remove('-rotate-45', '-translate-y-[9px]', 'w-8');

                overlay.classList.remove('menu-active');
                body.classList.remove('overflow-hidden', 'no-scrollbar');
                
                setTimeout(() => {
                    overlay.classList.add('-translate-y-full');
                }, 200); 
            }
        });
    }
});