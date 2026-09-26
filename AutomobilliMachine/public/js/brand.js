document.addEventListener('DOMContentLoaded', () => {
    const page = document.querySelector('.brand-page');
    if (!page) return;

    const endpoint = page.dataset.carsEndpoint;
    const grid = document.querySelector('#carGrid');
    const searchInput = document.querySelector('#carSearch');
    const loadMoreButton = document.querySelector('#loadMoreCars');

    if (!endpoint || !grid) return;

    let pageNumber = 1;
    let lastPage = 1;
    let searchTimer = null;

    const escapeHtml = (value) => String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    const renderCars = (items, append = false) => {
        if (!append) grid.innerHTML = '';

        if (!items.length && !append) {
            grid.innerHTML = '<div class="brand-empty-state">No models matched your search.</div>';
            return;
        }

        const html = items.map((car) => {
            const image = car.image_path
                ? '<img src="' + escapeHtml(car.image_path.startsWith('http') ? car.image_path : '/' + car.image_path) + '" alt="' + escapeHtml(car.name) + '" loading="lazy">'
                : '<div class="brand-car-placeholder"><i class="fa-solid fa-car-side"></i></div>';

            const iconic = car.is_iconic
                ? '<span class="brand-icon-badge">Iconic</span>'
                : '';

            const specs = [
                car.horsepower ? '<span><b>' + escapeHtml(car.horsepower) + '</b> HP</span>' : '',
                car.top_speed_kmh ? '<span><b>' + escapeHtml(car.top_speed_kmh) + '</b> km/h</span>' : '',
                car.acceleration_0_100 ? '<span><b>' + escapeHtml(car.acceleration_0_100) + 's</b> 0–100</span>' : ''
            ].join('');

            return '<article class="brand-car-card">'
                + image
                + '<div class="brand-car-body">'
                + '<div class="brand-car-meta">'
                + '<span>' + escapeHtml(car.category?.name || 'Model') + '</span>'
                + iconic
                + '</div>'
                + '<h3>' + escapeHtml(car.name) + '</h3>'
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

        const params = new URLSearchParams({
            page: String(pageNumber),
            per_page: '8',
        });

        const search = searchInput?.value.trim();
        if (search) params.set('search', search);

        try {
            const response = await fetch(endpoint + '?' + params.toString(), {
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
            loadMoreButton.hidden = data.current_page >= data.last_page;
        } catch (error) {
            if (reset) {
                grid.innerHTML = '<div class="brand-empty-state">Unable to load models right now.</div>';
            }

            loadMoreButton.hidden = true;
            console.error('Failed to load brand models:', error);
        }
    };

    searchInput?.addEventListener('input', () => {
        window.clearTimeout(searchTimer);
        searchTimer = window.setTimeout(() => loadCars({ reset: true }), 300);
    });

    loadMoreButton?.addEventListener('click', () => {
        if (pageNumber >= lastPage) return;
        pageNumber += 1;
        loadCars();
    });

    loadCars({ reset: true });
});
