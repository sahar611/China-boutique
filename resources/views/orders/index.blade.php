
@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0"> <h5>{{ __('messages.orders') }}</h5></h5>
               <div class="d-flex gap-2 mb-3">
  <a class="btn btn-sm bg-gradient-success" href="{{ route('admin.orders.export') }}">
    {{ __('messages.export_excel') }}
  </a>
</div>

            </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
            <div class="card-body px-0 pt-0 pb-2">
                <div class="p-3">
  {{-- Filters --}}
 <form class="row g-2 mb-3" method="GET">
  <div class="col-md-2">
    <input class="form-control" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search') }}">
  </div>

  <div class="col-md-2">
    <select class="form-control" name="status">
      <option value="">{{ __('messages.all_status') }}</option>
      @foreach(['new','processing','shipped','completed','cancelled'] as $st)
        <option value="{{ $st }}" @selected(request('status')===$st)>{{ __('messages.order_status_'.$st) }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-2">
    <select class="form-control" name="payment_method">
      <option value="">{{ __('messages.all_payment_methods') }}</option>
      <option value="bank" @selected(request('payment_method')==='bank')>{{ __('messages.payment_method_bank') }}</option>
      <option value="online" @selected(request('payment_method')==='online')>{{ __('messages.payment_method_online') }}</option>
    </select>
  </div>

  <div class="col-md-2">
    <select class="form-control" name="payment_status">
      <option value="">{{ __('messages.all_payment_status') }}</option>
      <option value="pending" @selected(request('payment_status')==='pending')>{{ __('messages.payment_status_pending') }}</option>
      <option value="paid" @selected(request('payment_status')==='paid')>{{ __('messages.payment_status_paid') }}</option>
      <option value="failed" @selected(request('payment_status')==='failed')>{{ __('messages.payment_status_failed') }}</option>
    </select>
  </div>

  <div class="col-md-2">
    <input type="date" class="form-control" name="from" value="{{ request('from') }}">
  </div>

  <div class="col-md-2">
    <input type="date" class="form-control" name="to" value="{{ request('to') }}">
  </div>

  <div class="col-md-12 d-flex gap-2 mt-2">
    <button class="btn bg-gradient-primary">{{ __('messages.filter') }}</button>
    <a href="{{ route('admin.orders.index') }}" class="btn bg-gradient-secondary">{{ __('messages.reset') }}</a>
  </div>
</form>


  {{-- Divider --}}
  <hr class="my-4">



</div>
                <div class="table-responsive p-3">
              
    <table class="table align-items-center">
      <thead>
        <tr>
          <th>#</th>
          <th>{{ __('messages.order_code') }}</th>
          <th>{{ __('messages.customer') }}</th>
          <th>{{ __('messages.total') }}</th>
          <th>{{ __('messages.payment') }}</th>
          <th>{{ __('messages.status') }}</th>
          <th>{{ __('messages.date') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->code }}</td>
          <td>{{ $order->customer_name }}</td>
          <td>{{ $order->total }} {{ $order->currency_code }}</td>
          <td>{{ ucfirst($order->payment_method) }}</td>
          <td>
            <span class="badge bg-info">{{ $order->status }}</span>
          </td>
          <td>{{ optional($order->placed_at)->format('Y-m-d') }}</td>
          <td>
            <a href="{{ route('admin.orders.show',$order) }}" class="btn btn-sm btn-primary">
              {{ __('messages.view') }}
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  

                    <div class="mt-3">
                          {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
