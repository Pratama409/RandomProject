document.addEventListener('DOMContentLoaded', () => {
    const favoriteButton = document.querySelector('.js-car-favorite');
    const wishlistButton = document.querySelector('.js-car-wishlist');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const setState = (button, active, type) => {
        if (!button) return;

        button.classList.toggle('is-active', active);
        button.setAttribute('aria-pressed', active ? 'true' : 'false');

        const icon = button.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-solid', active);
            icon.classList.toggle('fa-regular', !active);
        }
    };

    const toggle = async (button, type) => {
        if (!button) return;

        button.disabled = true;
        const id = button.dataset.carId;
        const name = button.dataset.carName || 'this car';
        const endpoint = type === 'favorite'
            ? '/cars/' + id + '/favorite'
            : '/cars/' + id + '/wishlist';

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();

            if (response.status === 401 && data.requires_auth) {
                window.alert(type === 'favorite'
                    ? 'Please sign in to save favorites.'
                    : 'Please sign in to save your wishlist.');
                return;
            }

            if (!response.ok) {
                throw new Error(data.message || 'Request failed');
            }

            setState(button, data.active, type);
        } catch (error) {
            console.error('Failed to update car save state:', error);
        } finally {
            button.disabled = false;
        }
    };

    favoriteButton?.addEventListener('click', () => toggle(favoriteButton, 'favorite'));
    wishlistButton?.addEventListener('click', () => toggle(wishlistButton, 'wishlist'));
});


/* Vehicle detail gallery */
document.addEventListener('DOMContentLoaded', () => {
    const heroImage = document.querySelector('#heroCarImage');
    const gallery = document.querySelector('[data-gallery]');

    if (!heroImage || !gallery) return;

    gallery.addEventListener('click', (event) => {
        const thumb = event.target.closest('.car-gallery-thumb');
        if (!thumb) return;

        const imageUrl = thumb.dataset.imageUrl;
        if (!imageUrl) return;

        heroImage.src = imageUrl;

        gallery.querySelectorAll('.car-gallery-thumb').forEach((item) => {
            item.classList.toggle('is-active', item === thumb);
        });
    });

    document.querySelectorAll('.car-gallery-card').forEach((card) => {
        card.addEventListener('click', () => {
            const imageUrl = card.dataset.galleryJump;
            if (!imageUrl || !heroImage) return;

            heroImage.src = imageUrl;
            document.querySelector('.car-showcase-hero')?.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        });
    });
});


/* Vehicle detail lightbox */
document.addEventListener('DOMContentLoaded', () => {
    const lightbox = document.querySelector('#carLightbox');
    if (!lightbox) return;

    const image = document.querySelector('#carLightboxImage');
    const caption = document.querySelector('#carLightboxCaption');
    const counter = document.querySelector('#carLightboxCounter');
    const thumbs = document.querySelector('#carLightboxThumbs');
    const prev = lightbox.querySelector('[data-lightbox-prev]');
    const next = lightbox.querySelector('[data-lightbox-next]');
    const closeButtons = lightbox.querySelectorAll('[data-lightbox-close]');

    const sourceNodes = [...document.querySelectorAll(
        '.js-lightbox-trigger[data-lightbox-src], .js-lightbox-trigger:not([data-lightbox-src])'
    )];

    const getSource = (node) => node.dataset.lightboxSrc || node.currentSrc || node.src;
    const items = sourceNodes
        .map((node) => ({
            src: getSource(node),
            caption: node.dataset.lightboxCaption || node.alt || '{{ $vehicle->name }}',
        }))
        .filter((item) => item.src);

    let currentIndex = 0;

    const renderThumbs = () => {
        thumbs.innerHTML = '';
        items.forEach((item, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'car-lightbox-thumb' + (index === currentIndex ? ' is-active' : '');
            button.setAttribute('aria-label', 'Show image ' + (index + 1));
            button.innerHTML = '<img src="' + item.src.replaceAll('"', '&quot;') + '" alt="">';
            button.addEventListener('click', () => {
                currentIndex = index;
                render();
            });
            thumbs.appendChild(button);
        });
    };

    const render = () => {
        const item = items[currentIndex];
        if (!item) return;
        image.src = item.src;
        image.alt = item.caption;
        caption.textContent = item.caption;
        counter.textContent = (currentIndex + 1) + ' / ' + items.length;
        thumbs.querySelectorAll('.car-lightbox-thumb').forEach((thumb, index) => {
            thumb.classList.toggle('is-active', index === currentIndex);
        });
    };

    const open = (node) => {
        const src = getSource(node);
        if (!src) return;

        const exact = items.findIndex((item) => item.src === src && item.caption === (node.dataset.lightboxCaption || node.alt || '{{ $vehicle->name }}'));
        currentIndex = exact >= 0 ? exact : 0;

        render();
        renderThumbs();
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('is-lightbox-open');
    };

    const close = () => {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('is-lightbox-open');
    };

    const move = (direction) => {
        if (!items.length) return;
        currentIndex = (currentIndex + direction + items.length) % items.length;
        render();
    };

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('.js-lightbox-trigger');
        if (!trigger || lightbox.contains(trigger)) return;
        event.preventDefault();
        open(trigger);
    });

    prev?.addEventListener('click', () => move(-1));
    next?.addEventListener('click', () => move(1));
    closeButtons.forEach((button) => button.addEventListener('click', close));

    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('is-open')) return;

        if (event.key === 'Escape') close();
        if (event.key === 'ArrowLeft') move(-1);
        if (event.key === 'ArrowRight') move(1);
    });
});


