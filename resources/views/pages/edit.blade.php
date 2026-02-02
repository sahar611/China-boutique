@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('messages.edit_page') }}</h5>

                <a href="{{ route('admin.pages.index') }}" class="btn bg-gradient-primary btn-sm">
                    {{ __('messages.pages') }}
                </a>
            </div>

            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Slug --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('messages.slug') }}</label>
                                <input type="text" name="slug" class="form-control"
                                       value="{{ old('slug', $page->slug) }}" required>
                                <small class="text-muted">
                                    {{ __('messages.slug_hint') }}
                                </small>
                            </div>
                        </div>

                        {{-- Status --}}
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('messages.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $page->status) == 1 ? 'selected' : '' }}>
                                        {{ __('messages.status_active') }}
                                    </option>
                                    <option value="0" {{ old('status', $page->status) == 0 ? 'selected' : '' }}>
                                        {{ __('messages.status_inactive') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                    {{-- Title EN / AR --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>{{ __('messages.title_en') }}</label>
                            <input type="text" name="title_en" class="form-control"
                                   value="{{ old('title_en', $page->title_en) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label>{{ __('messages.title_ar') }}</label>
                            <input type="text" name="title_ar" class="form-control"
                                   value="{{ old('title_ar', $page->title_ar) }}" required>
                        </div>
                    </div>

                    {{-- Content EN / AR --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>{{ __('messages.content_en') }}</label>
                            <textarea name="content_en" rows="8" class="form-control">{{ old('content_en', $page->content_en) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label>{{ __('messages.content_ar') }}</label>
                            <textarea name="content_ar" rows="8" class="form-control">{{ old('content_ar', $page->content_ar) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-gradient-dark">
                            {{ __('messages.update') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection
