<section class="car-detail-hero" id="hero">
    <div class="car-detail-hero-media">
        @if ($vehicle->image_path)
            <img id="carHeroImage"
                src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                alt="{{ $vehicle->name }}"
                class="js-lightbox-trigger"
                data-lightbox-src="{{ str_starts_with($vehicle->image_path, 'http') ? $vehicle->image_path : asset($vehicle->image_path) }}"
                data-lightbox-caption="{{ $vehicle->name }}">
        @endif
    </div>
    <div class="car-detail-hero-overlay"></div>

    <div class="container car-detail-hero-content">
        <div class="car-detail-hero-copy">@if ($brand->logo_path)
                <img class="car-detail-brand-logo"
                    src="{{ str_starts_with($brand->logo_path, 'http') ? $brand->logo_path : asset($brand->logo_path) }}"
                    alt="{{ $brand->name }} logo">
            @endif

            <div class="car-detail-brandline">
                {{ $brand->name }} <span>·</span> {{ $vehicle->category?->name ?? 'Model' }}
            </div>

            <h1>
                <span>{{ $familyLabel }}</span>
                @if ($variantLabel !== '')
                    <strong>{{ $variantLabel }}</strong>
                @endif
            </h1>

            <div class="car-detail-kicker">
                {{ strtoupper($vehicle->production_type ?? 'PRODUCTION') }}
                <span>·</span>
                {{ strtoupper($vehicle->vehicle_type ?? 'ROAD CAR') }}
            </div>

            <div class="car-detail-badges">
                @foreach (collect([$vehicle->production_type, $vehicle->vehicle_type, $vehicle->fuel_type, $vehicle->drivetrain])->filter() as $badge)
                    <span>{{ $badge }}</span>
                @endforeach
            </div>

            <p class="car-detail-hero-description">
                {{ $vehicle->short_description ?? $vehicle->description ?? 'Detailed information for this model is being added to the catalog.' }}
            </p>
        </div>

        @if ($gallery->isNotEmpty())
            <div class="car-detail-hero-gallery" aria-label="Vehicle images">
                @foreach ($gallery->take(5) as $index => $image)
                    @php $imageUrl = str_starts_with($image, 'http') ? $image : asset($image); @endphp
                    <button type="button"
                        class="car-detail-hero-thumb js-hero-image-trigger {{ $index === 0 ? 'is-active' : '' }}"
                        data-image-url="{{ $imageUrl }}"
                        data-lightbox-src="{{ $imageUrl }}"
                        data-lightbox-caption="{{ $vehicle->name }} image {{ $index + 1 }}">
                        <img src="{{ $imageUrl }}" alt="{{ $vehicle->name }} image {{ $index + 1 }}">
                    </button>
                @endforeach
                @if ($gallery->count() > 5)
                    <button type="button" class="car-detail-hero-more js-lightbox-trigger"
                        data-lightbox-src="{{ str_starts_with($gallery->get(5), 'http') ? $gallery->get(5) : asset($gallery->get(5)) }}"
                        data-lightbox-caption="{{ $vehicle->name }} gallery">
                        +{{ $gallery->count() - 5 }}
                    </button>
                @endif
            </div>
        @endif
    </div>
</section>