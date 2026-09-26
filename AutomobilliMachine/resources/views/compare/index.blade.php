@extends('layouts.app')

@section('title', 'Compare Cars - AutomobilliMachine')

@push('styles')
<style>
    .compare-page {
        min-height: 72vh;
        padding: 110px 0;
        background: #090b0f;
        color: #f5f7fa;
    }

    .compare-card {
        max-width: 900px;
        margin: 0 auto;
        padding: 56px;
        border: 1px solid #2a303a;
        border-radius: 24px;
        background: linear-gradient(145deg, #141820, #0c0e13);
        text-align: center;
    }

    .compare-card h1 {
        font-weight: 800;
        margin-bottom: 14px;
    }

    .compare-card p {
        color: #aab2be;
        line-height: 1.8;
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<section class="compare-page">
    <div class="container">
        <div class="compare-card">
            <span class="text-danger fw-bold text-uppercase small">Head-to-Head</span>
            <h1>Car Comparison</h1>
            <p>
                The comparison feature will use selected car IDs and request only the
                specification data needed for the comparison table.
            </p>
        </div>
    </div>
</section>
@endsection
