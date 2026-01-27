<div class="row">
  <input type="hidden" name="items[{{ $i }}][id]" value="{{ $model->id }}">

  <div class="col-md-2">
    <div class="form-group">
      <label>{{ __('cms.step_no') }}</label>
      <input type="number" name="items[{{ $i }}][step_no]" class="form-control"
             value="{{ old("items.$i.step_no", $model->step_no) }}" min="1" max="4" required>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label>{{ __('cms.sort_order') }}</label>
      <input type="number" name="items[{{ $i }}][sort_order]" class="form-control"
             value="{{ old("items.$i.sort_order", $model->sort_order) }}" min="1" max="99" required>
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group">
      <label>{{ __('cms.status') }}</label>
      <select name="items[{{ $i }}][is_active]" class="form-control">
        <option value="1" @selected(old("items.$i.is_active", $model->is_active) == 1)>{{ __('cms.active') }}</option>
        <option value="0" @selected(old("items.$i.is_active", $model->is_active) == 0)>{{ __('cms.inactive') }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label>{{ __('cms.icon_type') }}</label>
      <select name="items[{{ $i }}][icon_type]" class="form-control">
        <option value="class" @selected(old("items.$i.icon_type", $model->icon_type) == 'class')>{{ __('cms.icon_class') }}</option>
        <option value="image" @selected(old("items.$i.icon_type", $model->icon_type) == 'image')>{{ __('cms.icon_image') }}</option>
      </select>
      <small class="text-muted">{{ __('cms.icon_hint') }}</small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label>{{ __('cms.icon') }}</label>

      {{-- class --}}
      <input type="text" class="form-control mb-2"
             name="items[{{ $i }}][icon_class]"
             value="{{ old("items.$i.icon_class", $model->icon_class) }}"
             placeholder="flaticon-search / fa fa-star">

      {{-- image --}}
      <input type="file" name="items[{{ $i }}][icon_image]" class="form-control">

      @if($model->icon_type === 'image' && $model->icon_image)
        <div class="mt-2">
          <img src="{{ asset($model->icon_image) }}" style="width:52px;height:52px;object-fit:contain;">
        </div>
      @endif
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label>{{ __('cms.title_en') }}</label>
    <input type="text" name="items[{{ $i }}][title_en]" class="form-control"
           value="{{ old("items.$i.title_en", $model->title_en) }}" required>
  </div>

  <div class="col-md-6">
    <label>{{ __('cms.title_ar') }}</label>
    <input type="text" name="items[{{ $i }}][title_ar]" class="form-control"
           value="{{ old("items.$i.title_ar", $model->title_ar) }}" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label>{{ __('cms.desc_en') }}</label>
    <textarea name="items[{{ $i }}][desc_en]" rows="3" class="form-control">{{ old("items.$i.desc_en", $model->desc_en) }}</textarea>
  </div>

  <div class="col-md-6">
    <label>{{ __('cms.desc_ar') }}</label>
    <textarea name="items[{{ $i }}][desc_ar]" rows="3" class="form-control">{{ old("items.$i.desc_ar", $model->desc_ar) }}</textarea>
  </div>
</div>
