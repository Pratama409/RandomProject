<section class="car-detail-section car-detail-powertrain" id="powertrain">
    <div class="container">
        <div class="car-detail-powertrain-layout">
            <div class="car-detail-copy">
                <span class="car-detail-label">POWERTRAIN</span>
                <h2>{{ $powertrainSection['title'] ?? 'Powertrain' }}</h2>
                @foreach ($powertrainSection['paragraphs'] ?? [] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="car-detail-engine-wrap">
                @if (!empty($powertrainSection['image']))
                    <button type="button" class="car-detail-engine-image js-lightbox-trigger"
                        data-lightbox-src="{{ $powertrainSection['image'] }}"
                        data-lightbox-caption="{{ $vehicle->name }} — powertrain">
                        <img src="{{ $powertrainSection['image'] }}" alt="{{ $vehicle->name }} powertrain" loading="lazy">
                        <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
                    </button>
                @else
                    <div class="car-detail-powertrain-fallback"><span>V8</span><strong>+ 3 ELECTRIC MOTORS</strong></div>
                @endif
            </div>

            <div class="car-detail-powertrain-specs">
                @foreach ($powertrainSection['specs'] ?? [] as $spec)
                    <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                @endforeach
            </div>
        </div>
    </div>
</section>