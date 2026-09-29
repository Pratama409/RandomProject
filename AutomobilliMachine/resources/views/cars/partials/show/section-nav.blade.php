<nav class="car-detail-nav" aria-label="Vehicle sections">
    <div class="container">
        <div class="car-detail-nav-scroll">
            <a href="#overview" data-section-link>Overview</a>
            @if (!empty($designSection))<a href="#design" data-section-link>Design</a>@endif
            @if (!empty($powertrainSection))<a href="#powertrain" data-section-link>Powertrain</a>@endif
            <a href="#performance" data-section-link>Performance</a>
            <a href="#specifications" data-section-link>Specifications</a>
            <a href="#insights" data-section-link>Insights</a>
            @if ($interiorSection)<a href="#interior" data-section-link>Interior</a>@endif
            @if ($chassisSection || $handlingSection)<a href="#chassis" data-section-link>Chassis</a>@endif
            <a href="#production" data-section-link>Production</a>
            @if (!empty($vehicle->variants))<a href="#variants" data-section-link>Variants</a>@endif
            <a href="#gallery" data-section-link>Gallery</a>
            <a href="#compare" data-section-link>Compare</a>
        </div>
    </div>
</nav>