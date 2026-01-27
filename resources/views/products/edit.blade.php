@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.edit_product') }}</h5>
      <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.products') }}
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $product->name_en) }}">
          </div>
          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $product->name_ar) }}">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.description_en') }}</label>
            <textarea name="description_en" class="form-control">{{ old('description_en', $product->description_en) }}</textarea>
          </div>
          <div class="col-md-6">
            <label>{{ __('messages.description_ar') }}</label>
            <textarea name="description_ar" class="form-control">{{ old('description_ar', $product->description_ar) }}</textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.category') }}</label>
            <select name="category_id" class="form-control">
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>
                  {{ app()->isLocale('ar') ? $cat->name_ar : $cat->name_en }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.brand') }}</label>
            <select name="brand_id" class="form-control">
              @foreach($brands as $b)
                <option value="{{ $b->id }}" @selected(old('brand_id', $product->brand_id) == $b->id)>
                  {{ app()->isLocale('ar') ? $b->name_ar : $b->name_en }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-3">
            <label>{{ __('messages.price') }}</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.sale_price') }}</label>
            <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.stock') }}</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.track_stock') }}</label>
            <select name="track_stock" class="form-control">
              <option value="1" @selected(old('track_stock', $product->track_stock) == 1)>{{ __('messages.yes') }}</option>
              <option value="0" @selected(old('track_stock', $product->track_stock) == 0)>{{ __('messages.no') }}</option>
            </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <label>{{ __('messages.sku') }}</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
          </div>

          <div class="col-md-4">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1" @selected(old('is_active', $product->is_active) == 1)>{{ __('messages.status_active') }}</option>
              <option value="0" @selected(old('is_active', $product->is_active) == 0)>{{ __('messages.status_inactive') }}</option>
            </select>
          </div>
<div class="row mt-4">
  <div class="col-md-4">
    <label>{{ __('messages.show_in_home') }}</label>
    <select name="is_featured" class="form-control">
      <option value="0" @selected(old('is_featured', $product->is_featured ?? 0) == 0)>{{ __('messages.no') }}</option>
      <option value="1"  @selected(old('is_featured', $product->is_featured ?? 0) == 1)>{{ __('messages.yes') }}</option>
    </select>
  </div>

  <div class="col-md-4">
    <label>{{ __('messages.home_sort') }}</label>
    <input type="number" name="home_sort" class="form-control" value="{{ old('home_sort',0) }}">
  </div>

  <div class="col-md-4">
    <label>{{ __('messages.display_positions') }}</label>

   @php
  $selectedPositions = old('positions', $product->positions ?? ['none']);
  if (!is_array($selectedPositions)) $selectedPositions = ['none'];
@endphp

    <div class="border rounded p-3" style="max-height:220px; overflow:auto;">

  {{-- none --}}
  <div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="positions[]" value="none" id="p_none"
           @checked(in_array('none', $selectedPositions))>
    <label class="form-check-label" for="p_none">{{ __('messages.pos_none') }}</label>
  </div>

  {{-- home_top --}}
  <!-- <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_top" id="p_home_top"
           @checked(in_array('home_top', $selectedPositions))>
    <label class="form-check-label" for="p_home_top">{{ __('messages.pos_home_top_products') }}</label>
  </div> -->

  {{-- features_collection --}}
  <!-- <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="features_collection" id="p_feat"
           @checked(in_array('features_collection', $selectedPositions))>
    <label class="form-check-label" for="p_feat">{{ __('messages.pos_features_collection') }}</label>
  </div> -->

  {{-- trending --}}
  <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="trending" id="p_trending"
           @checked(in_array('trending', $selectedPositions))>
    <label class="form-check-label" for="p_trending">{{ __('messages.pos_trending') }}</label>
  </div>

  {{-- home_products --}}
  <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_products" id="p_home_products"
           @checked(in_array('home_products', $selectedPositions))>
    <label class="form-check-label" for="p_home_products">{{ __('messages.pos_home_products') }}</label>
  </div>

  <hr class="my-2">

  {{-- Tabs positions --}}
  <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="best_sellers" id="p_best_sellers"
           @checked(in_array('best_sellers', $selectedPositions))>
    <label class="form-check-label" for="p_best_sellers">{{ __('messages.pos_best_sellers') }}</label>
  </div>

  <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="new_products" id="p_new_products"
           @checked(in_array('new_products', $selectedPositions))>
    <label class="form-check-label" for="p_new_products">{{ __('messages.pos_new_products') }}</label>
  </div>

  <div class="form-check mb-2">
    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="sale_products" id="p_sale_products"
           @checked(in_array('sale_products', $selectedPositions))>
    <label class="form-check-label" for="p_sale_products">{{ __('messages.pos_sale_products') }}</label>
  </div>

</div>


   
  </div>
</div>



          <div class="col-md-4">
            <label>{{ __('messages.add_images') }}</label>
            <input type="file" name="images[]" class="form-control" multiple>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>

      {{-- Existing Images --}}
      <hr class="my-4">
      <h6 class="mb-3">{{ __('messages.product_images') }}</h6>

      <div class="row">
        @forelse($product->images as $img)
          <div class="col-md-3 mb-3">
            <div class="card">
              <img src="{{ asset($img->path) }}" class="card-img-top" style="height:160px;object-fit:cover;">
              <div class="card-body p-2">

                @if($img->is_main)
                  <span class="badge bg-success">{{ __('messages.main_image') }}</span>
                @else
                  <form method="POST" action="{{ route('admin.products.images.main', [$product->id, $img->id]) }}" style="display:inline-block">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-outline-primary w-100 mb-2">
                      {{ __('messages.set_as_main') }}
                    </button>
                  </form>
                @endif

                <form method="POST" action="{{ route('admin.products.images.destroy', [$product->id, $img->id]) }}"
                      onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger w-100">{{ __('messages.delete') }}</button>
                </form>

              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <p class="text-muted">{{ __('messages.no_images') }}</p>
          </div>
        @endforelse
      </div>

    </div>

  </div>
</div>
@endsection
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const none = document.getElementById('p_none');
    const items = document.querySelectorAll('.pos-item');

    function sync(){
      if(none.checked){
        items.forEach(i => i.checked = false);
      }
    }

    none?.addEventListener('change', sync);
    items.forEach(i => i.addEventListener('change', function(){
      if(this.checked) none.checked = false;
    }));

    sync();
  });
</script>
@endpush