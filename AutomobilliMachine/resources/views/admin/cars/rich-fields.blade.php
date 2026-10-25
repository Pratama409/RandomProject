@php
    $richSections = [
        'OVERVIEW' => ['label' => 'Overview', 'hint' => 'Introduction and model history'],
        'DESIGN' => ['label' => 'Design', 'hint' => 'Aerodynamics, styling and design specifications'],
        'POWERTRAIN' => ['label' => 'Powertrain', 'hint' => 'Engine, electric motors and technical figures'],
        'PERFORMANCE' => ['label' => 'Performance', 'hint' => 'Additional figures, including 0–200 km/h and lap times'],
        'INTERIOR' => ['label' => 'Interior', 'hint' => 'Cockpit information and interior photos'],
        'HANDLING' => ['label' => 'Handling', 'hint' => 'Driving systems and technical highlights'],
        'CHASSIS' => ['label' => 'Chassis', 'hint' => 'Construction, materials and chassis images'],
        'DIMENSIONS' => ['label' => 'Dimensions', 'hint' => 'Length, width, height and wheelbase'],
        'DRIVING' => ['label' => 'Driving', 'hint' => 'Drive modes and driving characteristics'],
        'TRANSMISSION' => ['label' => 'Transmission', 'hint' => 'Gearbox and driveline details'],
    ];
    $sectionData = collect($car->detail_sections ?? [])->filter(fn ($item) => is_array($item) && !empty($item['label']))->keyBy('label');
    $variantRows = old('variants_editor', $car->variants ?? []);
    $sourceRows = old('sources_editor', $car->source_links ?? []);
@endphp

