<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <title>{{ __('messages.order_details') }} #{{ $order->code }}</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2,h3 { margin: 0 0 10px; }
    .box { border:1px solid #ddd; padding:10px; border-radius:6px; margin-bottom:12px; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th,td { border:1px solid #000; padding:6px; text-align:left; }
    th { background:#f2f2f2; }
    .right { text-align:right; }
    .muted { color:#666; }
  </style>
</head>
<body>

  <h2>{{ __('messages.order_details') }} #{{ $order->code }}</h2>
  <p class="muted">{{ __('messages.date') }}: {{ optional($order->placed_at ?? $order->created_at)->format('Y-m-d H:i') }}</p>

  <div class="box">
    <h3>{{ __('messages.customer_information') }}</h3>
    <p><strong>{{ __('messages.customer') }}:</strong> {{ $order->customer_name }}</p>
    <p><strong>{{ __('messages.email') }}:</strong> {{ $order->customer_email }}</p>
    <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->customer_phone ?? '-' }}</p>
    <p><strong>{{ __('messages.address') }}:</strong> {{ $order->shipping_address ?? '-' }}</p>
  </div>

  <div class="box">
    <h3>{{ __('messages.order_information') }}</h3>
    <p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.order_status_'.$order->status) }}</p>
    <p><strong>{{ __('messages.payment_method') }}:</strong> {{ __('messages.payment_method_'.$order->payment_method) }}</p>
    <p><strong>{{ __('messages.payment_status') }}:</strong> {{ __('messages.payment_status_'.$order->payment_status) }}</p>
  </div>

  <h3>{{ __('messages.items') }}</h3>

  <table>
    <thead>
      <tr>
        <th>{{ __('messages.product') }}</th>
        <th class="right">{{ __('messages.qty') }}</th>
        <th class="right">{{ __('messages.unit_price') }}</th>
        <th class="right">{{ __('messages.total') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $item)
        @php
          $unit = ($item->unit_sale_price && $item->unit_sale_price > 0) ? $item->unit_sale_price : $item->unit_price;
        @endphp
        <tr>
          <td>{{ $item->product_name }}</td>
          <td class="right">{{ $item->qty }}</td>
          <td class="right">{{ number_format($unit, 2) }}</td>
          <td class="right">{{ number_format($item->line_total, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="box" style="margin-top:12px;">
    <p class="right"><strong>{{ __('messages.subtotal') }}:</strong> {{ number_format($order->subtotal, 2) }} {{ $order->currency_code }}</p>
    <p class="right"><strong>{{ __('messages.shipping') }}:</strong> {{ number_format($order->shipping, 2) }} {{ $order->currency_code }}</p>
    <p class="right"><strong>{{ __('messages.discount') }}:</strong> {{ number_format($order->discount, 2) }} {{ $order->currency_code }}</p>
    <p class="right" style="font-size:13px;"><strong>{{ __('messages.total') }}:</strong> {{ number_format($order->total, 2) }} {{ $order->currency_code }}</p>
  </div>

</body>
</html>
