@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.edit_product_stock') }}</h5>

      <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.products') }}
      </a>
    </div>

    <div class="card-body">

      <form action="{{ route('admin.products.stock.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="row">

          <div class="col-md-6">
            <label>{{ __('messages.product_name') }}</label>
            <input type="text" class="form-control" disabled
                   value="{{ app()->isLocale('ar') ? $product->name_ar : $product->name_en }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.stock') }}</label>
            <input type="number" name="stock" class="form-control"
                   value="{{ old('stock', $product->stock) }}" min="0">
            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.track_stock') }}</label>
            <select name="track_stock" class="form-control">
              <option value="1" @selected(old('track_stock', $product->track_stock) == 1)>{{ __('messages.yes') }}</option>
              <option value="0" @selected(old('track_stock', $product->track_stock) == 0)>{{ __('messages.no') }}</option>
            </select>
            @error('track_stock') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

        </div>

        <p class="text-muted mt-3 mb-0">
          {{ __('messages.stock_note') }}
        </p>

        <div class="text-end mt-4">
          @can('products.stock_edit')
            <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
          @endcan
        </div>

      </form>

    </div>

  </div>

</div>
@endsection
