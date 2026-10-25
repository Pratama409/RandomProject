@php
    $car = $car ?? new \App\Models\Car();
    $currentImageUrl = $car->image_path
        ? (str_starts_with($car->image_path, 'http')
            ? $car->image_path
            : asset(ltrim($car->image_path, '/')))
        : null;

    $booleanFields = [
        ['name' => 'is_active', 'label' => 'Visible in public catalog'],
        ['name' => 'is_featured', 'label' => 'Featured vehicle'],
        ['name' => 'is_iconic', 'label' => 'Show in Iconic Picks'],
        ['name' => 'publicly_sold', 'label' => 'Publicly sold'],
        ['name' => 'road_legal', 'label' => 'Road legal'],
        ['name' => 'is_limited', 'label' => 'Limited production'],
        ['name' => 'is_one_off', 'label' => 'One-off model'],
        ['name' => 'is_concept', 'label' => 'Concept vehicle'],
        ['name' => 'is_track_only', 'label' => 'Track-only vehicle'],
        ['name' => 'is_racing', 'label' => 'Racing vehicle'],
        ['name' => 'stats_tested', 'label' => 'Performance figures tested'],
    ];
@endphp

<div class="admin-form-section">
    <div class="admin-form-section-heading">
        <span>01</span>
        <div><h2>Identity & Classification</h2><p>Core information and Eloquent relationships.</p></div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Car name <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" maxlength="255" required
                value="{{ old('name', $car->name) }}"
                class="form-control admin-input @error('name') is-invalid @enderror"
                placeholder="Enter the vehicle name">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label for="slug" class="form-label">URL slug <span class="text-danger">*</span></label>
            <input id="slug" name="slug" type="text" maxlength="255" required
                value="{{ old('slug', $car->slug) }}"
                class="form-control admin-input @error('slug') is-invalid @enderror"
                placeholder="e.g. model-name">
            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="admin-field-hint">Use lowercase words separated by hyphens; unique within each brand.</small>
        </div>
        <div class="col-md-6">
            <label for="brand_id" class="form-label">Brand <span class="text-danger">*</span></label>
            <select id="brand_id" name="brand_id" required class="form-select admin-input @error('brand_id') is-invalid @enderror">
                <option value="">Select a brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected((string) old('brand_id', $car->brand_id) === (string) $brand->id)>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label for="category_id" class="form-label">Category</label>
            <select id="category_id" name="category_id" class="form-select admin-input @error('category_id') is-invalid @enderror">
                <option value="">No category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $car->category_id) === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <label for="model_family" class="form-label">Model family</label>
            <input id="model_family" name="model_family" type="text" value="{{ old('model_family', $car->model_family) }}" class="form-control admin-input" placeholder="e.g. model family">
        </div>
        <div class="col-md-4">
            <label for="generation" class="form-label">Generation</label>
            <input id="generation" name="generation" type="text" value="{{ old('generation', $car->generation) }}" class="form-control admin-input" placeholder="e.g. generation or series">
        </div>
        <div class="col-md-4">
            <label for="variant" class="form-label">Variant</label>
            <input id="variant" name="variant" type="text" value="{{ old('variant', $car->variant) }}" class="form-control admin-input" placeholder="e.g. Sport / Performance">
        </div>
        <div class="col-md-6">
            <label for="base_model" class="form-label">Base model</label>
            <input id="base_model" name="base_model" type="text" value="{{ old('base_model', $car->base_model) }}" class="form-control admin-input" placeholder="Enter base model">
        </div>
        <div class="col-md-3">
            <label for="production_type" class="form-label">Production type <span class="text-danger">*</span></label>
            <input id="production_type" name="production_type" type="text" maxlength="40" required
                value="{{ old('production_type', $car->production_type) }}"
                placeholder="e.g. Production / Concept / Racing"
                class="form-control admin-input @error('production_type') is-invalid @enderror">
            @error('production_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="vehicle_type" class="form-label">Vehicle type <span class="text-danger">*</span></label>
            <input id="vehicle_type" name="vehicle_type" type="text" maxlength="40" required
                value="{{ old('vehicle_type', $car->vehicle_type) }}"
                placeholder="e.g. Road Car / Race Car / Concept Car"
                class="form-control admin-input @error('vehicle_type') is-invalid @enderror">
            @error('vehicle_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="admin-form-section">
    <div class="admin-form-section-heading">
        <span>02</span>
        <div><h2>Production & Specifications</h2><p>Optional data used by catalog filters and comparison features.</p></div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <label for="production_year_start" class="form-label">Production year start</label>
            <input id="production_year_start" name="production_year_start" type="number" min="1885" max="{{ now()->year + 3 }}"
                value="{{ old('production_year_start', $car->production_year_start) }}" class="form-control admin-input @error('production_year_start') is-invalid @enderror">
            @error('production_year_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="production_year_end" class="form-label">Production year end</label>
            <input id="production_year_end" name="production_year_end" type="number" min="1885" max="{{ now()->year + 3 }}"
                value="{{ old('production_year_end', $car->production_year_end) }}" class="form-control admin-input @error('production_year_end') is-invalid @enderror">
            @error('production_year_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="production_count" class="form-label">Production count</label>
            <input id="production_count" name="production_count" type="number" min="1"
                value="{{ old('production_count', $car->production_count) }}" class="form-control admin-input @error('production_count') is-invalid @enderror">
            @error('production_count') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="horsepower" class="form-label">Horsepower (HP)</label>
            <input id="horsepower" name="horsepower" type="number" min="0" max="10000"
                value="{{ old('horsepower', $car->horsepower) }}" class="form-control admin-input @error('horsepower') is-invalid @enderror">
            @error('horsepower') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="torque_nm" class="form-label">Torque (Nm)</label>
            <input id="torque_nm" name="torque_nm" type="number" min="0" max="100000"
                value="{{ old('torque_nm', $car->torque_nm) }}" class="form-control admin-input @error('torque_nm') is-invalid @enderror">
            @error('torque_nm') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="acceleration_0_100" class="form-label">0–100 km/h (seconds)</label>
            <input id="acceleration_0_100" name="acceleration_0_100" type="number" min="0" max="99.99" step="0.01"
                value="{{ old('acceleration_0_100', $car->acceleration_0_100) }}" class="form-control admin-input @error('acceleration_0_100') is-invalid @enderror">
            @error('acceleration_0_100') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3">
            <label for="top_speed_kmh" class="form-label">Top speed (km/h)</label>
            <input id="top_speed_kmh" name="top_speed_kmh" type="number" min="0" max="1000"
                value="{{ old('top_speed_kmh', $car->top_speed_kmh) }}" class="form-control admin-input @error('top_speed_kmh') is-invalid @enderror">
            @error('top_speed_kmh') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6">
            <label for="engine" class="form-label">Engine</label>
            <input id="engine" name="engine" type="text" value="{{ old('engine', $car->engine) }}" class="form-control admin-input" placeholder="e.g. 3.0L turbocharged V6">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">Upload vehicle image</label>
            <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="form-control admin-input admin-file-input @error('image') is-invalid @enderror">
            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="admin-field-hint">Choose JPG, PNG, or WEBP up to 5 MB. The file will be saved in public/image/cars.</small>
        </div>
        @if ($currentImageUrl)
            <div class="col-12">
                <div class="admin-current-image">
                    <img src="{{ $currentImageUrl }}" alt="Current image for {{ $car->name }}" loading="lazy">
                    <div>
                        <strong>Current catalog image</strong>
                        <span>A photo is already assigned to this vehicle.</span>
                        <small>Upload a new file above to replace this image.</small>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-4">
            <label for="drivetrain" class="form-label">Drivetrain</label>
            <input id="drivetrain" name="drivetrain" type="text" value="{{ old('drivetrain', $car->drivetrain) }}" class="form-control admin-input" placeholder="e.g. RWD / AWD / FWD">
        </div>
        <div class="col-md-4">
            <label for="transmission" class="form-label">Transmission</label>
            <input id="transmission" name="transmission" type="text" value="{{ old('transmission', $car->transmission) }}" class="form-control admin-input" placeholder="e.g. 8-speed automatic">
        </div>
        <div class="col-md-4">
            <label for="fuel_type" class="form-label">Fuel type</label>
            <input id="fuel_type" name="fuel_type" type="text" value="{{ old('fuel_type', $car->fuel_type) }}" class="form-control admin-input" placeholder="e.g. Petrol / Hybrid / Electric">
        </div>
        <div class="col-md-4">
            <label for="body_type" class="form-label">Body type</label>
            <input id="body_type" name="body_type" type="text" value="{{ old('body_type', $car->body_type) }}" class="form-control admin-input" placeholder="e.g. Coupe / SUV / Sedan">
        </div>
        <div class="col-md-8">
            <label for="short_description" class="form-label">Short description</label>
            <input id="short_description" name="short_description" type="text" maxlength="1000"
                value="{{ old('short_description', $car->short_description) }}" class="form-control admin-input">
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Full description</label>
            <textarea id="description" name="description" rows="4" class="form-control admin-input">{{ old('description', $car->description) }}</textarea>
        </div>
    </div>
</div>

<div class="admin-form-section admin-form-section-last">
    <div class="admin-form-section-heading">
        <span>03</span>
        <div><h2>Visibility & Vehicle Flags</h2><p>These switches affect where the vehicle may appear on the site.</p></div>
    </div>

    <div class="admin-flag-grid">
        @foreach ($booleanFields as $field)
            <label class="admin-checkbox-card" for="{{ $field['name'] }}">
                <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="checkbox" value="1"
                    @checked((bool) old($field['name'], $car->{$field['name']} ?? ($field['name'] === 'is_active')))>
                <span class="admin-checkbox-indicator"><i class="fa-solid fa-check"></i></span>
                <span>{{ $field['label'] }}</span>
            </label>
        @endforeach
    </div>
</div>
