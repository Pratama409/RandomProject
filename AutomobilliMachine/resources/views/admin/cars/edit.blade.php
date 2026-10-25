@extends('layouts.admin')

@section('title', 'Edit ' . $car->name . ' — Automobilli Admin')
@section('admin-page-title', 'Edit Car')


@section('admin-content')

    <section class="admin-page">
        <div class="container admin-shell admin-form-shell">
            <a href="{{ route('admin.cars.index') }}" class="admin-back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to car catalog
            </a>

            <div class="admin-page-heading">
                <div>
                    <span class="admin-eyebrow">ADMINISTRATION / CATALOG</span>
                    <h1>Edit Car</h1>
                    <p>Update the catalog record for <strong>{{ $car->name }}</strong>.</p>
                </div>
            </div>

            <div class="admin-panel admin-form-panel">
                <form action="{{ route('admin.cars.update', $car) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.cars.form-fields')

                    <div class="admin-form-footer">
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-custom">Cancel</a>
                        <button type="submit" class="btn btn-racing">
                            <i class="fa-solid fa-check me-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
