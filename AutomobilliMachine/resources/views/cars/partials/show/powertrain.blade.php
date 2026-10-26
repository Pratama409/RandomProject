@if (!empty($powertrainSection) || $detailSections->whereIn('label', ['DRIVING', 'TRANSMISSION'])->isNotEmpty())
<section class="car-detail-section car-detail-powertrain" id="powertrain">
    <div class="container">
        <div class="car-detail-powertrain-layout">
            <div class="car-detail-copy">
                <span class="car-detail-label">POWERTRAIN</span>
                <h2>{{ $powertrainSection['title'] ?? 'Powertrain' }}</h2>
                @foreach ($powertrainSection['paragraphs'] ?? [] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                @if (!empty($powertrainSection['items']))
                    <ul class="car-detail-points">
                        @foreach ($powertrainSection['items'] as $item)
                            <li><i class="fa-solid fa-arrow-right"></i>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif

                @foreach ($detailSections->whereIn('label', ['DRIVING', 'TRANSMISSION']) as $extraSection)
                    <div class="mt-4">
                        <span class="car-detail-label">{{ $extraSection['label'] }}</span>
                        <h3 class="fs-5 mt-2 mb-2">{{ $extraSection['title'] ?? ucfirst(strtolower($extraSection['label'])) }}</h3>
                        @foreach ($extraSection['paragraphs'] ?? [] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                        @if (!empty($extraSection['items']))
                            <ul class="car-detail-points">
                                @foreach ($extraSection['items'] as $item)
                                    <li><i class="fa-solid fa-arrow-right"></i>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="car-detail-engine-wrap">
                @if (!empty($powertrainSection['image']))
                    <button type="button" class="car-detail-engine-image js-lightbox-trigger"
                        data-lightbox-src="{{ str_starts_with($powertrainSection['image'], 'http') ? $powertrainSection['image'] : asset($powertrainSection['image']) }}"
                        data-lightbox-caption="{{ $vehicle->name }} — powertrain">
                        <img src="{{ str_starts_with($powertrainSection['image'], 'http') ? $powertrainSection['image'] : asset($powertrainSection['image']) }}" alt="{{ $vehicle->name }} powertrain" loading="lazy">
                        <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
                    </button>
                @else
                    <div class="car-detail-powertrain-fallback"><span>{{ $vehicle->engine ?: 'ENGINE' }}</span><strong>{{ $vehicle->vehicle_type ?: 'POWERTRAIN DETAILS' }}</strong></div>
                @endif
            </div>

            <div class="car-detail-powertrain-specs">
                @foreach ($powertrainSection['specs'] ?? [] as $spec)
                    <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                @endforeach
                @foreach ($detailSections->whereIn('label', ['DRIVING', 'TRANSMISSION']) as $extraSection)
                    @foreach ($extraSection['specs'] ?? [] as $spec)
                        <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
