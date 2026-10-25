/* Rich car-editor controls: lightweight, dependency-free repeaters and file previews. */
(() => {
    'use strict';

    document.querySelectorAll('[data-admin-repeater]').forEach((repeater) => {
        const rows = repeater.querySelector('[data-repeater-rows]');
        const template = repeater.querySelector('[data-repeater-template]');
        const add = repeater.querySelector('[data-repeater-add]');
        if (!rows || !template || !add) return;

        // Use an index above initial rendered rows so sparse server indexes cannot collide.
        let nextIndex = 100 + Number(repeater.dataset.nextIndex || 0);

        add.addEventListener('click', () => {
            const fieldCount = rows.querySelectorAll('.admin-editor-repeat-row').length;
            if (fieldCount >= 30) return;

            const html = template.innerHTML.replaceAll('__INDEX__', String(nextIndex++));
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            const item = wrapper.firstElementChild;
            if (!item) return;

            rows.appendChild(item);
            item.querySelector('input')?.focus();
        });

        rows.addEventListener('click', (event) => {
            const remove = event.target.closest('[data-repeater-remove]');
            if (!remove) return;
            remove.closest('.admin-editor-repeat-row')?.remove();
        });
    });

    document.querySelectorAll('input[type="file"][name="gallery_files[]"]').forEach((input) => {
        const hint = document.createElement('small');
        hint.className = 'admin-field-hint admin-editor-file-selection';
        hint.setAttribute('aria-live', 'polite');
        input.insertAdjacentElement('afterend', hint);

        input.addEventListener('change', () => {
            const files = Array.from(input.files || []);
            hint.textContent = files.length
                ? files.length + ' new photo(s): ' + files.map((file) => file.name).join(', ')
                : '';
        });
    });
})();