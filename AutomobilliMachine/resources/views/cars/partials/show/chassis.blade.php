@if ($chassisSection || $handlingSection)
<section class="car-detail-section car-detail-image-section" id="chassis">
    <div class="container">
        <div class="car-detail-editorial-grid">
            <div class="car-detail-copy">
                <span class="car-detail-label">CHASSIS & HANDLING</span>
                <h2>{{ $chassisSection['title'] ?? $handlingSection['title'] ?? 'Chassis & Handling' }}</h2>
                @foreach ($handlingSection['paragraphs'] ?? [] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
                @foreach ($chassisSection['paragraphs'] ?? [] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
                @if (!empty($handlingSection['items']))
                    <ul class="car-detail-points">
                        @foreach ($handlingSection['items'] as $item)<li><i class="fa-solid fa-arrow-right"></i>{{ $item }}</li>@endforeach
                    </ul>
                @endif
            </div>
            @php $image = $chassisSection['detail_image'] ?? $gallery->get(3) ?? $gallery->first(); $url = str_starts_with($image, 'http') ? $image : asset($image); @endphp
            <button type="button" class="car-detail-feature-image js-lightbox-trigger"
                data-lightbox-src="{{ $url }}" data-lightbox-caption="{{ $vehicle->name }} — chassis and handling">
                <img src="{{ $url }}" alt="{{ $vehicle->name }} chassis and handling" loading="lazy">
                <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
            </button>
        </div>
        @if (!empty($chassisSection['specs']) || !empty($handlingSection['specs']))
            <div class="car-detail-spec-strip">
                @foreach (collect($chassisSection['specs'] ?? [])->merge($handlingSection['specs'] ?? []) as $spec)<div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>@endforeach
            </div>
        @endif
    </div>
</section>
@endif