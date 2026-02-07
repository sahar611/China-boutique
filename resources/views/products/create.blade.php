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
<div class="row mt-4">
  <div class="col-md-4">
    <label>{{ __('messages.show_in_home') }}</label>
    <select name="is_featured" class="form-control">
      <option value="0" @selected(old('is_featured','0')=='0')>{{ __('messages.no') }}</option>
      <option value="1" @selected(old('is_featured')=='1')>{{ __('messages.yes') }}</option>
    </select>
  </div>

  <div class="col-md-4">
    <label>{{ __('messages.home_sort') }}</label>
    <input type="number" name="home_sort" class="form-control" value="{{ old('home_sort',0) }}">
  </div>

  <div class="col-md-4">
    <label>{{ __('messages.display_positions') }}</label>

    @php
      $selectedPositions = old('positions', ['none']);
      if (!is_array($selectedPositions)) $selectedPositions = ['none'];
    @endphp

    <div class="border rounded p-3" style="max-height:220px; overflow:auto;">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" name="positions[]" value="none" id="p_none"
               @checked(in_array('none',$selectedPositions))>
        <label class="form-check-label" for="p_none">{{ __('messages.pos_none') }}</label>
      </div>

      <!-- <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_top" id="p_home_top"
               @checked(in_array('home_top',$selectedPositions))>
        <label class="form-check-label" for="p_home_top">{{ __('messages.pos_home_top_products') }}</label>
      </div> -->

      <!-- <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="features_collection" id="p_feat"
               @checked(in_array('features_collection',$selectedPositions))>
        <label class="form-check-label" for="p_feat">{{ __('messages.pos_features_collection') }}</label>
      </div> -->

      <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="trending" id="p_trending"
               @checked(in_array('trending',$selectedPositions))>
        <label class="form-check-label" for="p_trending">{{ __('messages.pos_trending') }}</label>
      </div>

      <div class="form-check mb-2">
        <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_products" id="p_home_products"
               @checked(in_array('home_products',$selectedPositions))>
        <label class="form-check-label" for="p_home_products">{{ __('messages.pos_home_products') }}</label>
      </div>
<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="best_sellers" id="p_best_sellers"
         @checked(in_array('best_sellers',$selectedPositions))>
  <label class="form-check-label" for="p_best_sellers">{{ __('messages.pos_best_sellers') }}</label>
</div>

<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="new_products" id="p_new_products"
         @checked(in_array('new_products',$selectedPositions))>
  <label class="form-check-label" for="p_new_products">{{ __('messages.pos_new_products') }}</label>
</div>

<div class="form-check mb-2">
  <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="sale_products" id="p_sale_products"
         @checked(in_array('sale_products',$selectedPositions))>
  <label class="form-check-label" for="p_sale_products">{{ __('messages.pos_sale_products') }}</label>
</div>

    </div>

    <small class="text-muted d-block mt-2">
      {{ __('messages.positions_note') }}
    </small>
  </div>
</div>



          <div class="col-md-4">
            <label>{{ __('messages.images') }}</label>
            <input type="file" name="images[]" class="form-control" multiple>
          </div>
        </div>


        <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>
@php
 $sizeType = old('size_type', isset($product) ? $product->size_type : 'standard');


  // لو edit: هات variants من الداتا
  $existingVariants = isset($product) ? $product->variants : collect();

  // old variants لو رجع validation
  $oldVariants = old('variants');

  // مصدر البيانات للعرض
  $variantsData = is_array($oldVariants)
      ? $oldVariants
      : ($existingVariants->count() ? $existingVariants->map(function($v){
            return [
              'type' => $v->type,
              'size_code' => $v->size_code,
              'length' => $v->length,
              'width' => $v->width,
              'height' => $v->height,
              'unit' => $v->unit ?? 'cm',
             
            ];
        })->toArray() : []);

  // لو مفيش بيانات، حط صف افتراضي حسب النوع
  if (!$variantsData) {
      $variantsData = $sizeType === 'dimensions'
        ? [[ 'length'=>'', 'width'=>'', 'height'=>'', 'unit'=>'cm', 'stock'=>0, 'price'=>null, 'sale_price'=>null ]]
        : [[ 'size_code'=>'S', 'stock'=>0, 'price'=>null, 'sale_price'=>null ]];
  }

  $standardOptions = ['XS','S','M','L','XL','XXL','XXXL'];
@endphp

<hr class="my-4">
<h6 class="mb-3">{{ __('messages.sizes') ?? 'Sizes' }}</h6>

<div class="row">
  <div class="col-md-4">
    <label class="form-label">{{ __('messages.size_type') ?? 'Size Type' }}</label>
    <select name="size_type" id="size_type" class="form-control">
      <option value="standard" @selected($sizeType==='standard')>{{ __('messages.size_type_standard') ?? 'Standard (S/M/L)' }}</option>
      <option value="dimensions" @selected($sizeType==='dimensions')>{{ __('messages.size_type_dimensions') ?? 'Dimensions (L×W×H)' }}</option>
    </select>
  </div>
</div>

