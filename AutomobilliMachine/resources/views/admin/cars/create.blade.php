@extends('layouts.admin')

@section('title', 'Add Car — Automobilli Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=20261022-1">
@endpush

@section('admin-content')

    <section class="admin-page">
        <div class="container admin-shell admin-form-shell">
            <a href="{{ route('admin.cars.index') }}" class="admin-back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to car catalog
            </a>

            <div class="admin-page-heading">
                <div>
                    <span class="admin-eyebrow">ADMINISTRATION / CATALOG</span>
                    <h1>Add a Car</h1>
                    <p>Create a catalog record. The brand, slug, and specifications are validated on the server.</p>
                </div>
            </div>

            <div class="admin-panel admin-form-panel">
                <form action="{{ route('admin.cars.store') }}" method="POST">
                    @csrf
                    @include('admin.cars.form-fields')

                    <div class="admin-form-footer">
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-custom">Cancel</a>
                        <button type="submit" class="btn btn-racing">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Create Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
