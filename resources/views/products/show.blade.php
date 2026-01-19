@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0">{{ __('messages.product_details') }}</h5>
        <small class="text-muted">
          {{ app()->isLocale('ar') ? $product->name_ar : $product->name_en }}
        </small>
      </div>

      <div class="d-flex gap-2">

        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
          {{ __('messages.back') }}
        </a>

        @can('products.edit')
          <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
            {{ __('messages.edit') }}
          </a>
        @endcan

        @can('products.create')
          <form method="POST" action="{{ route('admin.products.duplicate', $product->id) }}" style="display:inline-block"
                onsubmit="return confirm('{{ __('messages.confirm_duplicate') }}')">
            @csrf
            <button class="btn btn-dark btn-sm">
              {{ __('messages.duplicate') }}
            </button>
          </form>
        @endcan

      </div>
    </div>

    <div class="card-body">

      <div class="row g-3">

        <div class="col-md-6">
          <div class="border rounded p-3">
            <h6 class="mb-3">{{ __('messages.basic_info') }}</h6>

            <div class="mb-2">
              <strong>{{ __('messages.name_en') }}:</strong>
              <div>{{ $product->name_en ?: '-' }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.name_ar') }}:</strong>
              <div>{{ $product->name_ar ?: '-' }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.slug') }}:</strong>
              <div>{{ $product->slug ?: '-' }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.sku') }}:</strong>
              <div>{{ $product->sku ?: '-' }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.category') }}:</strong>
              <div>
                {{ $product->category ? (app()->isLocale('ar') ? $product->category->name_ar : $product->category->name_en) : '-' }}
              </div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.brand') }}:</strong>
              <div>
                {{ $product->brand ? (app()->isLocale('ar') ? $product->brand->name_ar : $product->brand->name_en) : '-' }}
              </div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.status') }}:</strong>
              <div>
                @if($product->is_active)
                  <span class="badge bg-success">{{ __('messages.status_active') }}</span>
                @else
                  <span class="badge bg-secondary">{{ __('messages.status_inactive') }}</span>
                @endif
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-6">
          <div class="border rounded p-3">
            <h6 class="mb-3">{{ __('messages.pricing_stock') }}</h6>

            <div class="mb-2">
              <strong>{{ __('messages.price') }}:</strong>
              <div>{{ number_format($product->price ?? 0, 2) }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.sale_price') }}:</strong>
              <div>{{ $product->sale_price ? number_format($product->sale_price, 2) : '-' }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.stock') }}:</strong>
              <div>{{ $product->stock ?? 0 }}</div>
            </div>

            <div class="mb-2">
              <strong>{{ __('messages.track_stock') }}:</strong>
              <div>{{ ($product->track_stock ?? 1) ? __('messages.yes') : __('messages.no') }}</div>
            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="border rounded p-3">
            <h6 class="mb-3">{{ __('messages.images') }}</h6>

            @php
              $images = $product->images ?? collect();
              $main = $images->firstWhere('is_main', 1) ?? $images->first();
            @endphp

            <div class="row g-3">
              <div class="col-md-4">
                <div class="border rounded p-2 text-center">
                  <div class="mb-2 text-muted">{{ __('messages.main_image') }}</div>
                  @if($main && $main->path)
                    <img src="{{ asset($main->path) }}" style="max-width:100%; height:auto; border-radius:8px;">
                  @else
                    <div class="text-muted">-</div>
                  @endif
                </div>
              </div>

              <div class="col-md-8">
                <div class="row g-2">
                  @forelse($images as $img)
                    <div class="col-6 col-md-3">
                      <div class="border rounded p-1 text-center">
                        <img src="{{ asset($img->path) }}" style="max-width:100%; height:auto; border-radius:6px;">
                        @if($img->is_main)
                          <div class="mt-1">
                            <span class="badge bg-info">{{ __('messages.main') }}</span>
                          </div>
                        @endif
                      </div>
                    </div>
                  @empty
                    <div class="text-muted">{{ __('messages.no_images') }}</div>
                  @endforelse
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>

</div>
@endsection
