@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.add_category') }}</h5>
      <a href="{{ route('admin.categories.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.categories') }}
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
          </div>
          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.parent') }}</label>
            <select name="parent_id" class="form-control">
              <option value="">{{ __('messages.no_parent') }}</option>
              @foreach($parents as $p)
                <option value="{{ $p->id }}">{{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.image') }}</label>
            <input type="file" name="image" class="form-control">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.sort_order') }}</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1">{{ __('messages.status_active') }}</option>
              <option value="0">{{ __('messages.status_inactive') }}</option>
            </select>
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">
          {{ __('messages.slug_auto_note') }}
        </p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection
