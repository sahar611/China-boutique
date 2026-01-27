@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">{{ __('cms.home_banners') }}</h5>

      
          <a href="{{ route('admin.home-banners.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
            {{ __('cms.create') }}
          </a>
      
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('cms.image') }}</th>
              <th>{{ __('cms.title_ar') }}</th>
              <th>{{ __('cms.title_en') }}</th>
              <th>{{ __('cms.discount_percent') }}</th>
              <th>{{ __('cms.status') }}</th>
              <th>{{ __('cms.sort_order') }}</th>
              <th class="text-center">{{ __('cms.actions') }}</th>
            </tr>
          </thead>

          <tbody>
            @forelse($items as $item)
              <tr>
                <td>{{ $item->id }}</td>

                <td>
                  @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="banner" style="width:90px;height:55px;object-fit:cover;border-radius:10px;">
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>

                <td>{{ $item->title_ar }}</td>
                <td>{{ $item->title_en }}</td>

                <td>
                  @if(!is_null($item->discount_percent))
                    {{ $item->discount_percent }}%
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>

                <td>
                  <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                    {{ $item->is_active ? __('cms.active') : __('cms.inactive') }}
                  </span>
                </td>

                <td>{{ $item->sort_order }}</td>

                <td class="text-center">
                
                    <a href="{{ route('admin.home-banners.edit', $item->id) }}" class="btn btn-sm btn-warning">
                      {{ __('cms.edit') }}
                    </a>
                

                 
                    <form action="{{ route('admin.home-banners.destroy', $item->id) }}" method="POST" style="display:inline-block">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger"
                              onclick="return confirm('{{ __('cms.confirm_delete') }}')">
                        {{ __('cms.delete') }}
                      </button>
                    </form>
                 
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  {{ __('cms.no_data') }}
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-3">
      
        @if(method_exists($items,'links'))
          {{ $items->links() }}
        @endif
      </div>

    </div>
  </div>
</div>
@endsection
