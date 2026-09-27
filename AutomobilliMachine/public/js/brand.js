document.addEventListener('DOMContentLoaded', () => {
    const page = document.querySelector('.brand-page');
    if (!page) return;

    const endpoint = page.dataset.carsEndpoint;
    const grid = document.querySelector('#carGrid');
    const searchInput = document.querySelector('#carSearch');
    const yearSelect = document.querySelector('#carYear');
    const categorySelect = document.querySelector('#carCategory');
    const drivetrainSelect = document.querySelector('#carDrivetrain');
    const fuelTypeSelect = document.querySelector('#carFuelType');
    const productionTypeSelect = document.querySelector('#carProductionType');
    const vehicleTypeSelect = document.querySelector('#carVehicleType');
    const toggleAdvancedFilters = document.querySelector('#toggleAdvancedFilters');
    const advancedFilters = document.querySelector('#advancedCarFilters');
    const clearFiltersButton = document.querySelector('#clearCarFilters');
    const resultCount = document.querySelector('#carResultCount');
    const loadMoreButton = document.querySelector('#loadMoreCars');

    if (!endpoint || !grid) return;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const favoriteEndpoint = (carId) => '/cars/' + carId + '/favorite';
    const wishlistEndpoint = (carId) => '/cars/' + carId + '/wishlist';

    let pageNumber = 1;
    let lastPage = 1;
    let searchTimer = null;
    let requestController = null;

    const escapeHtml = (value) => String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    const getImageUrl = (imagePath) => {
        if (!imagePath) return '';
        return imagePath.startsWith('http') ? imagePath : '/' + imagePath;
    };

    const updateResultCount = (data) => {
        if (!resultCount) return;

        if (!data.total) {
            resultCount.textContent = 'No models found';
            return;
        }

        const loadedCount = grid.querySelectorAll('.brand-car-card').length;
        resultCount.textContent = `Showing 1–${Math.min(loadedCount, data.total)} of ${data.total} models`;
    };

    const renderCars = (items, append = false) => {
        if (!append) grid.innerHTML = '';

        if (!items.length && !append) {
            grid.innerHTML = '<div class="brand-empty-state">No models matched your filters.</div>';
            return;
        }

        const html = items.map((car) => {
            const image = car.image_path
                ? '<img src="' + escapeHtml(getImageUrl(car.image_path)) + '" alt="' + escapeHtml(car.name) + '" loading="lazy">'
                : '<div class="brand-car-placeholder"><i class="fa-solid fa-car-side"></i></div>';

            const specialBadges = [
                car.production_type && car.production_type !== 'Production' ? car.production_type : '',
                car.is_one_off ? 'One-Off' : '',
                car.is_concept ? 'Concept' : '',
                car.is_track_only ? 'Track Only' : '',
                car.is_racing ? 'Racing' : ''
            ].filter(Boolean);

            const badgeHtml = specialBadges
                .slice(0, 2)
                .map((badge) => '<span class="brand-catalog-badge">' + escapeHtml(badge) + '</span>')
                .join('');

            const formatStat = (value, suffix = '') => value !== null && value !== undefined && value !== ''
                ? '<span class="brand-stat"><b>' + escapeHtml(value) + '</b>' + suffix + '</span>'
                : '<span class="brand-stat"><b>—</b>' + suffix + '</span>';

            const specs = [
                formatStat(car.horsepower, ' HP'),
                formatStat(car.top_speed_kmh, ' km/h'),
                formatStat(car.acceleration_0_100, 's 0–100')
            ].join('');

            const statsStatus = car.stats_tested
                ? '<span class="brand-stats-status is-tested">Tested</span>'
                : '<span class="brand-stats-status is-not-tested">Not Tested</span>';

            const yearRange = car.production_year_start
                ? escapeHtml(car.production_year_start)
                    + (car.production_year_end
                        ? ' – ' + escapeHtml(car.production_year_end)
                        : ' – Present')
                : 'Year not specified';

            const saveButtons = `
                <div class="brand-card-actions">
                    <button
                        type="button"
                        class="brand-save-button js-favorite-button ${car.is_favorited ? 'is-active' : ''}"
                        data-car-id="${escapeHtml(car.id)}"
                        data-car-name="${escapeHtml(car.name)}"
                        aria-label="${car.is_favorited ? 'Remove ' + escapeHtml(car.name) + ' from favorites' : 'Add ' + escapeHtml(car.name) + ' to favorites'}"
                        aria-pressed="${car.is_favorited ? 'true' : 'false'}"
                        title="Favorite"
                    >
                        <i class="${car.is_favorited ? 'fa-solid' : 'fa-regular'} fa-heart"></i>
                    </button>
                    <button
                        type="button"
                        class="brand-save-button js-wishlist-button ${car.is_wishlisted ? 'is-active' : ''}"
                        data-car-id="${escapeHtml(car.id)}"
                        aria-label="${car.is_wishlisted ? 'Remove ' + escapeHtml(car.name) + ' from wishlist' : 'Add ' + escapeHtml(car.name) + ' to wishlist'}"
                        aria-pressed="${car.is_wishlisted ? 'true' : 'false'}"
                        title="Wishlist"
                    >
                        <i class="${car.is_wishlisted ? 'fa-solid' : 'fa-regular'} fa-bookmark"></i>
                    </button>
                </div>`;

            const iconicBadge = car.is_iconic
                ? '<span class="brand-icon-badge brand-icon-badge-overlay">Iconic</span>'
                : '';

            return '<article class="brand-car-card" data-car-name="' + escapeHtml(car.name) + '">'
                + '<div class="brand-car-image-wrap">' + image + iconicBadge + '</div>'
                + '<div class="brand-car-body">'
                + '<div class="brand-car-meta">'
                + '<span>' + escapeHtml(car.category?.name || 'Model') + '</span>'
                + saveButtons
                + '</div>'
                + (badgeHtml ? '<div class="brand-catalog-badges">' + badgeHtml + '</div>' : '')
                + '<h3>' + escapeHtml(car.name) + '</h3>'
                + '<span class="brand-catalog-years">' + yearRange + '</span>'
                + (car.short_description ? '<p>' + escapeHtml(car.short_description) + '</p>' : '')
                + '<div class="brand-spec-row">' + specs + statsStatus + '</div>'
                + '</div>'
                + '</article>';
        }).join('');

        grid.insertAdjacentHTML('beforeend', html);
    };

    const loadCars = async ({ reset = false } = {}) => {
        if (reset) {
            pageNumber = 1;
            grid.innerHTML = '<div class="brand-loading-state">Loading models...</div>';
        }

        requestController?.abort();
        requestController = new AbortController();

        const params = new URLSearchParams({
            page: String(pageNumber),
            per_page: '8',
        });

        const search = searchInput?.value.trim();
        if (search) params.set('search', search);

        if (yearSelect?.value) params.set('year', yearSelect.value);
        if (categorySelect?.value) params.set('category', categorySelect.value);
        if (drivetrainSelect?.value) params.set('drivetrain', drivetrainSelect.value);
        if (fuelTypeSelect?.value) params.set('fuel_type', fuelTypeSelect.value);
        if (productionTypeSelect?.value) {
            params.set('production_type', productionTypeSelect.value);
        }
        if (vehicleTypeSelect?.value) params.set('vehicle_type', vehicleTypeSelect.value);

        try {
            const response = await fetch(endpoint + '?' + params.toString(), {
                signal: requestController.signal,
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (!response.ok) {
                throw new Error('HTTP ' + response.status);
            }

            const data = await response.json();
            lastPage = data.last_page;

            renderCars(data.data, !reset && pageNumber > 1);
            updateResultCount(data);
            loadMoreButton.hidden = data.current_page >= data.last_page;
        } catch (error) {
            if (error.name === 'AbortError') return;

            if (reset) {
                grid.innerHTML = '<div class="brand-empty-state">Unable to load models right now.</div>';
            }

            resultCount.textContent = 'Unable to load models';
            loadMoreButton.hidden = true;
            console.error('Failed to load brand models:', error);
        }
    };

    const setSaveButtonState = (button, active) => {
        if (!button) return;

        const icon = button.querySelector('i');
        button.classList.toggle('is-active', active);
        button.setAttribute('aria-pressed', active ? 'true' : 'false');

        const isFavorite = button.classList.contains('js-favorite-button');
        const label = button.dataset.carName || button.closest('[data-car-name]')?.dataset.carName || 'this car';

        button.setAttribute(
            'aria-label',
            active
                ? `Remove ${label} from ${isFavorite ? 'favorites' : 'wishlist'}`
                : `Add ${label} to ${isFavorite ? 'favorites' : 'wishlist'}`
        );

        if (icon) {
            icon.classList.toggle('fa-solid', active);
            icon.classList.toggle('fa-regular', !active);
        }
    };

    const toggleSavedState = async (button, type) => {
        const carId = button?.dataset.carId;
        if (!carId) return;

        button.disabled = true;

        try {
            const response = await fetch(
                type === 'favorite' ? favoriteEndpoint(carId) : wishlistEndpoint(carId),
                {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                }
            );

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

            setSaveButtonState(button, data.active);
        } catch (error) {
            console.error('Failed to update saved car state:', error);
        } finally {
            button.disabled = false;
        }
    };

    grid.addEventListener('click', (event) => {
        const button = event.target.closest('.js-favorite-button, .js-wishlist-button');
        if (!button) return;

        event.preventDefault();
        event.stopPropagation();

        toggleSavedState(
            button,
            button.classList.contains('js-favorite-button') ? 'favorite' : 'wishlist'
        );
    });

    const resetAndLoad = () => loadCars({ reset: true });

    toggleAdvancedFilters?.addEventListener('click', () => {
        if (!advancedFilters) return;

        const isOpen = toggleAdvancedFilters.getAttribute('aria-expanded') === 'true';
        toggleAdvancedFilters.setAttribute('aria-expanded', String(!isOpen));
        advancedFilters.hidden = isOpen;
        toggleAdvancedFilters.querySelector('span').textContent = 'Filters';
    });

    searchInput?.addEventListener('input', () => {
        window.clearTimeout(searchTimer);
        searchTimer = window.setTimeout(resetAndLoad, 300);
    });

    [
        yearSelect,
        categorySelect,
        drivetrainSelect,
        fuelTypeSelect,
        productionTypeSelect,
        vehicleTypeSelect
    ].forEach((select) => {
        select?.addEventListener('change', resetAndLoad);
    });

    clearFiltersButton?.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';

        [
            yearSelect,
            categorySelect,
            drivetrainSelect,
            fuelTypeSelect,
            productionTypeSelect,
            vehicleTypeSelect
        ].forEach((select) => {
            if (select) select.value = '';
        });

        resetAndLoad();
    });

    loadMoreButton?.addEventListener('click', () => {
        if (pageNumber >= lastPage) return;

        pageNumber += 1;
        loadCars();
    });

    loadCars({ reset: true });
});
