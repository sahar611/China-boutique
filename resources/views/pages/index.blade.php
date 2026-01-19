@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h5 class="mb-0">{{ __('messages.pages') ?? 'Pages' }}</h5>
                <a href="{{ route('admin.pages.create') }}"
                   class="btn bg-gradient-primary btn-sm">
                    {{ __('messages.add_page') ?? 'Add Page' }}
                </a>
            </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slug</th>
                                <th>{{ __('messages.title') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.created_at') }}</th>
                                <th class="text-center">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>
                                    {{ app()->isLocale('ar') ? $page->title_ar : $page->title_en }}
                                </td>
                                <td>
                                    {{ $page->status ? __('messages.status_active') : __('messages.status_inactive') }}
                                </td>
                                <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pages.edit', $page->id) }}"
                                       class="btn btn-sm btn-primary">
                                        {{ __('messages.edit') }}
                                    </a>

                                    <form action="{{ route('admin.pages.destroy', $page->id) }}"
                                          method="POST"
                                          style="display:inline-block"
                                          onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    {{ __('messages.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
