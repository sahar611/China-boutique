@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">

            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0">{{ __('messages.banners') }}</h5>
                <a href="{{ route('admin.banners.create') }}" class="btn bg-gradient-primary btn-sm">
                    {{ __('messages.add_banner') }}
                </a>
            </div>

            <div class="card-body px-0 pt-0 pb-2">

                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.title') }}</th>
                                <th>{{ __('messages.image') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.url') }}</th>
                                <th class="text-center">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ app()->isLocale('ar') ? ($banner->title_ar ?: $banner->title) : $banner->title }}
                                    </td>
                                    <td>
                                        @if($banner->image)
                                            <img src="{{ asset('storage/'.$banner->image) }}" width="80">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $banner->status ? __('messages.status_active') : __('messages.status_inactive') }}</td>
                                    <td>{{ $banner->url ?? '-' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.banners.edit', $banner->id) }}">
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                              method="POST"
                                              style="display:inline-block"
                                              onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
