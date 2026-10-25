@extends('layouts.admin')

@section('title', 'Add Car — Automobilli Admin')
@section('admin-page-title', 'Add Car')


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
                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" data-admin-validate data-unsaved-guard data-unsaved-start-dirty="{{ $errors->any() ? 'true' : 'false' }}" novalidate>
                    @csrf
                    @include('admin.cars.form-fields')

                    <div class="admin-form-footer">
                        <a href="{{ route('admin.cars.index') }}" class="btn btn-outline-custom"
                            data-confirm-navigation
                            data-confirm-variant="warning"
                            data-confirm-eyebrow="UNSAVED CHANGES"
                            data-confirm-title="Discard your changes?"
                            data-confirm-message="If you leave this page now, any changes you have made will be lost."
                            data-confirm-confirm-label="Discard changes"
                            data-confirm-icon="triangle-exclamation">Cancel</a>
                        <button type="submit" class="btn btn-racing">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Create Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
