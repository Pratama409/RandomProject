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
