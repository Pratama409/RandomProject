<div class="car-lightbox" id="carLightbox" aria-hidden="true">
    <div class="car-lightbox-backdrop" data-lightbox-close></div>
    <div class="car-lightbox-dialog" role="dialog" aria-modal="true" aria-label="Vehicle image viewer">
        <button type="button" class="car-lightbox-close" data-lightbox-close aria-label="Close image viewer"><i class="fa-solid fa-xmark"></i></button>
        <button type="button" class="car-lightbox-prev" data-lightbox-prev aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
        <figure class="car-lightbox-figure"><img id="carLightboxImage" src="" alt=""><figcaption id="carLightboxCaption"></figcaption></figure>
        <button type="button" class="car-lightbox-next" data-lightbox-next aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
        <div class="car-lightbox-counter" id="carLightboxCounter">1 / 1</div>
        <div class="car-lightbox-thumbs" id="carLightboxThumbs"></div>
    </div>
</div>

<div class="car-insight-modal" id="carInsightModal" aria-hidden="true">
    <div class="car-insight-backdrop" data-insight-close></div>
    <div class="car-insight-dialog" role="dialog" aria-modal="true" aria-label="Vehicle detail">
        <button type="button" class="car-insight-close" data-insight-close aria-label="Close detail"><i class="fa-solid fa-xmark"></i></button>
        <button type="button" class="car-insight-prev" data-insight-prev aria-label="Previous detail"><i class="fa-solid fa-chevron-left"></i></button>
        <div class="car-insight-grid">
            <div class="car-insight-media"><img id="carInsightImage" src="" alt=""></div>
            <div class="car-insight-copy"><span class="car-detail-label" id="carInsightLabel">DETAIL</span><h2 id="carInsightTitle"></h2><p id="carInsightDescription"></p><div class="car-insight-specs" id="carInsightSpecs"></div><div class="car-insight-footer"><span id="carInsightCounter">1 / 4</span><span>Use ← → to explore</span></div></div>
        </div>
        <button type="button" class="car-insight-next" data-insight-next aria-label="Next detail"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div>