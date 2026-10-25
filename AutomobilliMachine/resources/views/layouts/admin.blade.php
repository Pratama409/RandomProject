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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=20261025-quick-notifications">
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
            <span class="admin-confirm-icon"><i class="fa-solid fa-trash-can"></i></span>
            <span class="admin-confirm-eyebrow">CONFIRM ACTION</span>
            <h2 id="adminConfirmTitle" data-confirm-title-output>Delete this vehicle?</h2>
            <p id="adminConfirmMessage" data-confirm-message-output>This action cannot be undone.</p>
            <div class="admin-confirm-item" data-confirm-item-row hidden>
                <i class="fa-solid fa-car-side"></i>
                <strong data-confirm-item-output></strong>
            </div>
            <div class="admin-confirm-actions">
                <button type="button" class="admin-confirm-cancel" data-confirm-cancel>Cancel</button>
                <button type="button" class="admin-confirm-danger" data-confirm-submit>
                    <i class="fa-solid fa-trash-can"></i> Delete vehicle
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

            // Quick notifications: close button and automatic dismissal.
            document.querySelectorAll('[data-admin-toast]').forEach((toast) => {
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
            });

            function dismissToast(toast) {
                if (!toast || toast.classList.contains('is-leaving')) return;
                toast.classList.add('is-leaving');
                toast.addEventListener('animationend', () => toast.remove(), { once: true });
                window.setTimeout(() => toast.remove(), 350);
            }

            // Branded confirmation dialog for destructive forms (instead of window.confirm).
            const dialog = document.querySelector('[data-admin-confirm-dialog]');
            const confirmTitle = dialog?.querySelector('[data-confirm-title-output]');
            const confirmMessage = dialog?.querySelector('[data-confirm-message-output]');
            const itemRow = dialog?.querySelector('[data-confirm-item-row]');
            const itemOutput = dialog?.querySelector('[data-confirm-item-output]');
            const confirmButton = dialog?.querySelector('[data-confirm-submit]');
            let pendingForm = null;
            let pendingSubmitter = null;

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

                if (confirmTitle) confirmTitle.textContent = form.dataset.confirmTitle || 'Are you sure?';
                if (confirmMessage) confirmMessage.textContent = form.dataset.confirmMessage || 'This action cannot be undone.';
                if (itemOutput) itemOutput.textContent = form.dataset.confirmItem || '';
                if (itemRow) itemRow.hidden = !form.dataset.confirmItem;

                if (dialog && typeof dialog.showModal === 'function') {
                    dialog.showModal();
                    confirmButton?.focus();
                } else {
                    // Fallback for browsers without native dialog support.
                    if (window.confirm((form.dataset.confirmTitle || 'Confirm action') + '\\n\\n' + (form.dataset.confirmMessage || 'Continue?'))) {
                        submitConfirmedForm();
                    } else {
                        pendingForm = null;
                        pendingSubmitter = null;
                    }
                }
            });

            function submitConfirmedForm() {
                if (!pendingForm) return;
                const form = pendingForm;
                const submitter = pendingSubmitter;
                pendingForm = null;
                pendingSubmitter = null;

                if (dialog?.open) dialog.close();
                form.dataset.confirmed = 'true';

                if (submitter && submitter.form === form) {
                    form.requestSubmit(submitter);
                } else {
                    form.requestSubmit();
                }
            }

            confirmButton?.addEventListener('click', submitConfirmedForm);
            dialog?.querySelectorAll('[data-confirm-cancel]').forEach((button) => {
                button.addEventListener('click', () => {
                    if (dialog.open) dialog.close();
                    pendingForm = null;
                    pendingSubmitter = null;
                });
            });
            dialog?.addEventListener('click', (event) => {
                if (event.target === dialog) {
                    dialog.close();
                    pendingForm = null;
                    pendingSubmitter = null;
                }
            });
            dialog?.addEventListener('close', () => {
                pendingForm = null;
                pendingSubmitter = null;
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') setSidebarOpen(false);
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>