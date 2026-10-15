document.addEventListener('DOMContentLoaded', () => {
    // ====================================================
    // 1. NAVBAR & HERO GALLERY
    // ====================================================
    const navbar = document.querySelector('.navbar-custom');
    const scrollIndicator = document.querySelector('.scroll-indicator');
    const btnScrollTop = document.querySelector('.btn-scroll-top');

    const heroWrapper = document.querySelector('.hero-wrapper');
    const galleryColumns = [...document.querySelectorAll('.hero-wrapper .angled-gallery .gallery-col')];
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    // Scroll-linked parallax: each column follows a slightly different path.
    // All work is batched into one animation frame to avoid scroll jank.
    if (heroWrapper && galleryColumns.length && !reduceMotion.matches) {
        const parallaxRates = [-0.32, 0.24, -0.27, 0.19];
        let parallaxFrame = false;

        const updateGalleryParallax = () => {
            const heroHeight = heroWrapper.offsetHeight || window.innerHeight;
            const progress = Math.max(0, Math.min(
                -heroWrapper.getBoundingClientRect().top,
                heroHeight
            ));

            galleryColumns.forEach((column, index) => {
                const rate = parallaxRates[index % parallaxRates.length];
                const offset = Math.max(-190, Math.min(190, progress * rate));
                column.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)`;
            });

            parallaxFrame = false;
        };

        const requestGalleryParallax = () => {
            if (parallaxFrame) return;
            parallaxFrame = true;
            window.requestAnimationFrame(updateGalleryParallax);
        };

        window.addEventListener('scroll', requestGalleryParallax, { passive: true });
        window.addEventListener('resize', requestGalleryParallax, { passive: true });
        reduceMotion.addEventListener?.('change', (event) => {
            if (event.matches) {
                galleryColumns.forEach((column) => { column.style.transform = ''; });
            } else {
                requestGalleryParallax();
            }
        });
        requestGalleryParallax();
    }

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
            loop: false,
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
        });
    }

    // ====================================================
    // 3. ALL BRANDS DIRECTORY
    // ====================================================
    const brandCards = document.querySelectorAll('.all-brand-card');

    // Keep the directory ready for future expansion without adding UI noise today.
    brandCards.forEach((card) => {
        card.addEventListener('mouseenter', () => {
            card.classList.add('is-hovered');
        });

        card.addEventListener('mouseleave', () => {
            card.classList.remove('is-hovered');
        });
    });

    // ====================================================
    // 4. SMOOTH SCROLL UNTUK ANCHOR LINK (#)
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

    // ====================================================
    // 5. HOMEPAGE SECTION SPY
    //    Keeps the navbar active state tied to the visible
    //    homepage section instead of leaving Home selected.
    // ====================================================
    if (document.querySelector('.hero-wrapper') && document.querySelector('[data-home-nav]')) {
        const sectionIds = ['top', 'brands', 'brand-directory', 'iconic', 'compare', 'membership'];
        const navLinks = [...document.querySelectorAll('[data-home-nav]')];
        const observedSections = sectionIds
            .map((id) => document.getElementById(id))
            .filter(Boolean);

        const setActiveNav = (id) => {
            navLinks.forEach((link) => {
                link.classList.toggle('active', link.dataset.homeNav === id);
            });
        };

        const observer = new IntersectionObserver((entries) => {
            const visible = entries
                .filter((entry) => entry.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

            if (visible[0]?.target?.id) {
                setActiveNav(visible[0].target.id);
            }
        }, {
            rootMargin: '-18% 0px -62% 0px',
            threshold: [0.08, 0.2, 0.45, 0.7],
        });

        observedSections.forEach((section) => observer.observe(section));

        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                const id = link.dataset.homeNav;
                if (document.getElementById(id)) {
                    setActiveNav(id);
                }
            });
        });

        setActiveNav('top');
    }

});
