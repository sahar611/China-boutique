@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">{{ __('messages.edit_product') }}</h5>
      <a href="{{ route('admin.products.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.products') }}
      </a>
    </div>

    <div class="card-body">

      @if ($errors->any())
        <div class="alert alert-danger">
          <strong>{{ __('messages.validation_error') }}</strong>
        </div>
      @endif

      <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tabs Nav --}}
        <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-basic-tab" data-bs-toggle="tab" data-bs-target="#tab-basic" type="button" role="tab">
              {{ __('messages.tab_basic') }}
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-classification-tab" data-bs-toggle="tab" data-bs-target="#tab-classification" type="button" role="tab">
              {{ __('messages.tab_classification') }}
            </button>
          </li>

          <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-pricing-tab" data-bs-toggle="tab" data-bs-target="#tab-pricing" type="button" role="tab">
              {{ __('messages.tab_pricing') }}
            </button>
          </li> -->

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-display-tab" data-bs-toggle="tab" data-bs-target="#tab-display" type="button" role="tab">
              {{ __('messages.tab_display') }}
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-media-tab" data-bs-toggle="tab" data-bs-target="#tab-media" type="button" role="tab">
              {{ __('messages.tab_media') }}
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-sizes-tab" data-bs-toggle="tab" data-bs-target="#tab-sizes" type="button" role="tab">
              {{ __('messages.tab_sizes') }}
            </button>
          </li>
        </ul>

        {{-- Tabs Content --}}
        <div class="tab-content" id="productTabsContent">

          {{-- TAB 1: BASIC --}}
          <div class="tab-pane fade show active" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-tab">

            <div class="row">
              <div class="col-md-6">
                <label class="form-label">{{ __('messages.name_en') }}</label>
                <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                       value="{{ old('name_en', $product->name_en) }}">
                @error('name_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label">{{ __('messages.name_ar') }}</label>
                <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                       value="{{ old('name_ar', $product->name_ar) }}">
                @error('name_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-6">
                <label class="form-label">{{ __('messages.description_en') }}</label>
                <textarea name="description_en" rows="5" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en', $product->description_en) }}</textarea>
                @error('description_en') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label">{{ __('messages.description_ar') }}</label>
                <textarea name="description_ar" rows="5" class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar', $product->description_ar) }}</textarea>
                @error('description_ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
               <div class="col-md-6">
                <label class="form-label">{{ __('messages.price') }}</label>
                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $product->price) }}">
                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label">{{ __('messages.sale_price') }}</label>
                <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror"
                       value="{{ old('sale_price', $product->sale_price) }}">
                @error('sale_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>
          </div>

          {{-- TAB 2: CLASSIFICATION --}}
          <div class="tab-pane fade" id="tab-classification" role="tabpanel" aria-labelledby="tab-classification-tab">

            <div class="row">
              <div class="col-md-4">
                <label class="form-label">{{ __('messages.category') }}</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>
                      {{ app()->isLocale('ar') ? $cat->name_ar : $cat->name_en }}
                    </option>
                  @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label">{{ __('messages.brand') }}</label>
                <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                  @foreach($brands as $b)
                    <option value="{{ $b->id }}" @selected(old('brand_id', $product->brand_id) == $b->id)>
                      {{ app()->isLocale('ar') ? $b->name_ar : $b->name_en }}
                    </option>
                  @endforeach
                </select>
                @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label">{{ __('messages.status') }}</label>
                <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                  <option value="1" @selected(old('is_active', $product->is_active) == 1)>{{ __('messages.status_active') }}</option>
                  <option value="0" @selected(old('is_active', $product->is_active) == 0)>{{ __('messages.status_inactive') }}</option>
                </select>
                @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="row mt-3">
              <!-- <div class="col-md-4">
                <label class="form-label">{{ __('messages.sku') }}</label>
                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
                       value="{{ old('sku', $product->sku) }}">
                @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div> -->
            </div>
          </div>

          {{-- TAB 3: PRICING --}}
          <!-- <div class="tab-pane fade" id="tab-pricing" role="tabpanel" aria-labelledby="tab-pricing-tab">
            <div class="row">
             

              <div class="col-md-3">
                <label class="form-label">{{ __('messages.stock') }}</label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                       value="{{ old('stock', $product->stock) }}">
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-3">
                <label class="form-label">{{ __('messages.track_stock') }}</label>
                <select name="track_stock" class="form-control @error('track_stock') is-invalid @enderror">
                  <option value="1" @selected(old('track_stock', $product->track_stock) == 1)>{{ __('messages.yes') }}</option>
                  <option value="0" @selected(old('track_stock', $product->track_stock) == 0)>{{ __('messages.no') }}</option>
                </select>
                @error('track_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
          </div> -->

          {{-- TAB 4: DISPLAY --}}
          <div class="tab-pane fade" id="tab-display" role="tabpanel" aria-labelledby="tab-display-tab">
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">{{ __('messages.show_in_home') }}</label>
                <select name="is_featured" class="form-control @error('is_featured') is-invalid @enderror">
                  <option value="0" @selected(old('is_featured', $product->is_featured ?? 0) == 0)>{{ __('messages.no') }}</option>
                  <option value="1" @selected(old('is_featured', $product->is_featured ?? 0) == 1)>{{ __('messages.yes') }}</option>
                </select>
                @error('is_featured') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label">{{ __('messages.home_sort') }}</label>
                <input type="number" name="home_sort" class="form-control @error('home_sort') is-invalid @enderror"
                       value="{{ old('home_sort', $product->home_sort ?? 0) }}">
                @error('home_sort') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label">{{ __('messages.display_positions') }}</label>

                @php
                  $selectedPositions = old('positions', $product->positions ?? ['none']);
                  if (!is_array($selectedPositions)) $selectedPositions = ['none'];
                @endphp

                <div class="border rounded p-3" style="max-height:220px; overflow:auto;">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="positions[]" value="none" id="p_none"
                           @checked(in_array('none', $selectedPositions))>
                    <label class="form-check-label" for="p_none">{{ __('messages.pos_none') }}</label>
                  </div>

                  <div class="form-check mb-2">
                    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="trending" id="p_trending"
                           @checked(in_array('trending', $selectedPositions))>
                    <label class="form-check-label" for="p_trending">{{ __('messages.pos_trending') }}</label>
                  </div>

                  <div class="form-check mb-2">
                    <input class="form-check-input pos-item" type="checkbox" name="positions[]" value="home_products" id="p_home_products"
                           @checked(in_array('home_products', $selectedPositions))>
                    <label class="form-check-label" for="p_home_products">{{ __('messages.pos_home_products') }}</label>
                  </div>

                  <hr class="my-2">

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

                <small class="text-muted d-block mt-2">{{ __('messages.positions_note') }}</small>
              </div>
            </div>
          </div>

          {{-- TAB 5: MEDIA --}}
          <div class="tab-pane fade" id="tab-media" role="tabpanel" aria-labelledby="tab-media-tab">
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">{{ __('messages.add_images') }}</label>
                <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple>
                @error('images') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

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
                        <form method="POST" action="{{ route('admin.products.images.main', [$product->id, $img->id]) }}" style="display:block;">
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

          {{-- TAB 6: SIZES --}}
          @php
            $sizeType = old('size_type', $product->size_type ?? 'standard');
            $existingVariants = $product->variants ?? collect();
            $oldVariants = old('variants');

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

            if (!$variantsData) {
                $variantsData = $sizeType === 'dimensions'
                  ? [[ 'type'=>'dimensions','length'=>'', 'width'=>'', 'height'=>'', 'unit'=>'cm' ]]
                  : [[ 'type'=>'standard','size_code'=>'S' ]];
            }

            $standardOptions = ['XS','S','M','L','XL','XXL','XXXL'];
          @endphp

          <div class="tab-pane fade" id="tab-sizes" role="tabpanel" aria-labelledby="tab-sizes-tab">
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">{{ __('messages.size_type') }}</label>
                <select name="size_type" id="size_type" class="form-control">
                  <option value="standard" @selected($sizeType==='standard')>{{ __('messages.size_type_standard') }}</option>
                  <option value="dimensions" @selected($sizeType==='dimensions')>{{ __('messages.size_type_dimensions') }}</option>
                </select>
              </div>
            </div>

            {{-- Standard --}}
            <div id="standard_wrap" class="mt-3" style="{{ $sizeType==='dimensions' ? 'display:none;' : '' }}">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>{{ __('messages.standard_sizes') }}</strong>
                <button type="button" class="btn btn-sm btn-outline-primary" id="add_standard_row">
                  + {{ __('messages.add_size') }}
                </button>
              </div>

              <div class="table-responsive">
                <table class="table table-sm align-middle">
                  <thead>
                    <tr>
                      <th style="width:180px;">{{ __('messages.size') }}</th>
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
              <strong class="d-block mb-2">{{ __('messages.dimensions_size') }}</strong>

              @php
                $dim = collect($variantsData)->first(fn($x) => (($x['type'] ?? $sizeType) === 'dimensions')) ?? $variantsData[0];
              @endphp

              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">{{ __('messages.length') }}</label>
                  <input type="number" step="0.01" min="0" name="variants[0][length]" class="form-control"
                         value="{{ old('variants.0.length', $dim['length'] ?? '') }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label">{{ __('messages.width') }}</label>
                  <input type="number" step="0.01" min="0" name="variants[0][width]" class="form-control"
                         value="{{ old('variants.0.width', $dim['width'] ?? '') }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label">{{ __('messages.height') }}</label>
                  <input type="number" step="0.01" min="0" name="variants[0][height]" class="form-control"
                         value="{{ old('variants.0.height', $dim['height'] ?? '') }}">
                </div>

                <div class="col-md-3">
                  <label class="form-label">{{ __('messages.unit') }}</label>
                  @php $unit = old('variants.0.unit', $dim['unit'] ?? 'cm'); @endphp
                  <select name="variants[0][unit]" class="form-control">
                    <option value="cm" @selected($unit==='cm')>cm</option>
                    <option value="mm" @selected($unit==='mm')>mm</option>
                    <option value="m"  @selected($unit==='m')>m</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            {{ __('messages.back') }}
          </a>
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

  // ===== Open correct tab when validation errors happen =====
  const tabErrorMap = [
    { tab: '#tab-basic-tab', fields: ['name_en','name_ar','description_en','description_ar'] },
    { tab: '#tab-classification-tab', fields: ['category_id','brand_id','is_active','sku'] },
    { tab: '#tab-pricing-tab', fields: ['price','sale_price','stock','track_stock'] },
    { tab: '#tab-display-tab', fields: ['is_featured','home_sort','positions'] },
    { tab: '#tab-media-tab', fields: ['images'] },
    { tab: '#tab-sizes-tab', fields: ['size_type','variants'] },
  ];

  const hasError = (name) => document.querySelector(`.is-invalid[name="${name}"], .is-invalid[name^="${name}["]`);

  for(const item of tabErrorMap){
    if(item.fields.some(f => hasError(f))){
      const btn = document.querySelector(item.tab);
      if(btn) btn.click();
      break;
    }
  }

});
</script>
@endpush
