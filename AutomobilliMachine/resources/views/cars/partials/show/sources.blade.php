@if (!empty($vehicle->source_links))
<section class="car-detail-section car-detail-sources">
    <div class="container"><span class="car-detail-label">SOURCES</span><h2>Reference material</h2>
        <div class="car-detail-source-list">
            @foreach ($vehicle->source_links as $source)
                <a href="{{ $source['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"><span>{{ $source['label'] ?? 'Source' }}</span><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            @endforeach
        </div>
    </div>
</section>
@endif