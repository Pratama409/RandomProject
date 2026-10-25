<nav class="car-detail-nav" aria-label="Vehicle sections">
    <div class="container">
        <div class="car-detail-nav-scroll">
            <a href="#overview" data-section-link>Overview</a>
            @if (!empty($designSection))<a href="#design" data-section-link>Design</a>@endif
            @if (!empty($powertrainSection) || $detailSections->whereIn('label', ['DRIVING', 'TRANSMISSION'])->isNotEmpty())<a href="#powertrain" data-section-link>Powertrain</a>@endif
            @if ($vehicle->acceleration_0_100 !== null || $vehicle->top_speed_kmh !== null || !empty($performanceSection))<a href="#performance" data-section-link>Performance</a>@endif
            <a href="#specifications" data-section-link>Specifications</a>
            @if ($interiorSection)<a href="#interior" data-section-link>Interior</a>@endif
            @if ($chassisSection || $handlingSection)<a href="#chassis" data-section-link>Chassis</a>@endif
            <a href="#production" data-section-link>Production</a>
            @if (!empty($vehicle->variants))<a href="#variants" data-section-link>Variants</a>@endif
            @if ($gallery->isNotEmpty())<a href="#gallery" data-section-link>Gallery</a>@endif
            <a href="#compare" data-section-link>Compare</a>
        </div>
    </div>
</nav>