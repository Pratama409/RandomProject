document.addEventListener('DOMContentLoaded', () => {
    // ====================================================
    // 1. NAVBAR & PARALLAX HERO GALLERY
    // ====================================================
    const navbar = document.querySelector('.navbar-custom');
    const columns = document.querySelectorAll('.gallery-col');
    const scrollIndicator = document.querySelector('.scroll-indicator');
    const btnScrollTop = document.querySelector('.btn-scroll-top');

    let ticking = false;

    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

        if (navbar) {
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        if (!ticking) {
            window.requestAnimationFrame(() => {
                if (window.innerWidth > 768 && columns.length > 0) {
                    columns.forEach((col, index) => {
                        const direction = index % 2 === 0 ? 1 : -1;
                        const speed = 0.35 + (index * 0.05);
                        col.style.transform = `translateY(${scrollY * speed * direction}px)`;
                    });
                }

                if (btnScrollTop) {
                    if (scrollY > 500) {
                        btnScrollTop.classList.add('show');
                    } else {
                        btnScrollTop.classList.remove('show');
                    }
                }

                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });

    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            const brandsSection = document.querySelector('#brands');
            if (brandsSection) {
                brandsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    if (btnScrollTop) {
        btnScrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ====================================================
    // 2. SWIPER BRAND SLIDER
    //    Tuned for smoother mouse/touch dragging.
    // ====================================================
    if (typeof Swiper !== 'undefined' && document.querySelector('.brand-swiper')) {
        new Swiper('.brand-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            speed: 360,
            grabCursor: true,
            simulateTouch: true,
            followFinger: true,
            threshold: 4,
            touchRatio: 0.9,
            longSwipes: true,
            longSwipesRatio: 0.08,
            longSwipesMs: 120,
            resistance: true,
            resistanceRatio: 0.65,
            preventClicks: true,
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            navigation: {
                nextEl: '#brandNextBtn',
                prevEl: '#brandPrevBtn',
            },
            autoHeight: false,
            watchOverflow: true,
            observer: true,
            observeParents: true,
            observeSlideChildren: false,
        });
    }

    // ====================================================
    // 3. SMOOTH SCROLL UNTUK ANCHOR LINK (#)
    // ====================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');

            if (targetId && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});
