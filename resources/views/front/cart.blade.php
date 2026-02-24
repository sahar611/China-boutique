@extends('front.layouts.main_layout')

@section('content')
<main class="main-bg">
    <!--====== Start Page Banner Section ======-->
    <section class="page-banner dir-rtl">
        <div class="page-banner-wrapper p-r z-1">
            <svg class="lineanm" viewBox="0 0 1920 347" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="line"
                    d="M-39 345.187C70 308.353 397.628 293.477 436 145.186C490 -63.5 572 -57.8156 688 255.186C757.071 441.559 989.5 -121.315 1389 98.6856C1708.6 274.686 1940.33 156.519 1964.5 98.6856"
                    stroke="white" stroke-width="3" stroke-dasharray="2 2" />
            </svg>
            <div class="page-image"><img
                    src="{{asset('frontend/'.App::getLocale().'/assets/images/bg/page-img-1.png')}}" alt="image"></div>
            <svg class="page-svg" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21.1742 33.0065C14.029 35.2507 7.5486 39.0636 0 40.7339V86H1937V64.9942C1933.1 60.1623 1912.65 65.1777 1904.51 62.6581C1894.22 59.4678 1884.93 55.0079 1873.77 52.7742C1861.2 50.2585 1823.41 36.3854 1811.99 39.9252C1805.05 42.0727 1796.94 37.6189 1789.36 36.6007C1769.18 33.8879 1747.19 31.1848 1726.71 29.7718C1703.81 28.1919 1678.28 27.0012 1657.53 34.4442C1636.45 42.005 1606.07 60.856 1579.5 55.9191C1561.6 52.5906 1543.41 47.0959 1528.45 56.9075C1510.85 68.4592 1485.74 74.2518 1460.44 76.136C1432.32 78.2297 1408.53 70.6879 1384.73 62.2987C1339.52 46.361 1298.19 27.1677 1255.08 9.28534C1242.58 4.10111 1214.68 15.4762 1200.55 16.6533C1189.77 17.5509 1181.74 15.4508 1172.12 12.8795C1152.74 7.70033 1133.23 2.88525 1111.79 2.63621C1088.85 2.36971 1073.94 7.88289 1056.53 15.8446C1040.01 23.3996 1027.48 26.1777 1007.8 26.1777C993.757 26.1777 975.854 25.6887 962.844 28.9632C941.935 34.2258 932.059 38.7874 914.839 28.6037C901.654 20.8061 866.261 -2.56499 844.356 7.12886C831.264 12.9222 820.932 21.5146 807.663 27.5255C798.74 31.5679 779.299 42.0561 766.33 39.1166C758.156 37.2637 751.815 31.6349 745.591 28.2443C730.967 20.2774 715.218 13.2948 695.846 10.723C676.168 8.11038 658.554 23.1787 641.606 27.4357C617.564 33.4742 602.283 27.7951 579.244 27.7951C568.142 27.7951 548.414 30.4002 541.681 23.6618C535.297 17.2722 530.162 9.74921 523.263 3.71444C517.855 -1.01577 505.798 -0.852017 498.318 2.09709C479.032 9.7007 453.07 10.0516 431.025 9.64475C407.556 9.21163 368.679 1.61612 346.618 10.3636C319.648 21.0575 291.717 53.8338 254.67 45.2266C236.134 40.9201 225.134 37.5813 204.78 40.7339C186.008 43.6415 171.665 50.7785 156.051 57.3567C146.567 61.3523 152.335 52.6281 151.12 47.9222C149.535 41.7853 139.994 34.5585 132.991 30.4008C120.206 22.8098 90.2848 24.3246 74.2546 24.6502C55.5552 25.0301 37.9201 27.747 21.1742 33.0065Z"
                    fill="#FFFAF3" />
            </svg>

            <div class="shape shape-three"><span><img
                        src="{{asset('frontend/'.App::getLocale().'/assets/images/shape/curved-arrow.png')}}"
                        alt=""></span>
            </div>
            <div class="shape shape-four"><span><img
                        src="{{asset('frontend/'.App::getLocale().'/assets/images/shape/stars.png')}}" alt=""></span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-banner-content">
                            <h1> {{ __('home.cart') }}</h1>
                            <ul class="breadcrumb-link">
                                <li><a href="{{ route('home') }}"> {{ __('home.home') }}</a></li>
                                <li><i class="far fa-long-arrow-right"></i></li>
                                <li class="active"> {{ __('home.cart') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@php
    $itemsCount = $cart->items->sum('qty');

    $rate = (float) ($currentCurrency->rate ?? 1);
    if ($rate <= 0) $rate = 1;

    $subtotal = 0;
    foreach ($cart->items as $item) {
        $unitBase = (float) ($item->unit_sale_price ?? 0);
        $unitBase = ($unitBase > 0 && $unitBase < (float)$item->unit_price)
            ? $unitBase
            : (float)$item->unit_price;

       
        $unit = $unitBase * $rate;

        $subtotal += $unit * (int)$item->qty;
    }

    $total = $subtotal;
@endphp


<!--====== Start Cart Section ======-->
<section class="cart-page-section pt-5 pb-5 {{ app()->getLocale()=='ar' ? 'dir-rtl' : '' }}">
    <div class="container">
        <div class="row">

            <div class="col-xl-8">
                <div class="cart-wrapper mb-40" data-aos="fade-up" data-aos-duration="1200">
                   <h3 class="mb-20">
    {{ app()->getLocale()=='en' ? 'Total Cart Item:' : 'إجمالي عناصر السلة:' }}
    {{ str_pad($itemsCount, 2, '0', STR_PAD_LEFT) }}
</h3>


                    <div class="cart-list table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-tshirt"></i>{{ app()->getLocale()=='en' ? 'Products Details' : 'تفاصيل المنتج' }}</th>
                                    <th><i class="fas fa-sack-dollar"></i>{{ app()->getLocale()=='en' ? 'Price' : 'السعر' }}</th>
                                    <th style="text-align: center;"><i class="fas fa-eye"></i>{{ app()->getLocale()=='en' ? 'Quantity' : 'الكمية' }}</th>
                                    <th style="text-align: right;"><i class="fas fa-money-bill"></i>{{ app()->getLocale()=='en' ? 'Total' : 'الإجمالي' }}</th>
                                </tr>
                            </thead>

                           
                               <tbody>
@forelse($cart->items as $item)
    @php
        $product = $item->product;

      $rate = (float) ($currentCurrency->rate ?? 1);
if ($rate <= 0) $rate = 1;

$unitBase = (float) ($item->unit_sale_price ?? 0);
$unitBase = ($unitBase > 0 && $unitBase < (float)$item->unit_price)
    ? $unitBase
    : (float)$item->unit_price;


$unit = $unitBase * $rate;

$rowTotal = $unit * (int)$item->qty;


        $title = app()->getLocale()=='en'
            ? ($product->name_en ?? $product->name)
            : ($product->name_ar ?? $product->name);

       $image = $product->images->first()
    ? asset($product->images->first()->path)
    : asset('assets/images/products/cart-1.jpg');

           
    @endphp

<tr>
    <td>
        <div class="product-thumb-item">
            <div class="product-img">
                <img src="{{ $image }}" alt="Product Thumbnail">
            </div>
            <div class="product-info">
                <h4 class="title">
                    <a href="{{ route('product.show', $product->slug) }}">
                        {{ $title }}
                    </a>
                    @if($item->variant)
  <div class="small text-muted">
    {{ __('home.size') }}: {{ $item->variant->label() }}
  </div>
@endif

                </h4>
            </div>
        </div>
    </td>

    <td>
        <div class="price">
            <span class="currrency">@if($currentCurrency->code =='SAR')  <img src="{{asset('frontend/saudi-riyal.svg')}}" width="25px"/> @else{{ $currentCurrency->symbol
                                    }}@endif</span>
            {{ number_format($unit, 2) }}
        </div>
    </td>

    <td>
        <div class="action-cart">

            
            <form action="{{ route('cart.qty', $product) }}" method="POST" class="quantity-form">
              
                  @csrf
    @method('PATCH')
                <div class="quantity-input">
                    <button type="button" class="quantity-down"><i class="far fa-minus"></i></button>
                    <input class="quantity" type="text" name="qty" value="{{ $item->qty }}">
                    <button type="button" class="quantity-up"><i class="far fa-plus"></i></button>
                </div>
            </form>

            {{-- حذف --}}
            <form action="{{ route('cart.remove', $product) }}" method="POST">
                @csrf
                <button class="cart-remove" style="border:0;background:none">
                    <i class="far fa-times"></i>
                </button>
            </form>

        </div>
    </td>

    <td>
        <div class="total-price">
            <span class="currrency">@if($currentCurrency->code =='SAR')  <img src="{{asset('frontend/saudi-riyal.svg')}}" width="25px"/> @else{{ $currentCurrency->symbol
                                    }}@endif</span>
            {{ number_format($rowTotal, 2) }}
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">
        {{ app()->getLocale()=='en' ? 'Your cart is empty' : 'سلة المشتريات فارغة' }}
    </td>
</tr>
@endforelse
</tbody>

                          

                        </table>
                    </div>

                    <div class="cart-bottom d-flex align-items-center justify-content-between mt-40">
                        <div class="ct-shopping">
                            <a href="{{ route('home') }}" class="theme-btn style-one">
                                {{ app()->getLocale()=='en' ? 'Continue Shopping' : 'متابعة التسوق' }}
                            </a>
                        </div>

                        <div class="cl-cart">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="theme-btn style-one">
                                    {{ app()->getLocale()=='en' ? 'Clear Cart' : 'تفريغ السلة' }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-4">
                <!--=== Cart Sidebar Area  ===-->
                <div class="cart-sidebar-area">

                    <!--=== Coupon Widget  ===-->
                    <div class="cart-widget coupon-box-widget mb-40" data-aos="fade-up" data-aos-duration="1200">
                        <h4>{{ app()->getLocale()=='en' ? 'Use Coupon Code' : 'استخدم كود الخصم' }}</h4>
                        <p>{{ app()->getLocale()=='en' ? 'Enter your coupon code if you have one.' : 'اكتب كود الخصم إن وجد.' }}</p>

                      
                        <form action="#" method="POST">
                            <input type="text" class="form_control" required>
                            <button class="thme-btn style-one">{{ app()->getLocale()=='en' ? 'Apply' : 'تطبيق' }}</button>
                        </form>
                    </div>

                    <!--=== Totals Widget  ===-->
                    <div class="cart-widget cart-total-widget mb-40" data-aos="fade-up" data-aos-duration="1400">
                        <h4>{{ app()->getLocale()=='en' ? 'Cart Totals' : 'إجمالي السلة' }}</h4>

                      <div class="sub-total">
    <h5>
        {{ app()->getLocale()=='en' ? 'Subtotal' : 'الإجمالي الفرعي' }}
        <span class="price">@if($currentCurrency->code =='SAR')  <img src="{{asset('frontend/saudi-riyal.svg')}}" width="25px"/> @else{{ $currentCurrency->symbol
                                    }}@endif
                                    {{ number_format($subtotal, 2) }}</span>
    </h5>
</div>



                        <!-- <div class="shipping-cart">
                            <h4>{{ app()->getLocale()=='en' ? 'Shipping' : 'الشحن' }}</h4>

                            <div class="single-radio">
                                <input class="form-check-input" type="radio" name="radio" checked value="free" id="radio1">
                                <label class="form-check-label" for="radio1">
                                    {{ app()->getLocale()=='en' ? 'Free Delivery' : 'شحن مجاني' }}
                                    <span class="price">$0.00</span>
                                </label>
                            </div>

                            <div class="single-radio">
                                <input class="form-check-input" type="radio" name="radio" value="flat" id="radio2">
                                <label class="form-check-label" for="radio2">
                                    {{ app()->getLocale()=='en' ? 'Flat Rate' : 'سعر ثابت' }}
                                    <span class="price">$0.00</span>
                                </label>
                            </div>

                            <div class="single-radio">
                                <input class="form-check-input" type="radio" name="radio" value="local" id="radio3">
                                <label class="form-check-label" for="radio3">
                                    {{ app()->getLocale()=='en' ? 'Local Area' : 'داخل المدينة' }}
                                    <span class="price">$0.00</span>
                                </label>
                            </div>
                        </div> -->

                        @php $total = $subtotal; @endphp
                       
<div class="price-total">
    <h5>
        {{ app()->getLocale()=='en' ? 'Total' : 'الإجمالي' }}
        <span class="price">@if($currentCurrency->code =='SAR')  <img src="{{asset('frontend/saudi-riyal.svg')}}" width="25px"/> @else{{ $currentCurrency->symbol
                                    }}@endif {{ number_format($total, 2) }}</span>
    </h5>
</div>

                        <div class="proceced-checkout">
     @guest('web')
    <a href="{{ route('customer.login') }}" class="theme-btn style-one">
      {{ app()->getLocale()=='en' ? 'Login to checkout' : 'سجل الدخول لإتمام الشراء' }}
    </a>
  @else
    <button class="theme-btn style-one"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
            {{ $itemsCount == 0 ? 'disabled' : '' }}>
      {{ app()->getLocale()=='en' ? 'Proceed to checkout' : 'إتمام الشراء' }}
    </button>
  @endguest
</div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== End Cart Section ======-->

<div class="modal fade {{ app()->getLocale()=='ar' ? 'dir-rtl' : '' }} modal-pp"
     id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form id="checkoutForm" action="{{ route('checkout.place') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="payment_method" id="payment_method" value="bank">

        @auth
        
          <input type="hidden" name="shipping_address" value="{{ auth('web')->user()->address }}">
          <input type="hidden" name="customer_phone" value="{{ auth('web')->user()->phone }}">
        @endauth

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            {{ app()->getLocale()=='en' ? 'Choose payment method' : 'اختر طريقة الدفع' }}
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label font-sss">
              {{ app()->getLocale()=='en' ? 'Payment type:' : 'اختر نوع الدفع:' }}
            </label>

            <div class="inbut-c">
              <input type="radio" id="bankTransfer" name="paymentType" value="bank" checked>
              <label for="bankTransfer">{{ app()->getLocale()=='en' ? 'Bank Transfer' : 'تحويل بنكي' }}</label>
            </div>

            <div class="inbut-c">
              <input type="radio" id="onlinePayment" name="paymentType" value="online">
              <label for="onlinePayment">{{ app()->getLocale()=='en' ? 'Online Payment' : 'دفع اون لاين' }}</label>
            </div>
          </div>

          <div class="mb-3" id="receiptUpload" style="display:block;">
            <label for="receiptImage" class="form-label">
              {{ app()->getLocale()=='en' ? 'Upload bank receipt:' : 'ارفع صورة الايصال البنكي:' }}
            </label>

            <input class="form-control" type="file" id="receiptImage" name="bank_receipt" accept="image/*">

            @error('bank_receipt')
              <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="theme-btn style-one btn-sm">
            {{ app()->getLocale()=='en' ? 'Send' : 'إرسال' }}
          </button>
        </div>

      </form>

    </div>
  </div>
</div>




</main>
@endsection
@push('scripts')
<script>
(function () {
  let lock = false;

  function submitOnce(form){
    if(lock) return;
    lock = true;
    form.submit();
    setTimeout(()=> lock = false, 400);
  }

  document.addEventListener('click', function(e){
   
    const btn = e.target.closest('.quantity-up, .quantity-down');
    if(!btn) return;

    const form = btn.closest('.quantity-form');
    if(!form) return;

   
    setTimeout(() => submitOnce(form), 0); 
  });

 
  document.addEventListener('change', function(e){
    const input = e.target.closest('.quantity-form input.quantity');
    if(!input) return;

    const form = input.closest('.quantity-form');
    if(!form) return;

    submitOnce(form);
  });
})();
</script>
<script>
document.addEventListener('change', function(e){
  if(e.target && e.target.name === 'paymentType'){
    const method = e.target.value; // bank | online
    const hidden = document.getElementById('payment_method');
    const receiptBox = document.getElementById('receiptUpload');
    const receiptInput = document.getElementById('receiptImage');

    if (hidden) hidden.value = method;

    if (method === 'bank') {
      if (receiptBox) receiptBox.style.display = 'block';
      if (receiptInput) receiptInput.required = true;
    } else {
      if (receiptBox) receiptBox.style.display = 'none';
      if (receiptInput) {
        receiptInput.required = false;
        receiptInput.value = '';
      }
    }
  }
});

// تهيئة أولية عند فتح الصفحة
document.addEventListener('DOMContentLoaded', function(){
  const checked = document.querySelector('input[name="paymentType"]:checked');
  if (checked) checked.dispatchEvent(new Event('change'));
});
</script>

@endpush