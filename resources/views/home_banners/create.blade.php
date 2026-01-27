@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">{{ __('cms.create_home_banner') }}</h5>

        <a href="{{ route('admin.home-banners.index') }}" class="btn bg-gradient-primary btn-sm mb-0">
          {{ __('cms.back') }}
        </a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">
      <form action="{{ route('admin.home-banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('home_banners._form', ['model' => $model])

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-0">
            {{ __('cms.save') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
