@if ($interiorSection)
<section class="car-detail-section car-detail-image-section" id="interior">
    <div class="container">
        <div class="car-detail-editorial-grid">
            <div class="car-detail-copy">
                <span class="car-detail-label">INTERIOR</span>
                <h2>{{ $interiorSection['title'] }}</h2>
                @foreach ($interiorSection['paragraphs'] ?? [] as $paragraph)<p>{{ $paragraph }}</p>@endforeach
            </div>
            @php $image = $interiorSection['detail_image'] ?? $gallery->get(2) ?? $gallery->first(); $url = str_starts_with($image, 'http') ? $image : asset($image); @endphp
            <button type="button" class="car-detail-feature-image js-lightbox-trigger"
                data-lightbox-src="{{ $url }}" data-lightbox-caption="{{ $vehicle->name }} — interior">
                <img src="{{ $url }}" alt="{{ $vehicle->name }} interior" loading="lazy">
                <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
            </button>
        </div>
        @if (!empty($interiorSection['specs']))
            <div class="car-detail-spec-strip">
                @foreach ($interiorSection['specs'] as $spec)<div><span>{{ $spec['label'] }}</span><strong>{{ $spec['value'] }}</strong></div>@endforeach
            </div>
        @endif
    </div>
</section>
@endif