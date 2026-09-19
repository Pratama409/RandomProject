document.addEventListener('DOMContentLoaded', () => {
    const columns = document.querySelectorAll('.gallery-col');
    const scrollIndicator = document.querySelector('.scroll-indicator');
    const btnScrollTop = document.querySelector('.btn-scroll-top');

    let ticking = false;

    // ====================================================
    // 1. EFEK SLIDE SEMUA KOLOM GAMBAR SAAT SCROLL
    // ====================================================
    window.addEventListener('scroll', () => {
        const scrollY = window.pageYOffset;

        if (!ticking) {
            window.requestAnimationFrame(() => {
                if (window.innerWidth > 768) {
                    // Setiap kolom bergeser berlawanan arah secara dinamis
                    columns.forEach((col, index) => {
                        const direction = index % 2 === 0 ? 1 : -1;
                        const speed = 0.4 + (index * 0.05);
                        col.style.transform = `translateY(${scrollY * speed * direction}px)`;
                    });
                }

                // Tombol Back to Top
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
    // 2. KLIK TOMBOL SCROLL KE SECTION BRAND
    // ====================================================
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            const firstBrand = document.querySelector('#brands');
            if (firstBrand) {
                firstBrand.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // ====================================================
    // 3. KLIK TOMBOL KEMBALI KE PALING ATAS
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
});