<section class="car-detail-section car-detail-production" id="production">
    <div class="container car-detail-split">
        <div class="car-detail-copy">
            <span class="car-detail-label">PRODUCTION</span>
            <h2>Model identity</h2>
            <p>{{ $brand->name }} production and model identity information, separated from performance data so the catalog remains easy to scan.</p>
        </div>
        <div class="car-detail-production-list">
            <div><span>Production Years</span><strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ' – Present' }}</strong></div>
            <div><span>Production Type</span><strong>{{ $vehicle->production_type ?: '—' }}</strong></div>
            <div><span>Publicly Sold</span><strong>{{ $vehicle->publicly_sold ? 'Yes' : 'No' }}</strong></div>
            <div><span>Road Legal</span><strong>{{ $vehicle->road_legal ? 'Yes' : 'No' }}</strong></div>
            <div><span>Production Count</span><strong>{{ $vehicle->production_count !== null ? number_format($vehicle->production_count) . ' units' : 'Not specified' }}</strong></div>
            <div><span>Generation</span><strong>{{ $vehicle->generation ?: '—' }}</strong></div>
        </div>
    </div>
</section>