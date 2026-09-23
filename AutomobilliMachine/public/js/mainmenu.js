document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar-custom');
    const columns = document.querySelectorAll('.gallery-col');
    const scrollIndicator = document.querySelector('.scroll-indicator');
    const btnScrollTop = document.querySelector('.btn-scroll-top');

    let ticking = false;

    // ====================================================
    // 1. EFEK SCROLL: NAVBAR & PARALAKS KOLOM GAMBAR
    // ====================================================
    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

        // A. Background Navbar saat scroll
        if (navbar) {
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // B. Efek Gerak Dinamis Kolom Gambar Miring (Parallax)
        if (!ticking) {
            window.requestAnimationFrame(() => {
                if (window.innerWidth > 768 && columns.length > 0) {
                    columns.forEach((col, index) => {
                        const direction = index % 2 === 0 ? 1 : -1;
                        const speed = 0.35 + (index * 0.05);
                        col.style.transform = `translateY(${scrollY * speed * direction}px)`;
                    });
                }

                // C. Tampilkan / Sembunyikan Tombol Back to Top
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

    // ====================================================
    // 2. KLIK SCROLL-DOWN INDICATOR DI HERO
    // ====================================================
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            const brandsSection = document.querySelector('#brands');
            if (brandsSection) {
                brandsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // ====================================================
    // 3. KLIK TOMBOL BACK TO TOP
    // ====================================================
    if (btnScrollTop) {
        btnScrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ====================================================
    // 4. SMOOTH SCROLL UNTUK SEMUA TAUTAN ANCHOR (#)
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