<section class="car-detail-section car-detail-gallery" id="gallery">
    <div class="container">
        <div class="car-detail-section-heading"><div><span class="car-detail-label">GALLERY</span><h2>Explore every angle</h2><p>Click any image to view it fullscreen.</p></div></div>
        <div class="car-detail-gallery-grid">
            @foreach ($gallery as $index => $image)
                @php $url = str_starts_with($image, 'http') ? $image : asset($image); @endphp
                <button type="button" class="car-detail-gallery-item {{ $index === 0 ? 'is-large' : '' }} js-lightbox-trigger"
                    data-lightbox-src="{{ $url }}" data-lightbox-caption="{{ $vehicle->name }} — gallery {{ $index + 1 }}">
                    <img src="{{ $url }}" alt="{{ $vehicle->name }} gallery image {{ $index + 1 }}" loading="lazy">
                    <span class="car-detail-image-expand"><i class="fa-solid fa-expand"></i></span>
                </button>
            @endforeach
        </div>
    </div>
</section>