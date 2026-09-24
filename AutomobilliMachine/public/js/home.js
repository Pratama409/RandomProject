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

        // Efek blur pada navbar saat scroll
        if (navbar) {
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Efek gerak dinamis berlawanan kolom galeri miring
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
    });

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
    // 2. SWIPER BRAND SLIDER (DENGAN TOMBOL NAVIGASI & MOUSE DRAG)
    // ====================================================
    if (typeof Swiper !== 'undefined' && document.querySelector('.brand-swiper')) {
        const swiper = new Swiper('.brand-swiper', {
            slidesPerView: 1,      // 1 kartu utuh pas sejajar
            spaceBetween: 30,
            loop: true,
            speed: 650,
            grabCursor: true,      // Kursor otomatis tangan (grab)
            simulateTouch: true,   // Mendukung mouse drag di desktop 100%
            navigation: {
                nextEl: '#brandNextBtn',
                prevEl: '#brandPrevBtn',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
        });

        console.log('Automobilli Swiper with luxury navigation buttons active.');
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