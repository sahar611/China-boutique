@extends('front.layouts.main_layout')

@section('content')
<section class="container py-4 dir-rtl">
    <div id="print-area" class="card p-4">

        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <div class="badge bg-success">{{ strtoupper($order->payment_status) }}</div>
                <div class="mt-2">
                    <div><strong>{{ __('home.order_number') }}:</strong> {{ $order->code }}</div>
                    <div><strong>{{ __('home.order_date') }}:</strong> {{ optional($order->placed_at)->format('Y-m-d h:i A') }}</div>
                </div>
            </div>
 <div>
       
        <img  style="max-height:80px;" src="{{asset('frontend/'.App::getLocale().'/assets/images/logo.png')}}" alt="Logo">
    </div>
            <div class="text-end">
                <div style="font-weight:700;font-size:18px;">{{ config('app.name') }}</div>
                <div>{{ $email}}</div>
                <div>{{ $phone }}</div>
            </div>
        </div>

        <hr>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <h6 class="mb-2">{{ __('home.customer_details') }}</h6>
                <div><strong>{{ __('home.name') }}:</strong> {{ $order->customer_name }}</div>
                <div><strong>{{ __('home.email') }}:</strong> {{ $order->customer_email }}</div>
                <div><strong>{{ __('home.phone') }}:</strong> {{ $order->customer_phone }}</div>
                <div><strong>{{ __('home.address') }}:</strong> {{ $order->shipping_address }}</div>
            </div>

            <div class="col-md-6">
                <h6 class="mb-2">{{ __('home.payment_details') }}</h6>
                <div><strong>{{ __('home.payment_method') }}:</strong> {{ $order->payment_method }}</div>
                <div><strong>{{ __('home.payment_status') }}:</strong> {{ $order->payment_status }}</div>

                @if($order->bank_receipt)
                    <div class="mt-2">
                        <strong>{{ __('home.bank_receipt') }}:</strong>
                        <a href="{{ asset('storage/'.$order->bank_receipt) }}" target="_blank">
                            {{ __('home.view_receipt') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <hr>

        <h6 class="mb-2">{{ __('home.items') }}</h6>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>{{ __('home.product') }}</th>
                        <th>{{ __('home.qty') }}</th>
                        <th>{{ __('home.price') }}</th>
                        <th>{{ __('home.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        @php
                            $unit = (float)($item->unit_sale_price ?? 0);
                            $unit = ($unit > 0 && $unit < (float)$item->unit_price) ? $unit : (float)$item->unit_price;
                        @endphp
                        <tr>
                            <td>
                                {{ $item->product_name }}
                                @if(!empty($item->product_variant_id))
                                    <div class="text-muted" style="font-size:12px;">
                                        #{{ $item->product_variant_id }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($unit, 2) }} {{ $order->currency_code }}</td>
                            <td>{{ number_format($item->line_total, 2) }} {{ $order->currency_code }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        <div class="d-flex justify-content-end">
            <div style="min-width:320px;">
                <div class="d-flex justify-content-between">
                    <span>{{ __('home.subtotal') }}</span>
                    <strong>{{ number_format($order->subtotal, 2) }} {{ $order->currency_code }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>{{ __('home.shipping') }}</span>
                    <strong>{{ number_format($order->shipping, 2) }} {{ $order->currency_code }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>{{ __('home.discount') }}</span>
                    <strong>{{ number_format($order->discount, 2) }} {{ $order->currency_code }}</strong>
                </div>
                <div class="d-flex justify-content-between mt-2" style="font-size:18px;">
                    <span>{{ __('home.grand_total') }}</span>
                    <strong>{{ number_format($order->total, 2) }} {{ $order->currency_code }}</strong>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <button type="button" class="btn btn-outline-dark no-print" onclick="window.print()">
    {{ __('home.print') }}
</button>


            <!-- <a class="btn btn-dark" href="{{ route('order.receipt.pdf', $order->code) }}">
                {{ __('home.download_pdf') }}
            </a> -->
        </div>
    </div>
</section>
@endsection
@push('styles')
<style>
/* ===== Print styles ===== */
@media print {

    
    header, footer, nav,
    .site-header, .site-footer,
    .header-area, .footer-area,
    .mobile-menu, .offcanvas, .pesco-header,
    .breadcrumb, .page-banner, .newsletter, .whatsapp-float,
    .btn, .no-print {
        display: none !important;
    }

  
    body * {
        visibility: hidden !important;
    }

    #print-area, #print-area * {
        visibility: visible !important;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
    }

  
    @page {
        size: A4;
        margin: 12mm;
    }
}
</style>
@endpush
