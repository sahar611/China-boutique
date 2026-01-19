@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0">{{ __('messages.settings') ?? 'Settings' }}</h5>
            </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
            <div class="card-body pt-4 p-3">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ __('messages.phone') }}</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $settings['phone']) }}">
                        </div>

                        <div class="col-md-4">
                            <label>{{ __('messages.email') }}</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $settings['email']) }}">
                        </div>

                        <div class="col-md-4">
                            <label>WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control"
                                   value="{{ old('whatsapp', $settings['whatsapp']) }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                   value="{{ old('facebook', $settings['facebook']) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control"
                                   value="{{ old('instagram', $settings['instagram']) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Twitter</label>
                            <input type="text" name="twitter" class="form-control"
                                   value="{{ old('twitter', $settings['twitter']) }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn bg-gradient-dark">
                            {{ __('messages.save') }}
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
