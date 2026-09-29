/* AutomobilliMachine — Vehicle Detail interactions */

document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    /* ---------------------------------
       Favorite / Wishlist
       --------------------------------- */
    const toggleSave = async (button, endpoint) => {
        const carId = button.dataset.carId;
        if (!carId) return;

        button.disabled = true;

        try {
            const response = await fetch(endpoint.replace(':id', carId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf || '',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const payload = await response.json();

            if (payload.requires_auth) {
                window.location.href = '/login';
                return;
            }

            if (!response.ok) throw new Error(payload.message || 'Request failed.');

            button.classList.toggle('is-active', Boolean(payload.active));
            button.setAttribute('aria-pressed', payload.active ? 'true' : 'false');

            const icon = button.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-solid', Boolean(payload.active));
                icon.classList.toggle('fa-regular', !payload.active);
            }
        } catch (error) {
            console.error(error);
        } finally {
            button.disabled = false;
        }
    };

    document.querySelectorAll('.js-car-favorite').forEach((button) => {
        button.addEventListener('click', () => toggleSave(button, '/cars/:id/favorite'));
    });

    document.querySelectorAll('.js-car-wishlist').forEach((button) => {
        button.addEventListener('click', () => toggleSave(button, '/cars/:id/wishlist'));
    });

    /* ---------------------------------
       Hero gallery
       --------------------------------- */
    const heroImage = document.querySelector('#carHeroImage');

    document.querySelectorAll('.js-hero-image-trigger').forEach((thumb) => {
        thumb.addEventListener('click', () => {
            if (!heroImage) return;
            heroImage.src = thumb.dataset.imageUrl;
            document.querySelectorAll('.js-hero-image-trigger').forEach((item) => {
                item.classList.toggle('is-active', item === thumb);
            });
        });
    });

    /* ---------------------------------
       Image lightbox
       --------------------------------- */
    const lightbox = document.querySelector('#carLightbox');
    const lightboxImage = document.querySelector('#carLightboxImage');
    const lightboxCaption = document.querySelector('#carLightboxCaption');
    const lightboxCounter = document.querySelector('#carLightboxCounter');
    const lightboxThumbs = document.querySelector('#carLightboxThumbs');

    if (lightbox && lightboxImage) {
        const triggers = [...document.querySelectorAll('.js-lightbox-trigger')];
        const items = triggers.map((node) => ({
            src: node.dataset.lightboxSrc || node.currentSrc || node.src,
            caption: node.dataset.lightboxCaption || node.alt || 'Vehicle image',
        })).filter((item) => item.src);

        let index = 0;

        const renderLightbox = () => {
            const item = items[index];
            if (!item) return;

            lightboxImage.src = item.src;
            lightboxImage.alt = item.caption;
            lightboxCaption.textContent = item.caption;
            lightboxCounter.textContent = (index + 1) + ' / ' + items.length;

            lightboxThumbs.innerHTML = '';
            items.forEach((entry, itemIndex) => {
                const thumb = document.createElement('button');
                thumb.type = 'button';
                thumb.className = 'car-lightbox-thumb' + (itemIndex === index ? ' is-active' : '');
                thumb.innerHTML = '<img src="' + entry.src.replace(/"/g, '&quot;') + '" alt="">';
                thumb.addEventListener('click', () => {
                    index = itemIndex;
                    renderLightbox();
                });
                lightboxThumbs.appendChild(thumb);
            });
        };

        const openLightbox = (trigger) => {
            const src = trigger.dataset.lightboxSrc || trigger.currentSrc || trigger.src;
            const found = items.findIndex((item) => item.src === src);
            index = found >= 0 ? found : 0;
            renderLightbox();
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('is-car-modal-open');
        };

        const closeLightbox = () => {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('is-car-modal-open');
        };

        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('.js-lightbox-trigger');
            if (!trigger || lightbox.contains(trigger)) return;
            event.preventDefault();
            openLightbox(trigger);
        });

        lightbox.querySelector('[data-lightbox-prev]')?.addEventListener('click', () => {
            index = (index - 1 + items.length) % items.length;
            renderLightbox();
        });

        lightbox.querySelector('[data-lightbox-next]')?.addEventListener('click', () => {
            index = (index + 1) % items.length;
            renderLightbox();
        });

        lightbox.querySelectorAll('[data-lightbox-close]').forEach((node) => {
            node.addEventListener('click', closeLightbox);
        });

        document.addEventListener('keydown', (event) => {
            if (!lightbox.classList.contains('is-open')) return;
            if (event.key === 'Escape') closeLightbox();
            if (event.key === 'ArrowLeft') lightbox.querySelector('[data-lightbox-prev]')?.click();
            if (event.key === 'ArrowRight') lightbox.querySelector('[data-lightbox-next]')?.click();
        });
    }

    /* ---------------------------------
       Sticky section navigation
       --------------------------------- */
    const nav = document.querySelector('.car-detail-nav');
    const navScroll = document.querySelector('.car-detail-nav-scroll');

    if (nav && navScroll) {
        const links = [...nav.querySelectorAll('[data-section-link]')];
        const sections = links
            .map((link) => document.getElementById(link.getAttribute('href').slice(1)))
            .filter(Boolean);

        const setActive = (id) => {
            links.forEach((link) => {
                const active = link.getAttribute('href') === '#' + id;
                link.classList.toggle('is-active', active);

                if (active) {
                    const targetLeft = link.offsetLeft - (navScroll.clientWidth / 2) + (link.offsetWidth / 2);
                    navScroll.scrollTo({ left: Math.max(0, targetLeft), behavior: 'smooth' });
                }
            });
        };

        links.forEach((link) => {
            link.addEventListener('click', (event) => {
                const target = document.getElementById(link.getAttribute('href').slice(1));
                if (!target) return;

                event.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                history.replaceState(null, '', link.getAttribute('href'));
                setActive(target.id);
            });
        });

        const observer = new IntersectionObserver((entries) => {
            const visible = entries
                .filter((entry) => entry.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

            if (visible[0]?.target?.id) {
                setActive(visible[0].target.id);
            }
        }, {
            rootMargin: '-70px 0px -62% 0px',
            threshold: [0.05, 0.2, 0.5],
        });

        sections.forEach((section) => observer.observe(section));

        const hash = window.location.hash.slice(1);
        if (hash) {
            const target = document.getElementById(hash);
            if (target) {
                requestAnimationFrame(() => target.scrollIntoView({ behavior: 'auto', block: 'start' }));
            }
        } else if (sections[0]) {
            setActive(sections[0].id);
        }
    }
});
