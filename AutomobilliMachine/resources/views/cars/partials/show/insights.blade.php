<section class="car-detail-section car-detail-insights" id="insights">
    <div class="container">
        <div class="car-detail-section-heading">
            <div>
                <span class="car-detail-label">QUICK INSIGHTS</span>
                <h2>Explore the details</h2>
                <p>Open a topic to explore its visual story, explanation, and supporting specifications.</p>
            </div>
        </div>

        <div class="car-detail-insight-grid">
            @foreach ($quickInsights as $index => $insight)
                @php $imageUrl = !empty($insight['image']) ? (str_starts_with($insight['image'], 'http') ? $insight['image'] : asset($insight['image'])) : null; @endphp
                <button type="button" class="car-detail-insight-card js-insight-open" data-insight-index="{{ $index }}">
                    <div class="car-detail-insight-card-media">
                        @if ($imageUrl)<img src="{{ $imageUrl }}" alt="{{ $vehicle->name }} {{ strtolower($insight['label']) }}" loading="lazy">@endif
                        <span class="car-detail-insight-icon"><i class="fa-solid {{ $insight['icon'] }}"></i></span>
                    </div>
                    <div class="car-detail-insight-card-body">
                        <span class="car-detail-label">{{ $insight['label'] }}</span>
                        <h3>{{ $insight['title'] }}</h3>
                        <p>{{ $insight['summary'] }}</p>
                        <span class="car-detail-insight-open">Explore <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</section>