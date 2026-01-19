@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row">
  <div class="col-md-6">
    <label>{{ __('cms.title_ar') }}</label>
    <input name="title_ar" class="form-control" value="{{ old('title_ar', $model->title_ar ?? '') }}" required>
  </div>
  <div class="col-md-6">
    <label>{{ __('cms.title_en') }}</label>
    <input name="title_en" class="form-control" value="{{ old('title_en', $model->title_en ?? '') }}" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-12">
    <label>{{ __('cms.slug') }}</label>
    <input name="slug" class="form-control" value="{{ old('slug', $model->slug ?? '') }}" required>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-6">
    <label>{{ __('cms.content_ar') }}</label>
    <textarea name="content_ar" class="form-control" rows="6">{{ old('content_ar', $model->content_ar ?? '') }}</textarea>
  </div>
  <div class="col-md-6">
    <label>{{ __('cms.content_en') }}</label>
    <textarea name="content_en" class="form-control" rows="6">{{ old('content_en', $model->content_en ?? '') }}</textarea>
  </div>
</div>

<div class="row mt-3">
  <div class="col-md-4">
    <label>{{ __('cms.cover') }}</label>
    <input type="file" name="cover" class="form-control">
    @if(!empty($model?->cover))
      <div class="mt-2">
        <img src="{{ asset($model->cover) }}" width="120" class="img-thumbnail">
      </div>
    @endif
  </div>

  <div class="col-md-4">
    <label>{{ __('cms.status') }}</label>
    <select name="is_published" class="form-control">
      <option value="0" @selected(old('is_published', $model->is_published ?? 0) == 0)>{{ __('cms.draft') }}</option>
      <option value="1" @selected(old('is_published', $model->is_published ?? 0) == 1)>{{ __('cms.published') }}</option>
    </select>
  </div>

  <div class="col-md-4">
    <label>{{ __('cms.sort_order') }}</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $model->sort_order ?? 0) }}">
  </div>
</div>
