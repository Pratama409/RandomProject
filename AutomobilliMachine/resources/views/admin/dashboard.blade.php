@extends('layouts.admin')

@section('title', 'Dashboard — Automobilli Admin')
@section('admin-page-title', 'Dashboard')

@section('admin-content')
    <section class="admin-dashboard">
        <div class="admin-page-heading admin-dashboard-heading">
            <div>
                <span class="admin-eyebrow"><i class="fa-solid fa-circle-nodes me-2"></i>OVERVIEW / AUTOMOBILLI</span>
                <h1>Welcome back, {{ auth()->user()->name }}.</h1>
                <p>Here is what is happening across your automotive catalog.</p>
            </div>
            <a href="{{ route('admin.cars.create') }}" class="btn btn-racing admin-primary-action">
                <i class="fa-solid fa-plus me-2"></i> Add a vehicle
            </a>
        </div>

        <div class="admin-stats-grid">
            <article class="admin-stat-card">
                <div class="admin-stat-topline">
                    <span class="admin-stat-icon is-red"><i class="fa-solid fa-car-side"></i></span>
                    <span class="admin-stat-trend">CATALOG</span>
                </div>
                <span class="admin-stat-label">Total vehicles</span>
                <strong class="admin-stat-value">{{ number_format($totalCars) }}</strong>
                <span class="admin-stat-footnote">All vehicle records in the database</span>
            </article>

            <article class="admin-stat-card">
                <div class="admin-stat-topline">
                    <span class="admin-stat-icon is-green"><i class="fa-solid fa-eye"></i></span>
                    <span class="admin-stat-trend">PUBLIC</span>
                </div>
                <span class="admin-stat-label">Published vehicles</span>
                <strong class="admin-stat-value">{{ number_format($activeCars) }}</strong>
                <span class="admin-stat-footnote">{{ number_format($hiddenCars) }} hidden from the public catalog</span>
            </article>

            <article class="admin-stat-card">
                <div class="admin-stat-topline">
                    <span class="admin-stat-icon is-amber"><i class="fa-solid fa-star"></i></span>
                    <span class="admin-stat-trend">HIGHLIGHTS</span>
                </div>
                <span class="admin-stat-label">Featured vehicles</span>
                <strong class="admin-stat-value">{{ number_format($featuredCars) }}</strong>
                <span class="admin-stat-footnote">Marked as featured in the catalog</span>
            </article>

            <article class="admin-stat-card">
                <div class="admin-stat-topline">
                    <span class="admin-stat-icon is-blue"><i class="fa-solid fa-copyright"></i></span>
                    <span class="admin-stat-trend">BRANDS</span>
                </div>
                <span class="admin-stat-label">Brands recorded</span>
                <strong class="admin-stat-value">{{ number_format($brandsCount) }}</strong>
                <span class="admin-stat-footnote">{{ number_format($categoriesCount) }} vehicle categories available</span>
            </article>
        </div>

        <div class="admin-dashboard-grid">
            <section class="admin-panel admin-recent-panel">
                <div class="admin-panel-toolbar">
                    <div>
                        <span class="admin-section-kicker">LATEST ACTIVITY</span>
                        <h2>Recently updated vehicles</h2>
                        <p>Review the most recently changed catalog records.</p>
                    </div>
                    <a href="{{ route('admin.cars.index') }}" class="admin-text-link">View catalog <i class="fa-solid fa-arrow-right ms-1"></i></a>
                </div>

                <div class="admin-recent-list">
                    @forelse ($recentCars as $car)
                        <div class="admin-recent-item">
                            <div class="admin-recent-vehicle">
                                @if ($car->image_path)
                                    @php
                                        $imageUrl = str_starts_with($car->image_path, 'http')
                                            ? $car->image_path
                                            : asset($car->image_path);
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="" loading="lazy">
                                @else
                                    <span class="admin-recent-placeholder"><i class="fa-solid fa-car-side"></i></span>
                                @endif
                            </div>
                            <div class="admin-recent-copy">
                                <strong>{{ $car->name }}</strong>
                                <span>{{ $car->brand?->name ?? 'Unassigned brand' }} <span class="admin-recent-dot">·</span> {{ $car->production_year_start ?? 'Year not set' }}</span>
                            </div>
                            <span class="admin-status {{ $car->is_active ? 'is-active' : 'is-inactive' }}">{{ $car->is_active ? 'Published' : 'Hidden' }}</span>
                            <a href="{{ route('admin.cars.edit', $car) }}" class="admin-icon-action" aria-label="Edit {{ $car->name }}" title="Edit vehicle">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    @empty
                        <div class="admin-empty-state">
                            <i class="fa-solid fa-car-side"></i>
                            <strong>Your catalog is ready for its first vehicle</strong>
                            <span>Add a vehicle to begin building the catalog.</span>
                            <a href="{{ route('admin.cars.create') }}" class="btn btn-racing mt-2">Add first vehicle</a>
                        </div>
                    @endforelse
                </div>
            </section>

            <aside class="admin-dashboard-side">
                <section class="admin-panel admin-quick-panel">
                    <div class="admin-side-panel-heading">
                        <span class="admin-section-kicker">SHORTCUTS</span>
                        <h2>Quick actions</h2>
                    </div>
                    <a href="{{ route('admin.cars.create') }}" class="admin-quick-action">
                        <span class="admin-quick-action-icon is-red"><i class="fa-solid fa-plus"></i></span>
                        <span><strong>Add a vehicle</strong><small>Create a catalog record</small></span>
                        <i class="fa-solid fa-chevron-right admin-quick-arrow"></i>
                    </a>
                    <a href="{{ route('admin.cars.index') }}" class="admin-quick-action">
                        <span class="admin-quick-action-icon"><i class="fa-solid fa-list"></i></span>
                        <span><strong>Manage catalog</strong><small>Search, edit, or remove cars</small></span>
                        <i class="fa-solid fa-chevron-right admin-quick-arrow"></i>
                    </a>
                    <a href="{{ route('home') }}" class="admin-quick-action" target="_blank" rel="noopener noreferrer">
                        <span class="admin-quick-action-icon"><i class="fa-solid fa-globe"></i></span>
                        <span><strong>Open public website</strong><small>Preview the user experience</small></span>
                        <i class="fa-solid fa-arrow-up-right-from-square admin-quick-arrow"></i>
                    </a>
                </section>

                <section class="admin-panel admin-catalog-health">
                    <div class="admin-side-panel-heading">
                        <span class="admin-section-kicker">CATALOG SNAPSHOT</span>
                        <h2>Publication status</h2>
                    </div>
                    <div class="admin-health-row">
                        <span><i class="fa-solid fa-circle admin-health-dot is-green"></i> Published</span>
                        <strong>{{ number_format($activeCars) }}</strong>
                    </div>
                    <div class="admin-health-track"><span class="is-green" style="width: {{ $totalCars > 0 ? round(($activeCars / $totalCars) * 100, 1) : 0 }}%"></span></div>
                    <div class="admin-health-row">
                        <span><i class="fa-solid fa-circle admin-health-dot is-muted"></i> Hidden</span>
                        <strong>{{ number_format($hiddenCars) }}</strong>
                    </div>
                    <div class="admin-health-track"><span class="is-muted" style="width: {{ $totalCars > 0 ? round(($hiddenCars / $totalCars) * 100, 1) : 0 }}%"></span></div>
                    <p class="admin-health-note">These figures reflect the current records in your database.</p>
                </section>
            </aside>
        </div>

        <footer class="admin-content-footer">
            <span>Automobilli Admin Workspace</span>
            <span>Catalog data is loaded from your Laravel database.</span>
        </footer>
    </section>
@endsection