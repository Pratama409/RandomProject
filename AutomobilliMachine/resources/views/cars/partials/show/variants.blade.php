@if (!empty($vehicle->variants))
<section class="car-detail-section car-detail-variants" id="variants">
    <div class="container">
        <div class="car-detail-section-heading"><div><span class="car-detail-label">VARIANTS</span><h2>Versions & related derivatives</h2></div></div>
        <div class="car-detail-variant-grid">
            @foreach ($vehicle->variants as $variant)
                <article class="car-detail-variant-card">
                    <span>{{ $variant['type'] ?? 'Variant' }}</span>
                    <h3>{{ $variant['name'] ?? 'Unnamed variant' }}</h3>
                    @if (!empty($variant['years']))<small>{{ $variant['years'] }}</small>@endif
                    @if (!empty($variant['description']))<p>{{ $variant['description'] }}</p>@endif
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif