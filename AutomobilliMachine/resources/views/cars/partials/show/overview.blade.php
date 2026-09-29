<section class="car-detail-section car-detail-overview" id="overview">
    <div class="container car-detail-split">
        <div class="car-detail-copy">
            <span class="car-detail-label">OVERVIEW</span>
            <h2>{{ $overviewSection['title'] ?? ('The story of ' . $vehicle->name) }}</h2>

            @foreach (($overviewSection['paragraphs'] ?? [$vehicle->description ?? $vehicle->short_description]) as $paragraph)
                @if ($paragraph)<p>{{ $paragraph }}</p>@endif
            @endforeach

            <div class="car-detail-facts">
                <div><span>Model Family</span><strong>{{ $vehicle->model_family ?: $vehicle->name }}</strong></div>
                <div><span>Production</span><strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ($vehicle->production_year_start ? ' – Present' : '') }}</strong></div>
                <div><span>Powertrain</span><strong>{{ $vehicle->engine ?: '—' }}</strong></div>
                <div><span>Layout</span><strong>{{ $vehicle->drivetrain ?: '—' }}</strong></div>
            </div>
        </div>

        @php $overviewImage = $gallery->get(1) ?? $gallery->first(); $overviewUrl = str_starts_with($overviewImage, 'http') ? $overviewImage : asset($overviewImage); @endphp
        <button type="button" class="car-detail-image-frame js-lightbox-trigger"
            data-lightbox-src="{{ $overviewUrl }}" data-lightbox-caption="{{ $vehicle->name }} — overview">
            <img src="{{ $overviewUrl }}" alt="{{ $vehicle->name }} overview" loading="lazy">
            <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
        </button>
    </div>
</section>