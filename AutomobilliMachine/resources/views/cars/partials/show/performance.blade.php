<section class="car-detail-section car-detail-performance" id="performance">
    <div class="container">
        <div class="car-detail-section-heading">
            <div>
                <span class="car-detail-label">PERFORMANCE</span>
                <h2>{{ $performanceSection['title'] ?? 'Performance figures' }}</h2>
                <p>{{ $performanceSection['paragraphs'][0] ?? 'Key performance specifications recorded for this model.' }}</p>
            </div>
            <span class="car-detail-status {{ $vehicle->stats_tested ? 'is-tested' : '' }}">
                <i class="fa-solid fa-circle"></i> {{ $vehicle->stats_tested ? 'Tested' : 'Not Tested' }}
            </span>
        </div>

        <div class="car-detail-performance-grid">
            <article><span>0–100 km/h</span><strong>{{ $vehicle->acceleration_0_100 !== null ? number_format((float) $vehicle->acceleration_0_100, 2) : '—' }}</strong><small>seconds</small></article>
            <article><span>0–200 km/h</span><strong>{{ $zeroTo200['value'] ?? '—' }}</strong><small>factory figure</small></article>
            <article><span>Top Speed</span><strong>{{ $vehicle->top_speed_kmh !== null ? number_format($vehicle->top_speed_kmh) : '—' }}</strong><small>km/h</small></article>
            <article><span>Fiorano Lap</span><strong>{{ $fioranoLap['value'] ?? '—' }}</strong><small>recorded figure</small></article>
        </div>
    </div>
</section>