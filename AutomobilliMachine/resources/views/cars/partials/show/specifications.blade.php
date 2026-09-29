<section class="car-detail-section car-detail-specifications" id="specifications">
    <div class="container">
        <div class="car-detail-section-heading">
            <div>
                <span class="car-detail-label">KEY SPECIFICATIONS</span>
                <h2>The numbers behind {{ $vehicle->name }}</h2>
            </div>
        </div>

        <div class="car-detail-spec-grid">
            <div><span>Engine</span><strong>{{ $vehicle->engine ?: '—' }}</strong></div>
            <div><span>Total Output</span><strong>{{ $vehicle->horsepower !== null ? number_format($vehicle->horsepower) . ' HP' : '—' }}</strong></div>
            <div><span>Total Torque</span><strong>{{ $vehicle->torque_nm !== null ? number_format($vehicle->torque_nm) . ' Nm' : '—' }}</strong></div>
            <div><span>Drivetrain</span><strong>{{ $vehicle->drivetrain ?: '—' }}</strong></div>
            <div><span>Transmission</span><strong>{{ $vehicle->transmission ?: '—' }}</strong></div>
            <div><span>Fuel Type</span><strong>{{ $vehicle->fuel_type ?: '—' }}</strong></div>
            <div><span>Body Type</span><strong>{{ $vehicle->body_type ?: '—' }}</strong></div>
            <div><span>Production</span><strong>{{ $vehicle->production_year_start ?: '—' }}{{ $vehicle->production_year_end ? ' – ' . $vehicle->production_year_end : ' – Present' }}</strong></div>
            @foreach ($dimensionsSection['specs'] ?? [] as $spec)
                <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
            @endforeach
        </div>
    </div>
</section>