/* Vehicle insight modal */
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#carInsightModal');
    const triggers = [...document.querySelectorAll('.js-detail-insight-trigger')];
    const data = Array.isArray(window.AUTOMOBILLI_INSIGHTS) ? window.AUTOMOBILLI_INSIGHTS : [];

    if (!modal || !triggers.length || !data.length) return;

    const image = document.querySelector('#carInsightImage');
    const label = document.querySelector('#carInsightLabel');
    const title = document.querySelector('#carInsightTitle');
    const description = document.querySelector('#carInsightDescription');
    const specs = document.querySelector('#carInsightSpecs');
    const counter = document.querySelector('#carInsightCounter');
    const prev = modal.querySelector('[data-insight-prev]');
    const next = modal.querySelector('[data-insight-next]');
    const closeButtons = modal.querySelectorAll('[data-insight-close]');
    let currentIndex = 0;

    const render = () => {
        const item = data[currentIndex];
        if (!item) return;

        label.textContent = item.label || 'DETAIL';
        title.textContent = item.title || '';
        description.textContent = item.description || '';
        image.src = item.image || '';
        image.alt = item.title || item.label || 'Vehicle detail';
        counter.textContent = (currentIndex + 1) + ' / ' + data.length;

        specs.innerHTML = '';
        (item.items || []).forEach((spec) => {
            const row = document.createElement('div');
            row.className = 'car-detail-insight-spec';

            const key = document.createElement('span');
            key.textContent = spec.label || 'Detail';

            const value = document.createElement('strong');
            value.textContent = spec.value || '—';

            row.append(key, value);
            specs.appendChild(row);
        });
    };

    const open = (index) => {
        currentIndex = (index + data.length) % data.length;
        render();
        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('is-insight-modal-open');
    };

    const close = () => {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('is-insight-modal-open');
    };

    const move = (direction) => open(currentIndex + direction);

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => open(Number(trigger.dataset.insightIndex) || 0));
    });

    prev?.addEventListener('click', () => move(-1));
    next?.addEventListener('click', () => move(1));
    closeButtons.forEach((button) => button.addEventListener('click', close));

    document.addEventListener('keydown', (event) => {
        if (!modal.classList.contains('is-open')) return;
        if (event.key === 'Escape') close();
        if (event.key === 'ArrowLeft') move(-1);
        if (event.key === 'ArrowRight') move(1);
    });
});


/* Sticky vehicle navigation */
document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('.car-showcase-nav');
    if (!nav) return;

    const links = [...nav.querySelectorAll('.car-showcase-nav-scroll a[href^="#"]')];
    const sections = links
        .map((link) => {
            const id = link.getAttribute('href')?.slice(1);
            return id ? document.getElementById(id) : null;
        })
        .filter(Boolean);

    if (!links.length || !sections.length) return;

    const setActive = (sectionId) => {
        links.forEach((link) => {
            const active = link.getAttribute('href') === '#' + sectionId;
            link.classList.toggle('is-active', active);

            if (active && window.innerWidth > 700) {
                link.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center',
                });
            }
        });
    };

    const getNavOffset = () => nav.getBoundingClientRect().height + 10;

    links.forEach((link) => {
        link.addEventListener('click', (event) => {
            const id = link.getAttribute('href')?.slice(1);
            const target = id ? document.getElementById(id) : null;
            if (!target) return;

            event.preventDefault();

            const targetTop = target.getBoundingClientRect().top + window.scrollY - getNavOffset();
            window.scrollTo({
                top: Math.max(0, targetTop),
                behavior: 'smooth',
            });

            history.replaceState(null, '', '#' + id);
            setActive(id);
        });
    });

    const rootMarginTop = '-' + Math.max(62, getNavOffset()) + 'px';
    const observer = new IntersectionObserver((entries) => {
        const visible = entries
            .filter((entry) => entry.isIntersecting)
            .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

        if (visible[0]?.target?.id) {
            setActive(visible[0].target.id);
        }
    }, {
        root: null,
        rootMargin: rootMarginTop + ' 0px -62% 0px',
        threshold: [0.01, 0.12, 0.3, 0.55, 0.8],
    });

    sections.forEach((section) => observer.observe(section));

    const initialHash = window.location.hash.slice(1);
    if (initialHash && document.getElementById(initialHash)) {
        requestAnimationFrame(() => {
            setTimeout(() => {
                const target = document.getElementById(initialHash);
                const top = target.getBoundingClientRect().top + window.scrollY - getNavOffset();
                window.scrollTo({ top: Math.max(0, top), behavior: 'auto' });
                setActive(initialHash);
            }, 0);
        });
    } else {
        setActive(sections[0].id);
    }
});
