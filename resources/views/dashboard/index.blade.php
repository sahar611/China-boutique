@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0">{{ __('messages.Dashboard') }}</h4>
      <small class="text-muted">{{ __('messages.dashboard_subtitle') }}</small>
    </div>
  </div>

  {{-- Counters --}}
  <div class="row g-3">

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.total_products') }}</div>
          <h4 class="mb-0">{{ $totalProducts }}</h4>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.active_products') }}</div>
          <h4 class="mb-0">{{ $activeProducts }}</h4>
          <small class="text-muted">{{ __('messages.inactive_products') }}: {{ $inactiveProducts }}</small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 border border-warning">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.low_stock') }}</div>
          <h4 class="mb-0">{{ $lowStock }}</h4>
          <small class="text-muted">{{ __('messages.threshold') }}: {{ $lowStockThreshold }}</small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 border border-danger">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.out_of_stock') }}</div>
          <h4 class="mb-0">{{ $outOfStock }}</h4>
          <small class="text-muted">{{ __('messages.track_stock_only') }}</small>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.categories') }}</div>
          <h4 class="mb-0">{{ $totalCategories }}</h4>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="text-muted mb-1">{{ __('messages.brands') }}</div>
          <h4 class="mb-0">{{ $totalBrands }}</h4>
        </div>
      </div>
    </div>

  </div>

  {{-- Tables --}}
  <div class="row g-3 mt-1">

    {{-- Latest products --}}
    <div class="col-12 col-lg-6">
      <div class="card h-100">
        <div class="card-header pb-0 d-flex align-items-center justify-content-between">
          <h6 class="mb-0">{{ __('messages.latest_products') }}</h6>
          @can('products.view')
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
              {{ __('messages.view_all') }}
            </a>
          @endcan
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>{{ __('messages.name') }}</th>
                  <th>{{ __('messages.stock') }}</th>
                  <th>{{ __('messages.status') }}</th>
                  <th class="text-end">{{ __('messages.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse($latestProducts as $p)
                  <tr>
                    <td>
                      <strong>{{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}</strong>
                      @if($p->sku)
                        <div class="text-muted small">SKU: {{ $p->sku }}</div>
                      @endif
                    </td>
                    <td>{{ $p->stock }}</td>
                    <td>
                      @if($p->is_active)
                        <span class="badge bg-success">{{ __('messages.status_active') }}</span>
                      @else
                        <span class="badge bg-secondary">{{ __('messages.status_inactive') }}</span>
                      @endif
                    </td>
                    <td class="text-end">
                      @can('products.view')
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.products.show', $p->id) }}">
                          {{ __('messages.view') }}
                        </a>
                      @endcan
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center text-muted p-3">{{ __('messages.no_data') }}</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- Alerts --}}
    <div class="col-12 col-lg-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6 class="mb-0">{{ __('messages.inventory_alerts') }}</h6>
        </div>
        <div class="card-body">

          <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <strong>{{ __('messages.out_of_stock') }}</strong>
              <span class="badge bg-danger">{{ $outOfStock }}</span>
            </div>
            <div class="table-responsive mt-2">
              <table class="table mb-0">
                <tbody>
                  @forelse($outOfStockProducts as $p)
                    <tr>
                      <td>{{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}</td>
                      <td class="text-end">
                        @can('products.stock_edit')
                          <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.products.stock.edit', $p->id) }}">
                            {{ __('messages.stock') }}
                          </a>
                        @endcan
                      </td>
                    </tr>
                  @empty
                    <tr><td class="text-muted">{{ __('messages.no_data') }}</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <hr>

          <div>
            <div class="d-flex align-items-center justify-content-between">
              <strong>{{ __('messages.low_stock') }}</strong>
              <span class="badge bg-warning text-dark">{{ $lowStock }}</span>
            </div>
            <small class="text-muted">{{ __('messages.threshold') }}: {{ $lowStockThreshold }}</small>

            <div class="table-responsive mt-2">
              <table class="table mb-0">
                <tbody>
                  @forelse($lowStockProducts as $p)
                    <tr>
                      <td>
                        {{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}
                        <span class="badge bg-light text-dark ms-2">{{ $p->stock }}</span>
                      </td>
                      <td class="text-end">
                        @can('products.stock_edit')
                          <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.products.stock.edit', $p->id) }}">
                            {{ __('messages.stock') }}
                          </a>
                        @endcan
                      </td>
                    </tr>
                  @empty
                    <tr><td class="text-muted">{{ __('messages.no_data') }}</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>

</div>
@endsection
