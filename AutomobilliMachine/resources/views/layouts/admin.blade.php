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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=20261025-sidebar-dashboard">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const app = document.querySelector('[data-admin-app]');
            if (!app) return;

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

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') setSidebarOpen(false);
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>