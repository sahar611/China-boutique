@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">{{ __('cms.edit_work_steps') }}</h5>
        <a href="{{ route('admin.work_steps.index') }}" class="btn bg-gradient-primary btn-sm mb-0">
          {{ __('cms.back') }}
        </a>
      </div>
    </div>

    <div class="card-body pt-4 p-3">

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.work_steps.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($items as $i => $model)
          @include('work_steps._form', ['model' => $model, 'i' => $i])
          @if(!$loop->last)
            <hr class="horizontal dark my-4">
          @endif
        @endforeach

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
