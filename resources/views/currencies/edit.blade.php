@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">Edit Currency</h5>
        <a href="{{ route('admin.currencies.index') }}" class="btn bg-gradient-primary btn-sm mb-0">All Currencies</a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">
      <form action="{{ route('admin.currencies.update', $currency->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('currencies._form', ['currency' => $currency])
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-0">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