<div class="admin-form-section">
    <div class="admin-form-section-heading">
        <span>04</span>
        <div><h2>Vehicle Photo Gallery</h2><p>Add images for the hero thumbnails, gallery and editorial photos. Existing images can be removed without deleting the source files from disk.</p></div>
    </div>
    <input type="hidden" name="gallery_editor_present" value="1">
    <div class="row g-3">
        <div class="col-12">
            <label for="gallery_files" class="form-label">Additional vehicle photos</label>
            <input id="gallery_files" name="gallery_files[]" type="file" multiple
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="form-control admin-input admin-file-input @error('gallery_files') is-invalid @enderror @error('gallery_files.*') is-invalid @enderror">
            <small class="admin-field-hint">Up to 16 images per submission, 5 MB each. Files are stored in public/image/cars and displayed in Gallery.</small>
            @error('gallery_files') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @error('gallery_files.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        @if (!empty($car->gallery_images))
            <div class="col-12">
                <div class="admin-editor-image-grid">
                    @foreach ($car->gallery_images as $galleryImage)
                        @php
                            $galleryUrl = str_starts_with($galleryImage, 'http')
                                ? $galleryImage : asset(ltrim($galleryImage, '/'));
                        @endphp
                        <label class="admin-editor-image-card">
                            <img src="{{ $galleryUrl }}" alt="Vehicle gallery photo" loading="lazy">
                            <span class="admin-image-remove-label">
                                <input type="checkbox" name="gallery_remove[]" value="{{ $galleryImage }}"
                                    @checked(in_array($galleryImage, old('gallery_remove', []), true))>
                                Remove photo
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<div class="admin-form-section">
    <div class="admin-form-section-heading">
        <span>05</span>
        <div><h2>Editorial Detail Sections</h2><p>Manage the same content sections shown on the public vehicle page. Leave a new section blank to omit it.</p></div>
    </div>

    <div class="admin-editor-sections">
        @foreach ($richSections as $key => $meta)
            @php
                $saved = $sectionData->get($key, []);
                $paragraphs = implode("\n", $saved['paragraphs'] ?? []);
                $items = implode("\n", $saved['items'] ?? []);
                $specs = collect($saved['specs'] ?? [])->map(fn ($item) => ($item['label'] ?? '') . ' | ' . ($item['value'] ?? ''))->implode("\n");
                $imageKey = $key === 'POWERTRAIN' ? 'image' : 'detail_image';
                $sectionImage = $saved[$imageKey] ?? null;
                $sectionImageUrl = $sectionImage ? (str_starts_with($sectionImage, 'http') ? $sectionImage : asset(ltrim($sectionImage, '/'))) : null;
                $hasErrors = $errors->has("detail_editor.$key.*") || $errors->has("section_images.$key");
                $isOpen = $hasErrors || in_array($key, ['OVERVIEW', 'DESIGN'], true);
            @endphp
            <details class="admin-editor-accordion" @if ($isOpen) open @endif>
                <summary>
                    <span class="admin-editor-section-icon"><i class="fa-regular fa-file-lines"></i></span>
                    <span><strong>{{ $meta['label'] }}</strong><small>{{ $meta['hint'] }}</small></span>
                    <i class="fa-solid fa-chevron-down admin-editor-chevron"></i>
                </summary>
                <div class="admin-editor-accordion-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="detail-title-{{ $key }}" class="form-label">Section headline</label>
                            <input id="detail-title-{{ $key }}" type="text" maxlength="255" name="detail_editor[{{ $key }}][title]"
                                value="{{ old("detail_editor.$key.title", $saved['title'] ?? '') }}"
                                class="form-control admin-input" placeholder="Optional section heading">
                        </div>
                        <div class="col-12">
                            <label for="detail-paragraphs-{{ $key }}" class="form-label">Descriptions / paragraphs</label>
                            <textarea id="detail-paragraphs-{{ $key }}" name="detail_editor[{{ $key }}][paragraphs_text]"
                                class="form-control admin-input" rows="5" placeholder="Write one paragraph per line.">{{ old("detail_editor.$key.paragraphs_text", $paragraphs) }}</textarea>
                            <small class="admin-field-hint">Each line is rendered as a separate paragraph.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="detail-specs-{{ $key }}" class="form-label">Specification facts</label>
                            <textarea id="detail-specs-{{ $key }}" name="detail_editor[{{ $key }}][specs_text]"
                                class="form-control admin-input" rows="4" placeholder="Label | Value&#10;Engine | 3.0L V6">{{ old("detail_editor.$key.specs_text", $specs) }}</textarea>
                            <small class="admin-field-hint">One fact per line, separated by the | character.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="detail-items-{{ $key }}" class="form-label">Bullet points</label>
                            <textarea id="detail-items-{{ $key }}" name="detail_editor[{{ $key }}][items_text]"
                                class="form-control admin-input" rows="4" placeholder="One bullet point per line">{{ old("detail_editor.$key.items_text", $items) }}</textarea>
                            <small class="admin-field-hint">Useful for chassis, handling and driving features.</small>
                        </div>
                        <div class="col-md-7">
                            <label for="section-image-{{ $key }}" class="form-label">Section photo</label>
                            <input id="section-image-{{ $key }}" name="section_images[{{ $key }}]" type="file"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="form-control admin-input admin-file-input @error("section_images.$key") is-invalid @enderror">
                            @error("section_images.$key") <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="admin-field-hint">Upload an image for this section (up to 5 MB).</small>
                        </div>
                        @if ($sectionImageUrl)
                            <div class="col-md-5">
                                <div class="admin-editor-image-inline">
                                    <img src="{{ $sectionImageUrl }}" alt="{{ $meta['label'] }} image" loading="lazy">
                                    <label class="admin-editor-check">
                                        <input type="checkbox" name="section_image_remove[{{ $key }}]" value="1"
                                            @checked(old("section_image_remove.$key"))>
                                        Remove
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <label class="admin-editor-check">
                                <input type="checkbox" name="detail_editor[{{ $key }}][remove]" value="1"
                                    @checked(old("detail_editor.$key.remove"))>
                                Remove this entire section from the public page
                            </label>
                        </div>
                    </div>
                </div>
            </details>
        @endforeach
    </div>
</div>

<div class="admin-form-section">
    <div class="admin-form-section-heading">
        <span>06</span>
        <div><h2>Variants & Related Models</h2><p>Add the model variants shown under “Versions & related derivatives”.</p></div>
    </div>
    <input type="hidden" name="variants_editor_present" value="1">
    <div class="admin-editor-repeater" data-admin-repeater="variants" data-next-index="{{ count($variantRows) }}">
        <div data-repeater-rows>
            @foreach ($variantRows as $index => $variantRow)
                <div class="admin-editor-repeat-row">
                    <div class="row g-2">
                        <div class="col-md-3"><label class="form-label">Type</label><input type="text" class="form-control admin-input" name="variants_editor[{{ $index }}][type]" value="{{ $variantRow['type'] ?? '' }}" placeholder="e.g. Roadster"></div>
                        <div class="col-md-3"><label class="form-label">Model name</label><input type="text" class="form-control admin-input" name="variants_editor[{{ $index }}][name]" value="{{ $variantRow['name'] ?? '' }}" placeholder="Variant name"></div>
                        <div class="col-md-2"><label class="form-label">Years</label><input type="text" class="form-control admin-input" name="variants_editor[{{ $index }}][years]" value="{{ $variantRow['years'] ?? '' }}" placeholder="2020–2023"></div>
                        <div class="col-md-4"><label class="form-label">Description</label><input type="text" class="form-control admin-input" name="variants_editor[{{ $index }}][description]" value="{{ $variantRow['description'] ?? '' }}" placeholder="Short description"></div>
                    </div>
                    <button type="button" class="admin-editor-remove-row" data-repeater-remove><i class="fa-solid fa-xmark"></i> Remove variant</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="admin-editor-add-row" data-repeater-add><i class="fa-solid fa-plus"></i> Add variant</button>
        <template data-repeater-template>
            <div class="admin-editor-repeat-row">
                <div class="row g-2">
                    <div class="col-md-3"><label class="form-label">Type</label><input type="text" class="form-control admin-input" name="variants_editor[__INDEX__][type]" placeholder="e.g. Roadster"></div>
                    <div class="col-md-3"><label class="form-label">Model name</label><input type="text" class="form-control admin-input" name="variants_editor[__INDEX__][name]" placeholder="Variant name"></div>
                    <div class="col-md-2"><label class="form-label">Years</label><input type="text" class="form-control admin-input" name="variants_editor[__INDEX__][years]" placeholder="2020–2023"></div>
                    <div class="col-md-4"><label class="form-label">Description</label><input type="text" class="form-control admin-input" name="variants_editor[__INDEX__][description]" placeholder="Short description"></div>
                </div>
                <button type="button" class="admin-editor-remove-row" data-repeater-remove><i class="fa-solid fa-xmark"></i> Remove variant</button>
            </div>
        </template>
    </div>
</div>

<div class="admin-form-section admin-form-section-last">
    <div class="admin-form-section-heading">
        <span>07</span>
        <div><h2>Sources & References</h2><p>Maintain the external reference links shown at the bottom of the car detail page.</p></div>
    </div>
    <input type="hidden" name="sources_editor_present" value="1">
    <div class="admin-editor-repeater" data-admin-repeater="sources" data-next-index="{{ count($sourceRows) }}">
        <div data-repeater-rows>
            @foreach ($sourceRows as $index => $sourceRow)
                <div class="admin-editor-repeat-row">
                    <div class="row g-2">
                        <div class="col-md-4"><label class="form-label">Source title</label><input type="text" class="form-control admin-input" name="sources_editor[{{ $index }}][label]" value="{{ $sourceRow['label'] ?? '' }}" placeholder="e.g. Manufacturer specs"></div>
                        <div class="col-md-8"><label class="form-label">Source URL</label><input type="url" class="form-control admin-input" name="sources_editor[{{ $index }}][url]" value="{{ $sourceRow['url'] ?? '' }}" placeholder="https://example.com/reference"></div>
                    </div>
                    <button type="button" class="admin-editor-remove-row" data-repeater-remove><i class="fa-solid fa-xmark"></i> Remove source</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="admin-editor-add-row" data-repeater-add><i class="fa-solid fa-plus"></i> Add reference</button>
        <template data-repeater-template>
            <div class="admin-editor-repeat-row">
                <div class="row g-2">
                    <div class="col-md-4"><label class="form-label">Source title</label><input type="text" class="form-control admin-input" name="sources_editor[__INDEX__][label]" placeholder="e.g. Manufacturer specs"></div>
                    <div class="col-md-8"><label class="form-label">Source URL</label><input type="url" class="form-control admin-input" name="sources_editor[__INDEX__][url]" placeholder="https://example.com/reference"></div>
                </div>
                <button type="button" class="admin-editor-remove-row" data-repeater-remove><i class="fa-solid fa-xmark"></i> Remove source</button>
            </div>
        </template>
    </div>
</div>