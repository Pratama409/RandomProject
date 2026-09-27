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
    const clearFiltersButton = document.querySelector('#clearCarFilters');
    const resultCount = document.querySelector('#carResultCount');
    const loadMoreButton = document.querySelector('#loadMoreCars');

    if (!endpoint || !grid) return;

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

            const badges = [
                car.production_type,
                car.vehicle_type,
                car.is_one_off ? 'One-Off' : '',
                car.is_limited ? 'Limited' : '',
                car.is_track_only ? 'Track Only' : '',
                car.is_racing ? 'Racing' : '',
                car.is_concept ? 'Concept' : ''
            ].filter(Boolean);

            const badgeHtml = badges
                .slice(0, 3)
                .map((badge) => '<span class="brand-catalog-badge">' + escapeHtml(badge) + '</span>')
                .join('');

            const specs = [
                car.horsepower ? '<span><b>' + escapeHtml(car.horsepower) + '</b> HP</span>' : '',
                car.top_speed_kmh ? '<span><b>' + escapeHtml(car.top_speed_kmh) + '</b> km/h</span>' : '',
                car.acceleration_0_100 ? '<span><b>' + escapeHtml(car.acceleration_0_100) + 's</b> 0–100</span>' : '',
                car.production_count ? '<span><b>' + escapeHtml(car.production_count) + '</b> built</span>' : ''
            ].filter(Boolean).join('');

            const yearRange = car.production_year_start
                ? escapeHtml(car.production_year_start)
                    + (car.production_year_end
                        ? ' – ' + escapeHtml(car.production_year_end)
                        : ' – Present')
                : 'Year not specified';

            const family = car.model_family
                ? '<span class="brand-catalog-family">' + escapeHtml(car.model_family) + '</span>'
                : '';

            return '<article class="brand-car-card">'
                + image
                + '<div class="brand-car-body">'
                + '<div class="brand-car-meta">'
                + '<span>' + escapeHtml(car.category?.name || 'Model') + '</span>'
                + '<span class="brand-icon-badge">' + (car.is_iconic ? 'Iconic' : '') + '</span>'
                + '</div>'
                + '<div class="brand-catalog-badges">' + badgeHtml + '</div>'
                + '<h3>' + escapeHtml(car.name) + '</h3>'
                + family
                + '<span class="brand-catalog-years">' + yearRange + '</span>'
                + (car.short_description ? '<p>' + escapeHtml(car.short_description) + '</p>' : '')
                + '<div class="brand-spec-row">' + specs + '</div>'
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
        if (productionTypeSelect?.value) params.set('production_type', productionTypeSelect.value);
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

    const resetAndLoad = () => loadCars({ reset: true });

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
