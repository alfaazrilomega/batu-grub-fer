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
});