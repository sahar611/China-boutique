@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">

        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('messages.faqs') }}</h5>

                <a href="{{ route('admin.faqs.create') }}"
                   class="btn bg-gradient-primary btn-sm">
                    {{ __('messages.create') }}
                </a>
            </div>
        </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
        <div class="card-body pt-3">

            {{-- Search --}}
            <form method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           class="form-control"
                           placeholder="{{ __('messages.search') }}">
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('messages.faq') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th>{{ __('messages.sort_order') }}</th>
                            <th class="text-end">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>

                                <td>
                                    <div class="fw-bold">
                                        {{ app()->getLocale() == 'en'
                                            ? $faq->question_en
                                            : $faq->question_ar }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $faq->is_active
                                            ? __('messages.active')
                                            : __('messages.inactive') }}
                                    </span>
                                </td>

                                <td>{{ $faq->sort_order }}</td>

                                <td class="text-end">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                       class="btn btn-sm bg-gradient-primary">
                                        {{ __('messages.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $faqs->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
