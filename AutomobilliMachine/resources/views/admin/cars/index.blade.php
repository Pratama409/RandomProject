@extends('layouts.admin')

@section('title', 'Manage Cars — Automobilli Admin')
@section('admin-page-title', 'Car Catalog')


@section('admin-content')

    <section class="admin-page">
        <div class="container admin-shell">
            <div class="admin-page-heading">
                <div>
                    <span class="admin-eyebrow">ADMINISTRATION / CATALOG</span>
                    <h1>Car Catalog</h1>
                    <p>Manage the vehicles that appear throughout AutomobilliMachine.</p>
                </div>
                <a href="{{ route('admin.cars.create') }}" class="btn btn-racing admin-primary-action">
                    <i class="fa-solid fa-plus me-2"></i> Add Car
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success admin-alert" role="status">{{ session('success') }}</div>
            @endif

            <div class="admin-panel">
                <div class="admin-panel-toolbar">
                    <div>
                        <h2>Vehicles</h2>
                        <p>{{ $cars->total() }} record(s) in the catalog</p>
                    </div>
                    <form method="GET" action="{{ route('admin.cars.index') }}" class="admin-search-form">
                        <label class="visually-hidden" for="car-search">Search catalog</label>
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        <input id="car-search" type="search" name="search" value="{{ $search }}"
                            placeholder="Search car, model, or brand...">
                        <button type="submit">Search</button>
                        @if ($search !== '')
                            <a href="{{ route('admin.cars.index') }}" class="admin-clear-search">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Brand / Category</th>
                                <th scope="col">Production</th>
                                <th scope="col">Catalog Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr>
                                    <td>
                                        <div class="admin-vehicle-cell">
                                            @if ($car->image_path)
                                                @php
                                                    $imageUrl = str_starts_with($car->image_path, 'http')
                                                        ? $car->image_path
                                                        : asset($car->image_path);
                                                @endphp
                                                <img src="{{ $imageUrl }}" alt="" loading="lazy">
                                            @else
                                                <div class="admin-vehicle-placeholder"><i class="fa-solid fa-car-side"></i></div>
                                            @endif
                                            <div class="admin-vehicle-copy">
                                                <strong>{{ $car->name }}</strong>
                                                <span>{{ $car->model_family ?: $car->slug }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="admin-table-primary">{{ $car->brand?->name ?? 'Unassigned' }}</span>
                                        <span class="admin-table-secondary">{{ $car->category?->name ?? 'No category' }}</span>
                                    </td>
                                    <td>
                                        <span class="admin-table-primary">{{ $car->production_year_start ?? '—' }}</span>
                                        <span class="admin-table-secondary">{{ $car->production_type ?: 'Unspecified type' }}</span>
                                    </td>
                                    <td>
                                        <div class="admin-status-stack">
                                            <span class="admin-status {{ $car->is_active ? 'is-active' : 'is-inactive' }}">
                                                {{ $car->is_active ? 'Active' : 'Hidden' }}
                                            </span>
                                            @if ($car->is_featured)
                                                <span class="admin-flag"><i class="fa-solid fa-star"></i> Featured</span>
                                            @endif
                                            @if ($car->is_iconic)
                                                <span class="admin-flag"><i class="fa-solid fa-award"></i> Iconic</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="admin-row-actions">
                                            <a href="{{ route('admin.cars.edit', $car) }}" class="admin-icon-action"
                                                aria-label="Edit {{ $car->name }}" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST"
                                                onsubmit="return confirm('Delete {{ addslashes($car->name) }} from the catalog? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-icon-action is-danger"
                                                    aria-label="Delete {{ $car->name }}" title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="admin-empty-state">
                                            <i class="fa-solid fa-car-side"></i>
                                            <strong>No cars found</strong>
                                            <span>{{ $search !== '' ? 'Try another search term.' : 'Add a car to begin managing your catalog.' }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($cars->hasPages())
                    <div class="admin-pagination">
                        {{ $cars->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
