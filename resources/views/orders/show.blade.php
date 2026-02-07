@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card mb-4">
    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
      <h5 class="mb-0">{{ __('messages.order_details') }} #{{ $order->code }}</h5>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-sm bg-gradient-secondary">
        {{ __('messages.back') }}
      </a>
      <a href="{{ route('admin.orders.pdf', $order) }}" class="btn btn-sm bg-gradient-danger">
  <i class="fas fa-file-pdf"></i> {{ __('messages.export_pdf') }}
</a>

    </div>

    <div class="card-body pt-3">
      <div class="row">
        <div class="col-lg-6 mb-3">
          <h6 class="mb-2">{{ __('messages.customer_information') }}</h6>
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong>{{ __('messages.customer') }}:</strong> {{ $order->customer_name }}</p>
            <p class="mb-1"><strong>{{ __('messages.email') }}:</strong> {{ $order->customer_email }}</p>
            <p class="mb-1"><strong>{{ __('messages.phone') }}:</strong> {{ $order->customer_phone ?? '-' }}</p>
            <p class="mb-0"><strong>{{ __('messages.address') }}:</strong> {{ $order->shipping_address ?? '-' }}</p>
          </div>
        </div>

        <div class="col-lg-6 mb-3">
          <h6 class="mb-2">{{ __('messages.order_information') }}</h6>
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong>{{ __('messages.status') }}:</strong> {{ $order->status }}</p>
            <p class="mb-1"><strong>{{ __('messages.payment_method') }}:</strong> {{ $order->payment_method }}</p>
            <p class="mb-1"><strong>{{ __('messages.payment_status') }}:</strong> {{ $order->payment_status }}</p>
            <p class="mb-0"><strong>{{ __('messages.date') }}:</strong> {{ optional($order->placed_at)->format('Y-m-d H:i') }}</p>
          </div>

          @if($order->payment_method === 'bank' && $order->bank_receipt)
            <div class="mt-3">
              <h6 class="mb-2">{{ __('messages.bank_receipt') }}</h6>
              <a href="{{ asset('storage/'.$order->bank_receipt) }}" target="_blank">
                <img src="{{ asset('storage/'.$order->bank_receipt) }}" class="img-fluid rounded border" style="max-height:240px;">
              </a>
            </div>
          @endif
        </div>
      </div>

      <hr>

      <h6 class="mb-2">{{ __('messages.items') }}</h6>
      <div class="table-responsive">
        <table class="table align-items-center">
          <thead>
            <tr>
              <th>{{ __('messages.product') }}</th>
              <th>{{ __('messages.qty') }}</th>
              <th>{{ __('messages.unit_price') }}</th>
              <th>{{ __('messages.total') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->items as $item)
              <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->unit_sale_price && $item->unit_sale_price > 0 ? $item->unit_sale_price : $item->unit_price, 2) }}</td>
                <td>{{ number_format($item->line_total, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="row mt-3">
        <div class="col-lg-4 ms-auto">
          <div class="border rounded p-3 bg-white">
            <p class="mb-1"><strong>{{ __('messages.subtotal') }}:</strong> {{ number_format($order->subtotal,2) }} {{ $order->currency_code }}</p>
            <p class="mb-1"><strong>{{ __('messages.shipping') }}:</strong> {{ number_format($order->shipping,2) }} {{ $order->currency_code }}</p>
            <p class="mb-1"><strong>{{ __('messages.discount') }}:</strong> {{ number_format($order->discount,2) }} {{ $order->currency_code }}</p>
            <p class="mb-0"><strong>{{ __('messages.total') }}:</strong> {{ number_format($order->total,2) }} {{ $order->currency_code }}</p>
          </div>
        </div>
      </div>

      <hr>

      <h6 class="mb-2">{{ __('messages.update_status') }}</h6>
      <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="row g-2">
        @csrf
        @method('PATCH')

        <div class="col-md-4">
          <label class="form-label">{{ __('messages.status') }}</label>
          <select name="status" class="form-control">
            @foreach(['new','processing','shipped','completed','cancelled'] as $st)
              <option value="{{ $st }}" @selected($order->status===$st)>{{ __('messages.order_status_'.$st) }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">{{ __('messages.payment_status') }}</label>
          <select name="payment_status" class="form-control">
            @foreach(['pending','paid','failed'] as $ps)
              <option value="{{ $ps }}" @selected($order->payment_status===$ps)>{{ __('messages.payment_status_'.$ps) }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
          <button class="btn bg-gradient-primary w-100">{{ __('messages.save') }}</button>
        </div>
      </form>

    </div>
  </div>

</div>
@endsection
