@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.add_product') }}</h5>
      <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.products') }}
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
          </div>
          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.description_en') }}</label>
            <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
          </div>
          <div class="col-md-6">
            <label>{{ __('messages.description_ar') }}</label>
            <textarea name="description_ar" class="form-control">{{ old('description_ar') }}</textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.category') }}</label>
            <select name="category_id" class="form-control">
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ app()->isLocale('ar') ? $cat->name_ar : $cat->name_en }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.brand') }}</label>
            <select name="brand_id" class="form-control">
              @foreach($brands as $b)
                <option value="{{ $b->id }}">{{ app()->isLocale('ar') ? $b->name_ar : $b->name_en }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-3">
            <label>{{ __('messages.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.sale_price') }}</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.stock') }}</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.track_stock') }}</label>
            <select name="track_stock" class="form-control">
              <option value="1">{{ __('messages.yes') }}</option>
              <option value="0">{{ __('messages.no') }}</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>{{ __('messages.sku') }}</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
          </div>

          <div class="col-md-4">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1">{{ __('messages.status_active') }}</option>
              <option value="0">{{ __('messages.status_inactive') }}</option>
            </select>
          </div>

          <div class="col-md-4">
            <label>{{ __('messages.images') }}</label>
            <input type="file" name="images[]" class="form-control" multiple>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
