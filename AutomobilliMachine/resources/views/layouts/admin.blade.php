<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Workspace — Automobilli')</title>

    <link rel="icon" type="image/jpg/png" href="{{ asset('image/Favicon/Favicon.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=20261025-nav-guard-toast">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-app" data-admin-app>
        @include('admin.partials.sidebar')

        <button class="admin-sidebar-backdrop" type="button" data-admin-sidebar-close aria-label="Close navigation"></button>

        <div class="admin-main-shell">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button class="admin-mobile-toggle" type="button" data-admin-sidebar-toggle aria-controls="adminSidebar" aria-expanded="false" aria-label="Open navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="admin-breadcrumb">
                        <span>WORKSPACE</span>
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        <strong>@yield('admin-page-title', 'Dashboard')</strong>
                    </div>
                </div>

                <div class="admin-topbar-right">
                    <a class="admin-topbar-website" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span>View website</span>
                    </a>
                    <span class="admin-topbar-divider" aria-hidden="true"></span>
                    <div class="admin-topbar-user">
                        <span class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                        <span class="admin-topbar-user-copy">
                            <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                            <small>Administrator</small>
                        </span>
                    </div>
                </div>
            </header>

            <main class="admin-main-content">
                @yield('admin-content')
            </main>
        </div>
    </div>

    <div class="admin-toast-region" data-admin-toast-region aria-live="polite" aria-atomic="false">
        @if (session('success'))
            <section class="admin-toast is-success" data-admin-toast data-duration="5800" role="status">
                <span class="admin-toast-icon"><i class="fa-solid fa-check"></i></span>
                <div class="admin-toast-copy">
                    <strong>Changes saved</strong>
                    <p>{{ session('success') }}</p>
                </div>
                <button type="button" class="admin-toast-close" data-admin-toast-close aria-label="Dismiss notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="admin-toast-progress"><span style="--toast-duration: 5800ms"></span></span>
            </section>
        @endif

        @if (session('error'))
            <section class="admin-toast is-error" data-admin-toast data-duration="8000" role="alert">
                <span class="admin-toast-icon"><i class="fa-solid fa-xmark"></i></span>
                <div class="admin-toast-copy">
                    <strong>Something went wrong</strong>
                    <p>{{ session('error') }}</p>
                </div>
                <button type="button" class="admin-toast-close" data-admin-toast-close aria-label="Dismiss notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="admin-toast-progress"><span style="--toast-duration: 8000ms"></span></span>
            </section>
        @endif

        @if (session('warning'))
            <section class="admin-toast is-warning" data-admin-toast data-duration="7000" role="status">
                <span class="admin-toast-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <div class="admin-toast-copy">
                    <strong>Please note</strong>
                    <p>{{ session('warning') }}</p>
                </div>
                <button type="button" class="admin-toast-close" data-admin-toast-close aria-label="Dismiss notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="admin-toast-progress"><span style="--toast-duration: 7000ms"></span></span>
            </section>
        @endif

        @if (session('info'))
            <section class="admin-toast is-info" data-admin-toast data-duration="6500" role="status">
                <span class="admin-toast-icon"><i class="fa-solid fa-circle-info"></i></span>
                <div class="admin-toast-copy">
                    <strong>Information</strong>
                    <p>{{ session('info') }}</p>
                </div>
                <button type="button" class="admin-toast-close" data-admin-toast-close aria-label="Dismiss notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="admin-toast-progress"><span style="--toast-duration: 6500ms"></span></span>
            </section>
        @endif

        @if ($errors->any())
            <section class="admin-toast is-error is-validation" data-admin-toast data-duration="9500" role="alert">
                <span class="admin-toast-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <div class="admin-toast-copy">
                    <strong>Please check the form</strong>
                    <p>Some information needs your attention:</p>
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="admin-toast-close" data-admin-toast-close aria-label="Dismiss notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="admin-toast-progress"><span style="--toast-duration: 9500ms"></span></span>
            </section>
        @endif
    </div>

    <dialog class="admin-confirm-dialog" data-admin-confirm-dialog aria-labelledby="adminConfirmTitle" aria-describedby="adminConfirmMessage">
        <div class="admin-confirm-card">
            <span class="admin-confirm-icon" data-confirm-icon><i class="fa-solid fa-trash-can"></i></span>
            <span class="admin-confirm-eyebrow" data-confirm-eyebrow-output>CONFIRM ACTION</span>
            <h2 id="adminConfirmTitle" data-confirm-title-output>Delete this vehicle?</h2>
            <p id="adminConfirmMessage" data-confirm-message-output>This action cannot be undone.</p>
            <div class="admin-confirm-item" data-confirm-item-row hidden>
                <i class="fa-solid fa-car-side"></i>
                <strong data-confirm-item-output></strong>
            </div>
            <div class="admin-confirm-actions">
                <button type="button" class="admin-confirm-cancel" data-confirm-cancel><span data-confirm-cancel-label>Cancel</span></button>
                <button type="button" class="admin-confirm-danger" data-confirm-submit>
                    <i class="fa-solid fa-trash-can" data-confirm-button-icon></i>
                    <span data-confirm-button-label>Delete vehicle</span>
                </button>
            </div>
        </div>
    </dialog>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const app = document.querySelector('[data-admin-app]');
            if (!app) return;

            // Responsive admin sidebar.
            const toggle = app.querySelector('[data-admin-sidebar-toggle]');
            const closeButtons = app.querySelectorAll('[data-admin-sidebar-close]');

            const setSidebarOpen = (open) => {
                app.classList.toggle('is-sidebar-open', open);
                if (toggle) toggle.setAttribute('aria-expanded', String(open));
            };

            if (toggle) {
                toggle.addEventListener('click', () => {
                    setSidebarOpen(!app.classList.contains('is-sidebar-open'));
                });
            }

            closeButtons.forEach((button) => {
                button.addEventListener('click', () => setSidebarOpen(false));
            });

            // Quick notifications: close button, auto-dismiss, and pause while hovered.
            function initializeToast(toast) {
                const duration = Number(toast.dataset.duration || 6000);
                const progress = toast.querySelector('.admin-toast-progress > span');
                if (progress) progress.style.setProperty('--toast-duration', duration + 'ms');

                let remaining = duration;
                let startedAt = performance.now();
                let timer = window.setTimeout(() => dismissToast(toast), remaining);

                const pauseTimer = () => {
                    if (timer === null || toast.classList.contains('is-leaving')) return;
                    window.clearTimeout(timer);
                    timer = null;
                    remaining = Math.max(0, remaining - (performance.now() - startedAt));
                };

                const resumeTimer = () => {
                    if (timer !== null || toast.classList.contains('is-leaving')) return;
                    startedAt = performance.now();
                    timer = window.setTimeout(() => dismissToast(toast), remaining);
                };

                toast.addEventListener('mouseenter', pauseTimer);
                toast.addEventListener('mouseleave', resumeTimer);

                const closeButton = toast.querySelector('[data-admin-toast-close]');
                if (closeButton) closeButton.addEventListener('click', () => dismissToast(toast));
            }

            document.querySelectorAll('[data-admin-toast]').forEach(initializeToast);

            function dismissToast(toast) {
                if (!toast || toast.classList.contains('is-leaving')) return;
                toast.classList.add('is-leaving');
                toast.addEventListener('animationend', () => toast.remove(), { once: true });
                window.setTimeout(() => toast.remove(), 350);
            }

            function showRequiredFieldsToast(form, missingFields) {
                const region = document.querySelector('[data-admin-toast-region]');
                if (!region) return;

                const toast = document.createElement('section');
                toast.className = 'admin-toast is-error is-validation';
                toast.dataset.duration = '9500';
                toast.setAttribute('role', 'alert');

                const icon = document.createElement('span');
                icon.className = 'admin-toast-icon';
                icon.innerHTML = '<i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>';

                const copy = document.createElement('div');
                copy.className = 'admin-toast-copy';

                const heading = document.createElement('strong');
                heading.textContent = 'Required fields missing';

                const description = document.createElement('p');
                description.textContent = 'Complete these fields before saving:';

                const list = document.createElement('ul');
                const labels = Array.from(form.querySelectorAll('label[for]'));

                missingFields.forEach((field) => {
                    const label = labels.find((candidate) => candidate.htmlFor === field.id);
                    const item = document.createElement('li');
                    item.textContent = label
                        ? label.textContent.replace(/\s*\*\s*/g, ' ').trim()
                        : (field.name || 'Required field');
                    list.appendChild(item);
                });

                copy.append(heading, description, list);

                const close = document.createElement('button');
                close.type = 'button';
                close.className = 'admin-toast-close';
                close.setAttribute('aria-label', 'Dismiss notification');
                close.innerHTML = '<i class="fa-solid fa-xmark" aria-hidden="true"></i>';

                const progress = document.createElement('span');
                progress.className = 'admin-toast-progress';
                progress.innerHTML = '<span></span>';

                toast.append(icon, copy, close, progress);
                region.appendChild(toast);
                initializeToast(toast);
            }

            // Replace native browser required-field popups with the branded quick toast.
            app.addEventListener('submit', (event) => {
                const form = event.target.closest('form[data-admin-validate]');
                if (!form) return;

                const requiredFields = Array.from(form.querySelectorAll('[required]'));
                const missingFields = requiredFields.filter((field) => {
                    if (field.disabled) return false;
                    if (field.type === 'checkbox') return !field.checked;
                    if (field.type === 'file') return !field.files || field.files.length === 0;
                    return !String(field.value ?? '').trim();
                });

                if (missingFields.length === 0) return;

                event.preventDefault();

                missingFields.forEach((field) => field.classList.add('is-invalid'));
                showRequiredFieldsToast(form, missingFields);

                const firstInvalid = missingFields[0];
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus({ preventScroll: true });
            });

            // Clear client-side required highlights when the field is corrected.
            const clearFieldError = (event) => {
                const field = event.target;
                if (!field.matches('input, select, textarea')) return;
                const form = field.closest('form[data-admin-validate]');
                if (!form || !field.classList.contains('is-invalid')) return;

                const value = String(field.value ?? '').trim();
                if (value && field.checkValidity()) field.classList.remove('is-invalid');
            };

            app.addEventListener('input', clearFieldError);
            app.addEventListener('change', clearFieldError);

            // Branded confirmation dialog for destructive actions and leaving dirty forms.
            const dialog = document.querySelector('[data-admin-confirm-dialog]');
            const confirmTitle = dialog?.querySelector('[data-confirm-title-output]');
            const confirmMessage = dialog?.querySelector('[data-confirm-message-output]');
            const itemRow = dialog?.querySelector('[data-confirm-item-row]');
            const itemOutput = dialog?.querySelector('[data-confirm-item-output]');
            const confirmButton = dialog?.querySelector('[data-confirm-submit]');
            const confirmIcon = dialog?.querySelector('[data-confirm-icon] i');
            const confirmEyebrow = dialog?.querySelector('[data-confirm-eyebrow-output]');
            const confirmButtonIcon = dialog?.querySelector('[data-confirm-button-icon]');
            const confirmButtonLabel = dialog?.querySelector('[data-confirm-button-label]');
            const confirmCancelLabel = dialog?.querySelector('[data-confirm-cancel-label]');

            let pendingForm = null;
            let pendingSubmitter = null;
            let pendingHref = null;
            let pendingType = null;
            let allowUnload = false;

            // Capture the initial values so opening Edit Car alone is not treated as a change.
            const guardedForms = Array.from(app.querySelectorAll('form[data-unsaved-guard]'));
            const initialFormStates = new WeakMap();

            function getFormState(form) {
                return JSON.stringify(Array.from(form.querySelectorAll('input, select, textarea'))
                    .filter((field) => {
                        if (!field.name || field.disabled) return false;
                        if (field.tagName === 'INPUT' && ['hidden', 'submit', 'button', 'reset', 'image'].includes(field.type)) return false;
                        return true;
                    })
                    .map((field) => {
                        const type = (field.type || '').toLowerCase();

                        if (type === 'file') {
                            return [field.name, type, Array.from(field.files || []).map((file) => [
                                file.name, file.size, file.lastModified, file.type
                            ])];
                        }

                        if (type === 'checkbox' || type === 'radio') {
                            return [field.name, type, field.value, field.checked];
                        }

                        if (field.tagName === 'SELECT' && field.multiple) {
                            return [field.name, Array.from(field.selectedOptions).map((option) => option.value)];
                        }

                        return [field.name, type, field.value];
                    }));
            }

            guardedForms.forEach((form) => {
                initialFormStates.set(form, getFormState(form));
            });

            function getDirtyGuardedForm() {
                return guardedForms.find((form) => {
                    if (form.dataset.unsavedStartDirty === 'true') return true;
                    return getFormState(form) !== initialFormStates.get(form);
                }) || null;
            }

            function configureConfirmation(source, mode = 'action') {
                const isNavigation = mode === 'navigation';
                if (confirmTitle) {
                    confirmTitle.textContent = source.dataset.confirmTitle ||
                        (isNavigation ? 'Leave without saving?' : 'Are you sure?');
                }
                if (confirmMessage) {
                    confirmMessage.textContent = source.dataset.confirmMessage ||
                        (isNavigation
                            ? 'You have unsaved changes. If you continue, your changes will be lost.'
                            : 'This action cannot be undone.');
                }
                if (itemOutput) itemOutput.textContent = source.dataset.confirmItem || '';
                if (itemRow) itemRow.hidden = !source.dataset.confirmItem;

                const variant = source.dataset.confirmVariant || (isNavigation ? 'warning' : 'danger');
                const iconName = source.dataset.confirmIcon || (isNavigation ? 'triangle-exclamation' : 'trash-can');
                const buttonLabel = source.dataset.confirmConfirmLabel ||
                    (isNavigation ? 'Discard changes & leave' : 'Delete vehicle');
                const cancelLabel = source.dataset.confirmCancelLabel ||
                    (isNavigation ? 'Stay and continue editing' : 'Cancel');
                const eyebrow = source.dataset.confirmEyebrow || (isNavigation ? 'UNSAVED CHANGES' : 'CONFIRM ACTION');

                dialog?.classList.toggle('is-warning', variant === 'warning');
                confirmButton?.classList.toggle('is-warning-action', variant === 'warning');
                if (confirmEyebrow) confirmEyebrow.textContent = eyebrow;
                if (confirmIcon) confirmIcon.className = 'fa-solid fa-' + iconName;
                if (confirmButtonIcon) confirmButtonIcon.className = 'fa-solid fa-' + iconName;
                if (confirmButtonLabel) confirmButtonLabel.textContent = buttonLabel;
                if (confirmCancelLabel) confirmCancelLabel.textContent = cancelLabel;
            }

            function openConfirmation(source, mode = 'action') {
                configureConfirmation(source, mode);

                if (dialog && typeof dialog.showModal === 'function') {
                    dialog.showModal();
                    confirmButton?.focus();
                    return true;
                }

                return false;
            }

            function clearPendingConfirmation() {
                pendingForm = null;
                pendingSubmitter = null;
                pendingHref = null;
                pendingType = null;
            }

            // Keep the existing branded confirmation for destructive forms.
            app.addEventListener('submit', (event) => {
                const form = event.target.closest('form[data-confirm-submit]');
                if (!form) return;

                if (form.dataset.confirmed === 'true') {
                    delete form.dataset.confirmed;
                    return;
                }

                event.preventDefault();
                pendingForm = form;
                pendingSubmitter = event.submitter || form.querySelector('button[type="submit"]');
                pendingHref = null;
                pendingType = 'action';

                if (!openConfirmation(form, 'action')) {
                    if (window.confirm((form.dataset.confirmTitle || 'Confirm action') + '\\n\\n' + (form.dataset.confirmMessage || 'Continue?'))) {
                        submitConfirmedAction();
                    } else {
                        clearPendingConfirmation();
                    }
                }
            });

            function getActiveGuardedForm() {
                return guardedForms.find((form) => form.isConnected) || null;
            }

            // Show a small, themed notification when navigation is blocked by an open form.
            function showTransientToast(titleText, messageText, variant = 'warning', iconName = 'triangle-exclamation', duration = 6500) {
                const region = document.querySelector('[data-admin-toast-region]');
                if (!region) return;

                const toast = document.createElement('section');
                toast.className = 'admin-toast is-' + variant;
                toast.dataset.duration = String(duration);
                toast.setAttribute('role', variant === 'error' ? 'alert' : 'status');

                const icon = document.createElement('span');
                icon.className = 'admin-toast-icon';
                icon.innerHTML = '<i class="fa-solid fa-' + iconName + '" aria-hidden="true"></i>';

                const copy = document.createElement('div');
                copy.className = 'admin-toast-copy';

                const heading = document.createElement('strong');
                heading.textContent = titleText;

                const message = document.createElement('p');
                message.textContent = messageText;
                copy.append(heading, message);

                const close = document.createElement('button');
                close.type = 'button';
                close.className = 'admin-toast-close';
                close.setAttribute('aria-label', 'Dismiss notification');
                close.innerHTML = '<i class="fa-solid fa-xmark" aria-hidden="true"></i>';

                const progress = document.createElement('span');
                progress.className = 'admin-toast-progress';
                progress.innerHTML = '<span></span>';

                toast.append(icon, copy, close, progress);
                region.appendChild(toast);
                initializeToast(toast);
            }

            // Keep the user on Add/Edit while a form is open. Clean forms are blocked
            // with a small info toast; dirty forms require explicit discard confirmation.
            app.addEventListener('click', (event) => {
                const link = event.target instanceof Element ? event.target.closest('a[href]') : null;
                if (!link || event.defaultPrevented || event.button !== 0 ||
                    event.metaKey || event.ctrlKey || event.shiftKey || event.altKey ||
                    link.hasAttribute('download') ||
                    (link.target && link.target.toLowerCase() !== '_self')) {
                    return;
                }

                const activeForm = getActiveGuardedForm();
                if (!activeForm) return;

                const dirtyForm = getDirtyGuardedForm();

                // The explicit Cancel link is the intended exit. It leaves directly when
                // pristine and triggers the discard-warning dialog after edits.
                if (!dirtyForm && link.hasAttribute('data-confirm-navigation')) return;

                let target;
                try {
                    target = new URL(link.href, window.location.href);
                } catch {
                    return;
                }

                if (target.origin !== window.location.origin) return;

                const samePathAndQuery =
                    target.pathname === window.location.pathname &&
                    target.search === window.location.search;

                if (target.href === window.location.href ||
                    (samePathAndQuery && target.hash && target.hash !== window.location.hash)) {
                    return;
                }

                event.preventDefault();

                if (!dirtyForm) {
                    showTransientToast(
                        'Form in progress',
                        'You are currently editing a vehicle. Use Cancel to leave this form or save your changes first.',
                        'warning',
                        'lock',
                        6000
                    );
                    return;
                }

                pendingForm = null;
                pendingSubmitter = null;
                pendingHref = target.href;
                pendingType = 'navigation';

                if (!openConfirmation(link, 'navigation')) {
                    if (window.confirm(
                        (link.dataset.confirmTitle || 'Discard your changes?') + '\\n\\n' +
                        (link.dataset.confirmMessage || 'You have unsaved changes. If you continue, your changes will be lost.')
                    )) {
                        submitConfirmedAction();
                    } else {
                        clearPendingConfirmation();
                    }
                }
            });

            // Also guard form submissions that leave the page (for example Sign out in the sidebar).
            app.addEventListener('submit', (event) => {
                if (event.defaultPrevented) return;

                const submittedForm = event.target;
                if (!(submittedForm instanceof HTMLFormElement)) return;

                if (submittedForm.dataset.allowDirtyNavigation === 'true') {
                    delete submittedForm.dataset.allowDirtyNavigation;
                    return;
                }

                const activeForm = getActiveGuardedForm();
                if (!activeForm || submittedForm === activeForm) {
                    // Saving the currently edited form is intentional.
                    if (submittedForm === activeForm) allowUnload = true;
                    return;
                }

                const dirtyForm = getDirtyGuardedForm();
                if (!dirtyForm) {
                    event.preventDefault();
                    showTransientToast(
                        'Form in progress',
                        'Finish or cancel the current vehicle form before using this action.',
                        'warning',
                        'lock',
                        6000
                    );
                    return;
                }

                event.preventDefault();
                pendingForm = submittedForm;
                pendingSubmitter = event.submitter || submittedForm.querySelector('button[type="submit"]');
                pendingHref = null;
                pendingType = 'external-submit';

                if (!openConfirmation(submittedForm, 'navigation')) {
                    if (window.confirm('Leave without saving?\\n\\nYour changes will be lost.')) {
                        submitConfirmedAction();
                    } else {
                        clearPendingConfirmation();
                    }
                }
            });

            function submitConfirmedAction() {
                if (pendingType === 'navigation' && pendingHref) {
                    navigateToPendingHref();
                    return;
                }

                if (!pendingForm) return;

                const form = pendingForm;
                const submitter = pendingSubmitter;
                const actionType = pendingType;
                clearPendingConfirmation();

                if (dialog?.open) {
                    dialog.dataset.confirming = 'true';
                    dialog.close();
                }

                if (actionType === 'external-submit') {
                    form.dataset.allowDirtyNavigation = 'true';
                    allowUnload = true;
                } else {
                    form.dataset.confirmed = 'true';
                }

                if (submitter && submitter.form === form) {
                    form.requestSubmit(submitter);
                } else {
                    form.requestSubmit();
                }
            }

            function navigateToPendingHref() {
                const href = pendingHref;
                clearPendingConfirmation();
                allowUnload = true;

                if (dialog?.open) {
                    dialog.dataset.confirming = 'true';
                    dialog.close();
                }

                if (href) window.location.assign(href);
            }

            confirmButton?.addEventListener('click', submitConfirmedAction);
            dialog?.querySelectorAll('[data-confirm-cancel]').forEach((button) => {
                button.addEventListener('click', () => {
                    if (dialog.open) dialog.close();
                    clearPendingConfirmation();
                });
            });
            dialog?.addEventListener('click', (event) => {
                if (event.target === dialog) {
                    dialog.close();
                    clearPendingConfirmation();
                }
            });
            dialog?.addEventListener('close', () => {
                if (dialog.dataset.confirming !== 'true') clearPendingConfirmation();
                delete dialog.dataset.confirming;
            });

            // Browser back/refresh/close: ask only when a form is dirty.
            window.addEventListener('beforeunload', (event) => {
                if (allowUnload || !getDirtyGuardedForm()) return;
                event.preventDefault();
                event.returnValue = '';
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') setSidebarOpen(false);
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>