<section class="car-detail-section car-detail-design" id="design">
    <div class="container">
        <div class="car-detail-editorial-grid">
            <div class="car-detail-copy">
                <span class="car-detail-label">DESIGN</span>
                <h2>{{ $designSection['title'] ?? 'Design & Aerodynamics' }}</h2>
                @foreach ($designSection['paragraphs'] ?? [] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="car-detail-collage">
                @php
                    $designImages = [
                        $gallery->get(0) ?? $gallery->first(),
                        $gallery->get(2) ?? $gallery->first(),
                        $gallery->get(3) ?? $gallery->get(2) ?? $gallery->first()
                    ];
                @endphp
                @foreach ($designImages as $index => $image)
                    @php $url = str_starts_with($image, 'http') ? $image : asset($image); @endphp
                    <button type="button" class="car-detail-collage-item {{ $index === 0 ? 'main' : 'small' }} js-lightbox-trigger"
                        data-lightbox-src="{{ $url }}" data-lightbox-caption="{{ $vehicle->name }} — design">
                        <img src="{{ $url }}" alt="{{ $vehicle->name }} design detail {{ $index + 1 }}" loading="lazy">
                        <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
                    </button>
                @endforeach
            </div>
        </div>

        @if (!empty($designSection['specs']))
            <div class="car-detail-spec-strip">
                @foreach ($designSection['specs'] as $spec)
                    <div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>
                @endforeach
            </div>
        @endif
    </div>
</section>