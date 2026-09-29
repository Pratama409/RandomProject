<section class="car-detail-section car-detail-compare" id="compare">
    <div class="container">
        <div class="car-detail-section-heading"><div><span class="car-detail-label">COMPARE</span><h2>Similar models</h2><p>Explore other {{ $brand->name }} models in the current catalog.</p></div></div>
        <div class="car-detail-compare-grid">
            @foreach ($comparisonCars as $compareCar)
                <a class="car-detail-compare-card {{ $compareCar->id === $vehicle->id ? 'is-current' : '' }}"
                    href="{{ route('cars.show', ['brand' => $brand->slug, 'car' => $compareCar->slug]) }}">
                    <div class="car-detail-compare-media">
                        @if ($compareCar->image_path)<img src="{{ str_starts_with($compareCar->image_path, 'http') ? $compareCar->image_path : asset($compareCar->image_path) }}" alt="{{ $compareCar->name }}" loading="lazy">@endif
                    </div>
                    <div class="car-detail-compare-body">
                        <h3>{{ $compareCar->name }}</h3>
                        <div>
                            <span>{{ $compareCar->horsepower !== null ? number_format($compareCar->horsepower) . ' HP' : '—' }}</span>
                            <span>{{ $compareCar->acceleration_0_100 !== null ? number_format((float) $compareCar->acceleration_0_100, 2) . ' s' : '—' }}</span>
                            <span>{{ $compareCar->top_speed_kmh !== null ? number_format($compareCar->top_speed_kmh) . ' km/h' : '—' }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>