@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.edit_category') }}</h5>

      <a href="{{ route('admin.categories.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.categories') }}
      </a>
    </div>

    <div class="card-body">

      <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-6">
            <label>{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control"
                   value="{{ old('name_en', $category->name_en) }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control"
                   value="{{ old('name_ar', $category->name_ar) }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.parent') }}</label>
            <select name="parent_id" class="form-control">
              <option value="">{{ __('messages.no_parent') }}</option>
              @foreach($parents as $p)
                <option value="{{ $p->id }}" @selected(old('parent_id', $category->parent_id) == $p->id)>
                  {{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}
                </option>
              @endforeach
            </select>
            @error('parent_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.image') }}</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror

            @if($category->image)
              <div class="mt-2">
                <img src="{{ asset($category->image) }}" width="90" alt="category">
              </div>
            @endif
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label>{{ __('messages.sort_order') }}</label>
            <input type="number" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $category->sort_order ?? 0) }}">
            @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label>{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1" @selected(old('is_active', $category->is_active) == 1)>
                {{ __('messages.status_active') }}
              </option>
              <option value="0" @selected(old('is_active', $category->is_active) == 0)>
                {{ __('messages.status_inactive') }}
              </option>
            </select>
            @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">
          {{ __('messages.slug_auto_note') }}
        </p>

        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>

      </form>

    
      <div class="mt-3">
        <small class="text-muted">
          {{ __('messages.slug') }}: <strong>{{ $category->slug }}</strong>
        </small>
      </div>

    </div>

  </div>

</div>
@endsection
