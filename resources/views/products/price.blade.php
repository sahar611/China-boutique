@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.edit_product_price') }}</h5>

      <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.products') }}
      </a>
    </div>

    <div class="card-body">

      <form action="{{ route('admin.products.price.update', $product->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="row">

          <div class="col-md-6">
            <label>{{ __('messages.product_name') }}</label>
            <input type="text" class="form-control" disabled
                   value="{{ app()->isLocale('ar') ? $product->name_ar : $product->name_en }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.price') }}</label>
            <input type="number" step="0.01" name="price"
                   class="form-control"
                   value="{{ old('price', $product->price) }}">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.sale_price') }}</label>
            <input type="number" step="0.01" name="sale_price"
                   class="form-control"
                   value="{{ old('sale_price', $product->sale_price) }}">
            @error('sale_price') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

        </div>

        <p class="text-muted mt-3 mb-0">
          {{ __('messages.price_note') }}
        </p>

        <div class="text-end mt-4">
          @can('products.price_edit')
            <button class="btn bg-gradient-dark">
              {{ __('messages.save') }}
            </button>
          @endcan
        </div>

      </form>

    </div>

  </div>

</div>
@endsection
