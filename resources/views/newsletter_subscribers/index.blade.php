@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between align-items-center">
        <h5 class="mb-0">{{ __('cms.newsletter_subscribers') }}</h5>
        <a href="{{ route('admin.newsletter.index') }}" class="btn bg-gradient-primary btn-sm mb-0">{{ __('cms.back') }}</a>
      </div>
    </div>

    <div class="card-body pt-3">
      <form class="row g-2 mb-3" method="GET">
        <div class="col-md-4">
          <input name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __('cms.search_email') }}">
        </div>
        <div class="col-md-2">
          <button class="btn btn-dark w-100">{{ __('cms.search') }}</button>
        </div>
      </form>

      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('cms.email') }}</th>
              <th>{{ __('cms.locale') }}</th>
              <th>{{ __('cms.subscribed_at') }}</th>
              <th>{{ __('cms.status') }}</th>
              <th class="text-center">{{ __('cms.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->locale ?? '-' }}</td>
                <td>{{ optional($item->subscribed_at)->format('Y-m-d H:i') ?? '-' }}</td>
                <td>
                  <span class="badge bg-{{ $item->is_active ? 'success':'secondary' }}">
                    {{ $item->is_active ? __('cms.active') : __('cms.inactive') }}
                  </span>
                </td>
                <td class="text-center">
                  <form method="POST" action="{{ route('admin.newsletter_subscribers.toggle',$item->id) }}" style="display:inline-block">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-outline-dark">
                      {{ $item->is_active ? __('cms.disable') : __('cms.enable') }}
                    </button>
                  </form>
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
