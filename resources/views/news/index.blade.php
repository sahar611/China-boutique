@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">{{ __('cms.news') }}</h5>
        @can('news.create')
          <a href="{{ route('admin.news.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
            {{ __('cms.create') }}
          </a>
        @endcan
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('cms.title_ar') }}</th>
              <th>{{ __('cms.title_en') }}</th>
              <th>{{ __('cms.status') }}</th>
              <th>{{ __('cms.sort_order') }}</th>
              <th class="text-center">{{ __('cms.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title_ar }}</td>
                <td>{{ $item->title_en }}</td>
                <td>
                  <span class="badge bg-{{ $item->is_published ? 'success' : 'secondary' }}">
                    {{ $item->is_published ? __('cms.published') : __('cms.draft') }}
                  </span>
                </td>
                <td>{{ $item->sort_order }}</td>
                <td class="text-center">
                  @can('news.edit')
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">
                      {{ __('cms.edit') }}
                    </a>
                  @endcan

                  @can('news.delete')
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline-block">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('cms.confirm_delete') }}')">
                        {{ __('cms.delete') }}
                      </button>
                    </form>
                  @endcan
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        {{ $items->links() }}
      </div>

    </div>
  </div>
</div>
@endsection
