@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">

      <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0">{{ __('messages.products') }}</h5>

        @can('products.create')
        <a href="{{ route('admin.products.create') }}" class="btn bg-gradient-primary btn-sm">
          {{ __('messages.add_product') }}
        </a>
        @endcan
      </div>

      <div class="card-body">

       {{-- Top Controls --}}
<div class="p-3">
  {{-- Filters --}}
  <form method="GET" class="row g-3 align-items-end">

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1">{{ __('messages.search') }}</label>
      <input type="text" name="q" class="form-control" value="{{ request('q') }}"
             placeholder="{{ __('messages.search_placeholder') }}">
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1">{{ __('messages.category') }}</label>
      <select name="category_id" class="form-control">
        <option value="">{{ __('messages.all') }}</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
            {{ app()->isLocale('ar') ? $cat->name_ar : $cat->name_en }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <label class="form-label mb-1">{{ __('messages.brand') }}</label>
      <select name="brand_id" class="form-control">
        <option value="">{{ __('messages.all') }}</option>
        @foreach($brands as $b)
          <option value="{{ $b->id }}" @selected(request('brand_id') == $b->id)>
            {{ app()->isLocale('ar') ? $b->name_ar : $b->name_en }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
      <label class="form-label mb-1">{{ __('messages.status') }}</label>
      <select name="status" class="form-control">
        <option value="">{{ __('messages.all') }}</option>
        <option value="1" @selected(request('status') === '1')>{{ __('messages.status_active') }}</option>
        <option value="0" @selected(request('status') === '0')>{{ __('messages.status_inactive') }}</option>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
      <label class="form-label mb-1">{{ __('messages.stock_filter') }}</label>
      <select name="stock_filter" class="form-control">
        <option value="">{{ __('messages.all') }}</option>
        <option value="out" @selected(request('stock_filter') === 'out')>{{ __('messages.out_of_stock') }}</option>
        <option value="low" @selected(request('stock_filter') === 'low')>{{ __('messages.low_stock') }}</option>
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2 d-flex gap-2">
      <button class="btn bg-gradient-dark w-100">{{ __('messages.filter') }}</button>
      <a class="btn btn-outline-secondary w-100" href="{{ route('admin.products.index') }}">
        {{ __('messages.reset') }}
      </a>
    </div>

  </form>

  {{-- Divider --}}
  <hr class="my-4">

  {{-- Bulk Actions --}}
  @php
    $canBulk = auth()->user()?->can('products.publish')
           || auth()->user()?->can('products.unpublish')
           || auth()->user()?->can('products.delete');
  @endphp

  @if($canBulk)
  <form method="POST" action="{{ route('admin.products.bulk') }}" id="bulkForm" class="row g-3 align-items-end">
    @csrf

    <div class="col-12 col-md-6 col-lg-4">
      <label class="form-label mb-1">{{ __('messages.bulk_action') }}</label>
      <select name="action" class="form-control">
        @can('products.publish')
          <option value="publish">{{ __('messages.publish_selected') }}</option>
        @endcan
        @can('products.unpublish')
          <option value="unpublish">{{ __('messages.unpublish_selected') }}</option>
        @endcan
        @can('products.delete')
          <option value="delete">{{ __('messages.delete_selected') }}</option>
        @endcan
      </select>
    </div>

    <div class="col-12 col-md-4 col-lg-2">
      <button type="submit" class="btn bg-gradient-dark w-100">
        {{ __('messages.apply') }}
      </button>
    </div>

    <div class="col-12 col-lg-6">
      <small class="text-muted">
        {{ __('messages.bulk_hint') }}
      </small>
    </div>
  </form>
  @endif
</div>


        <div class="table-responsive p-3 mt-3">
        <table class="table align-items-center mb-0 table-hover">

            <thead>
              <tr>
                <th style="width:40px;">
                  <input type="checkbox" id="selectAll">
                </th>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.category') }}</th>
                <th>{{ __('messages.brand') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.stock') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th class="text-center">{{ __('messages.actions') }}</th>
              </tr>
            </thead>

            <tbody>
              @forelse($products as $p)
                <tr>
                  <td>
                    <input type="checkbox" value="{{ $p->id }}" class="row-checkbox">
                  </td>

                  <td>{{ $loop->iteration }}</td>

                  <td>
                    {{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}
                    @if($p->sku)
                      <br><small class="text-muted">SKU: {{ $p->sku }}</small>
                    @endif
                  </td>

                  <td>{{ $p->category ? (app()->isLocale('ar') ? $p->category->name_ar : $p->category->name_en) : '-' }}</td>
                  <td>{{ $p->brand ? (app()->isLocale('ar') ? $p->brand->name_ar : $p->brand->name_en) : '-' }}</td>

                  <td>
                    {{ number_format($p->price, 2) }}
                    @if($p->sale_price)
                      <br><small class="text-muted">{{ __('messages.sale_price') }}: {{ number_format($p->sale_price, 2) }}</small>
                    @endif
                  </td>

                  <td>
                    {{ $p->stock }}
                    @if($p->stock == 0)
                      <span class="badge bg-danger ms-1">{{ __('messages.out_of_stock') }}</span>
                    @elseif($p->stock > 0 && $p->stock <= 5)
                      <span class="badge bg-warning ms-1">{{ __('messages.low_stock') }}</span>
                    @endif
                  </td>

                 <td>
  @if($p->is_active)
    <span class="badge bg-success">{{ __('messages.status_active') }}</span>
  @else
    <span class="badge bg-secondary">{{ __('messages.status_inactive') }}</span>
  @endif
</td>


                  <td class="text-center">

                    @can('products.edit')
                      <a class="btn btn-primary btn-sm" href="{{ route('admin.products.edit', $p->id) }}">
                        {{ __('messages.edit') }}
                      </a>
                    @endcan

                    @can('products.price_edit')
                      <a class="btn btn-info btn-sm" href="{{ route('admin.products.price.edit', $p->id) }}">
                        {{ __('messages.price') }}
                      </a>
                    @endcan

                    @can('products.stock_edit')
                      <a class="btn btn-warning btn-sm" href="{{ route('admin.products.stock.edit', $p->id) }}">
                        {{ __('messages.stock') }}
                      </a>
                    @endcan

                    @can('products.publish')
                      @if(!$p->is_active)
                        <form method="POST" action="{{ route('admin.products.publish', $p->id) }}" style="display:inline-block">
                          @csrf
                          @method('PATCH')
                          <button class="btn btn-success btn-sm">{{ __('messages.publish') }}</button>
                        </form>
                      @endif
                    @endcan

                    @can('products.unpublish')
                      @if($p->is_active)
                        <form method="POST" action="{{ route('admin.products.unpublish', $p->id) }}" style="display:inline-block">
                          @csrf
                          @method('PATCH')
                          <button class="btn btn-secondary btn-sm">{{ __('messages.unpublish') }}</button>
                        </form>
                      @endif
                    @endcan

                    @can('products.delete')
                      <form method="POST" action="{{ route('admin.products.destroy', $p->id) }}"
                            style="display:inline-block"
                            onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                      </form>
                    @endcan

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center text-muted p-4">
                    {{ __('messages.no_data') }}
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <div class="mt-3">
            {{ $products->links() }}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  const selectAll = document.getElementById('selectAll');
  const rowCheckboxes = document.querySelectorAll('.row-checkbox');
  const bulkForm = document.getElementById('bulkForm');

  if(selectAll){
    selectAll.addEventListener('change', function(){
      rowCheckboxes.forEach(cb => cb.checked = selectAll.checked);
    });
  }

  if(bulkForm){
    bulkForm.addEventListener('submit', function(e){

      // امسح أي ids قديمة
      bulkForm.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());

      const ids = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);

      if(ids.length === 0){
        e.preventDefault();
        alert("{{ __('messages.select_at_least_one') }}");
        return;
      }

      if(!confirm("{{ __('messages.confirm_bulk') }}")){
        e.preventDefault();
        return;
      }

      ids.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        bulkForm.appendChild(input);
      });
    });
  }

});
</script>
@endpush
