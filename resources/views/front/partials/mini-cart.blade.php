@php
  $items = $cart?->items ?? collect();

  $subtotal = 0;
  foreach ($items as $it) {
    $basePrice = (float)($it->unit_price ?? ($it->product->price ?? 0));
    $baseSale  = (float)($it->unit_sale_price ?? ($it->product->sale_price ?? 0));
    $hasSale   = $baseSale > 0 && $baseSale < $basePrice;
    $finalBase = $hasSale ? $baseSale : $basePrice;

    $subtotal += $finalBase * (int)$it->qty;
  }

  $subtotalView = $subtotal * (float)$rate;

  $itemsCount = $items->sum('qty');
@endphp

<div class="widget-shopping-cart-content" data-items-count="{{ $itemsCount }}">
                    <ul class="pesco-mini-cart-list">
                         @forelse($items as $it)
      @php
        $p = $it->product;
        $name = app()->getLocale()==='ar' ? ($p->name_ar ?? $p->name_en) : ($p->name_en ?? $p->name_ar);

        $imgObj = $p->images->first();
        $img = null;
        if ($imgObj) {
          $imgPath = $imgObj->path ?? $imgObj->image ?? $imgObj->url ?? null;
          $img = $imgPath ? asset($imgPath) : null;
        }
        $img = $img ?: asset('frontend/'.App::getLocale().'/assets/images/products/cart-1.jpg');

        $basePrice = (float)($it->unit_price ?? ($p->price ?? 0));
        $baseSale  = (float)($it->unit_sale_price ?? ($p->sale_price ?? 0));
        $hasSale   = $baseSale > 0 && $baseSale < $basePrice;
        $finalBase = $hasSale ? $baseSale : $basePrice;

        $unit = $finalBase * (float)$rate;
      @endphp
                        <li class="sidebar-cart-item">
                <a href="javascript:void(0)"
           class="remove-cart js-mini-remove"
           data-remove-url="{{ route('cart.mini.remove', $it->id) }}"
           title="{{ __('home.remove') }}">
           <i class="far fa-trash-alt"></i></a>
                            <a href="{{ route('product.show', $p->slug ?? $p->id) }}">
          <img src="{{ $img }}" alt="cart image">
          {{ $name }}sssssssssssss
        </a>
                            <span class="quantity">  {{ (int)$it->qty }} × <span><span class="currency">{{ $symbol }}</span>
            {{ number_format($unit, 2) }}
          </span></span>
                        </li>
                       
                     @empty
      <li class="sidebar-cart-item">
        <span class="text-muted">{{ __('home.cart_empty') }}</span>
      </li>
    @endforelse
                    </ul>
                    <div class="cart-mini-total">
                        <div class="cart-total">
                            <span><strong>{{ __('home.subtotal') }} :</strong></span> <span class="amount">1 × <span><span
                                        class="currency">{{ $symbol }}</span>{{ number_format($subtotalView, 2) }}</span>
                        </div>
                    </div>
                    <div class="cart-button-box">
                        <a href="{{ route('cart.index') }}" class="theme-btn style-one">
      {{ __('home.proceed_to_checkout') }}
    </a>
                    </div>
                </div>

