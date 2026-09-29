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
