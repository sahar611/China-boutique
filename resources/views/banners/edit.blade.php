@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="card">

        <div class="card-header pb-0 d-flex justify-content-between">
            <h5>{{ __('messages.add_banner') }}</h5>
            <a href="{{ route('admin.banners.index') }}" class="btn bg-gradient-primary btn-sm">
                {{ __('messages.banners') }}
            </a>
        </div>

        <div class="card-body">

          <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')


                <div class="row">

                    <div class="col-md-6">
                        <label>{{ __('messages.title_en') }}</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('messages.title_ar') }}</label>
                        <input type="text" name="title_ar" class="form-control" value="{{ old('title', $banner->title_ar) }}">
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-6">
                        <label>{{ __('messages.description_en') }}</label>
                        <textarea name="description" class="form-control">{{ old('title', $banner->description) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label>{{ __('messages.description_ar') }}</label>
                        <textarea name="description_ar" class="form-control">{{ old('title', $banner->description_ar) }}</textarea>
                    </div>

                </div>
 <div class="row mt-3">
       <div class="col-md-6">
                        <label>{{ __('messages.url') }}</label>
                        <input type="text" name="url" class="form-control"value="{{ old('title', $banner->url) }}">
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('messages.status') }}</label>
                    <select name="status" class="form-control">
    <option value="1" {{ old('status', $banner->status ?? 1) == 1 ? 'selected' : '' }}>
        {{ __('messages.status_active') }}
    </option>

    <option value="0" {{ old('status', $banner->status ?? 1) == 0 ? 'selected' : '' }}>
        {{ __('messages.status_inactive') }}
    </option>
</select>

                    </div>
                </div>
                <div class="row mt-3">

                 

                    <!-- <div class="col-md-6">
                        <label>{{ __('messages.image') }}</label>
                        <input type="file" name="image" class="form-control">
                        @if($banner->image)
    <img src="{{ asset('storage/'.$banner->image) }}" width="120" class="img-thumbnail mt-2">
@endif

                    </div> -->

                </div>

               

                <div class="text-end mt-4">
                    <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection
