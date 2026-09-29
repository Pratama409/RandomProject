/* AutomobilliMachine — global app interactions */

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.querySelector('#automobilliSearch');
    const trigger = document.querySelector('.automobilli-search-trigger');
    const input = document.querySelector('#automobilliSearchInput');
    const results = document.querySelector('#automobilliSearchResults');

    if (!overlay || !trigger || !input || !results) return;

    let timer = null;
    let controller = null;

    const escapeHtml = (value) => String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    const resolveImage = (value) => {
        if (!value) return '';
        return value.startsWith('http') ? value : '/' + value;
    };

    const renderMessage = (message, icon = 'fa-magnifying-glass') => {
        results.innerHTML = '<div class="automobilli-search-empty is-visible">' +
            '<i class="fa-solid ' + icon + '"></i><p>' + escapeHtml(message) + '</p></div>';
    };

    const renderResults = (data) => {
        if (!data.brands?.length && !data.cars?.length) {
            renderMessage('No brands or models matched your search.', 'fa-circle-question');
            return;
        }

        let html = '';

        if (data.brands?.length) {
            html += '<section class="automobilli-search-group"><h3 class="automobilli-search-group-title">Brands</h3>';
            data.brands.forEach((brand) => {
                html += '<a class="automobilli-search-result" href="' + escapeHtml(brand.url) + '">' +
                    '<span class="automobilli-search-result-media">' +
                        (brand.image ? '<img src="' + escapeHtml(resolveImage(brand.image)) + '" alt="">' : '<i class="fa-solid fa-car"></i>') +
                    '</span>' +
                    '<span class="automobilli-search-result-copy"><strong>' + escapeHtml(brand.name) + '</strong><span>' + escapeHtml(brand.meta || 'Automotive brand') + '</span></span>' +
                    '<i class="fa-solid fa-arrow-right automobilli-search-result-arrow"></i>' +
                '</a>';
            });
            html += '</section>';
        }

        if (data.cars?.length) {
            html += '<section class="automobilli-search-group"><h3 class="automobilli-search-group-title">Models</h3>';
            data.cars.forEach((car) => {
                html += '<a class="automobilli-search-result" href="' + escapeHtml(car.url) + '">' +
                    '<span class="automobilli-search-result-media car">' +
                        (car.image ? '<img src="' + escapeHtml(resolveImage(car.image)) + '" alt="">' : '<i class="fa-solid fa-car-side"></i>') +
                    '</span>' +
                    '<span class="automobilli-search-result-copy"><strong>' + escapeHtml(car.name) + '</strong><span>' + escapeHtml(car.meta || 'Vehicle model') + '</span></span>' +
                    (car.iconic ? '<span class="badge bg-danger">Iconic</span>' : '') +
                '</a>';
            });
            html += '</section>';
        }

        results.innerHTML = html;
    };

    const search = async (term) => {
        const query = term.trim();

        if (query.length < 2) {
            renderMessage('Type at least 2 characters to search.');
            return;
        }

        controller?.abort();
        controller = new AbortController();

        results.innerHTML = '<div class="automobilli-search-loading is-visible"><i class="fa-solid fa-spinner fa-spin"></i><p>Searching Automobilli...</p></div>';

        try {
            const response = await fetch('/search?q=' + encodeURIComponent(query), {
                headers: { Accept: 'application/json' },
                signal: controller.signal,
            });

            if (!response.ok) throw new Error('Search request failed.');
            renderResults(await response.json());
        } catch (error) {
            if (error.name === 'AbortError') return;
            console.error(error);
            renderMessage('Search is temporarily unavailable.', 'fa-triangle-exclamation');
        }
    };

    const open = () => {
        overlay.classList.add('is-open');
        overlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('is-search-open');
        window.setTimeout(() => input.focus(), 50);
    };

    const close = () => {
        overlay.classList.remove('is-open');
        overlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('is-search-open');
        input.value = '';
        renderMessage('Search for a brand or vehicle model.');
        controller?.abort();
    };

    trigger.addEventListener('click', open);
    overlay.querySelectorAll('[data-search-close]').forEach((node) => node.addEventListener('click', close));

    input.addEventListener('input', () => {
        clearTimeout(timer);
        timer = window.setTimeout(() => search(input.value), 180);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && overlay.classList.contains('is-open')) {
            close();
        }
    });
});
