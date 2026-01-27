@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.add_brand') }}</h5>
      <a href="{{ route('admin.brands.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.brands') }}
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.logo') }}</label>
            <input type="file" name="logo" class="form-control">
            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.sort_order') }}</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
            @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-3">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1" @selected(old('is_active','1')=='1')>{{ __('messages.status_active') }}</option>
              <option value="0" @selected(old('is_active')=='0')>{{ __('messages.status_inactive') }}</option>
            </select>
            @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        {{-- Home Controls --}}
        <div class="row mt-4">
          <div class="col-md-6">
            <label>{{ __('messages.show_in_home') }}</label>
            <select name="is_featured" class="form-control">
              <option value="0" @selected(old('is_featured','0')=='0')>{{ __('messages.no') }}</option>
              <option value="1" @selected(old('is_featured')=='1')>{{ __('messages.yes') }}</option>
            </select>
            @error('is_featured') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.home_sort') }}</label>
            <input type="number" name="home_sort" class="form-control" value="{{ old('home_sort', 0) }}">
            @error('home_sort') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">{{ __('messages.slug_auto_note') }}</p>
<div class="alert alert-info mt-3">
  <strong>{{ __('messages.note') }}:</strong>
  <ul class="mb-0">
    <li>{{ __('messages.sort_order_explain') }}</li>
    <li>{{ __('messages.home_sort_explain') }}</li>
  </ul>
</div>
        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