{{-- Standard table --}}
<div id="standard_wrap" class="mt-3" style="{{ $sizeType==='dimensions' ? 'display:none;' : '' }}">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <strong>{{ __('messages.standard_sizes') ?? 'Standard Sizes' }}</strong>
    <button type="button" class="btn btn-sm btn-outline-primary" id="add_standard_row">
      + {{ __('messages.add_size') ?? 'Add size' }}
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th style="width:180px;">{{ __('messages.size') ?? 'Size' }}</th>
      
          <th style="width:60px;"></th>
        </tr>
      </thead>
      <tbody id="standard_body">
        @foreach($variantsData as $i => $v)
          @if(($v['type'] ?? $sizeType) === 'standard' && !empty($v['size_code']))
            <tr class="standard-row">
              <td>
                <select name="variants[{{ $loop->index }}][size_code]" class="form-control">
                  @foreach($standardOptions as $opt)
                    <option value="{{ $opt }}" @selected(($v['size_code'] ?? '') == $opt)>{{ $opt }}</option>
                  @endforeach
                </select>
              </td>
             
              <td class="text-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-row">×</button>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Dimensions --}}
<div id="dimensions_wrap" class="mt-3" style="{{ $sizeType==='standard' ? 'display:none;' : '' }}">
  <strong class="d-block mb-2">{{ __('messages.dimensions_size') ?? 'Dimensions Size' }}</strong>

  @php
    // خد أول صف dimensions فقط
    $dim = collect($variantsData)->first(fn($x) => (($x['type'] ?? $sizeType) === 'dimensions')) ?? $variantsData[0];
  @endphp

  <div class="row">
    <div class="col-md-3">
      <label class="form-label">{{ __('messages.length') ?? 'Length' }}</label>
      <input type="number" step="0.01" min="0" name="variants[0][length]" class="form-control"
             value="{{ $dim['length'] ?? '' }}">
    </div>

    <div class="col-md-3">
      <label class="form-label">{{ __('messages.width') ?? 'Width' }}</label>
      <input type="number" step="0.01" min="0" name="variants[0][width]" class="form-control"
             value="{{ $dim['width'] ?? '' }}">
    </div>

    <div class="col-md-3">
      <label class="form-label">{{ __('messages.height') ?? 'Height' }}</label>
      <input type="number" step="0.01" min="0" name="variants[0][height]" class="form-control"
             value="{{ $dim['height'] ?? '' }}">
    </div>

    <div class="col-md-3">
      <label class="form-label">{{ __('messages.unit') ?? 'Unit' }}</label>
      <select name="variants[0][unit]" class="form-control">
        @php $unit = $dim['unit'] ?? 'cm'; @endphp
        <option value="cm" @selected($unit==='cm')>cm</option>
        <option value="mm" @selected($unit==='mm')>mm</option>
        <option value="m"  @selected($unit==='m')>m</option>
      </select>
    </div>
  </div>

 
</div>
        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  // ===== Positions Sync =====
  const none = document.getElementById('p_none');
  const items = document.querySelectorAll('.pos-item');

  function syncPositions(){
    if(!none) return;
    if(none.checked){
      items.forEach(i => i.checked = false);
    }
  }

  if(none){
    none.addEventListener('change', syncPositions);
    items.forEach(i => i.addEventListener('change', function(){
      if(this.checked) none.checked = false;
    }));
    syncPositions();
  }

  // ===== Sizes Toggle + Repeater =====
  const sizeType = document.getElementById('size_type');
  const standardWrap = document.getElementById('standard_wrap');
  const dimensionsWrap = document.getElementById('dimensions_wrap');
  const standardBody = document.getElementById('standard_body');
  const addBtn = document.getElementById('add_standard_row');

  // لو العناصر مش موجودة، اخرج بدون errors
  if(!sizeType || !standardWrap || !dimensionsWrap) return;

  function toggleSizeUI(){
    const val = sizeType.value;
    if(val === 'dimensions'){
      standardWrap.style.display = 'none';
      dimensionsWrap.style.display = 'block';
    }else{
      dimensionsWrap.style.display = 'none';
      standardWrap.style.display = 'block';
    }
  }

  function nextIndex(){
    if(!standardBody) return 0;
    let max = -1;
    standardBody.querySelectorAll('[name^="variants["]').forEach(el => {
      const m = el.name.match(/^variants\[(\d+)\]/);
      if(m) max = Math.max(max, parseInt(m[1],10));
    });
    return max + 1;
  }

  function buildRow(idx){
    return `
      <tr class="standard-row">
        <td>
          <select name="variants[${idx}][size_code]" class="form-control">
            <option value="XS">XS</option>
            <option value="S" selected>S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
            <option value="XXXL">XXXL</option>
          </select>
        </td>
          <td class="text-end">
          <button type="button" class="btn btn-sm btn-outline-danger remove-row">×</button>
        </td>
      </tr>
    `;
  }

  if(addBtn && standardBody){
    addBtn.addEventListener('click', function(){
      const idx = nextIndex();
      standardBody.insertAdjacentHTML('beforeend', buildRow(idx));
    });
  }

  document.addEventListener('click', function(e){
    const btn = e.target.closest('.remove-row');
    if(btn){
      const tr = btn.closest('tr');
      if(tr) tr.remove();
    }
  });

  sizeType.addEventListener('change', toggleSizeUI);
  toggleSizeUI();
});
</script>
@endpush
