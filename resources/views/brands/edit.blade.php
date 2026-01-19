@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.edit_brand') }}</h5>
      <a href="{{ route('admin.brands.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.brands') }}
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $brand->name_en) }}">
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $brand->name_ar) }}">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.description_en') }}</label>
            <textarea name="description_en" class="form-control">{{ old('description_en', $brand->description_en) }}</textarea>
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.description_ar') }}</label>
            <textarea name="description_ar" class="form-control">{{ old('description_ar', $brand->description_ar) }}</textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.logo') }}</label>
            <input type="file" name="logo" class="form-control">
            @if($brand->logo)
              <div class="mt-2">
                <img src="{{ asset($brand->logo) }}" width="90">
              </div>
            @endif
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.sort_order') }}</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $brand->sort_order) }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1" @selected(old('is_active', $brand->is_active) == 1)>{{ __('messages.status_active') }}</option>
              <option value="0" @selected(old('is_active', $brand->is_active) == 0)>{{ __('messages.status_inactive') }}</option>
            </select>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>
          <div class="mt-3">
        <small class="text-muted">
          {{ __('messages.slug') }}: <strong>{{ $brand->slug }}</strong>
        </small>
      </div>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>
    
    </div>

  </div>
</div>
@endsection
