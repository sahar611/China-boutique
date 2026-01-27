@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-row justify-content-between">
        <h5 class="mb-0">{{ __('cms.work_steps') }}</h5>
      
          <a href="{{ route('admin.work_steps.edit') }}" class="btn bg-gradient-primary btn-sm mb-0">
            {{ __('cms.edit') }}
          </a>
        
      </div>
    </div>

    <div class="card-body pt-3">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th>{{ __('cms.step_no') }}</th>
              <th>{{ __('cms.icon') }}</th>
              <th>{{ __('cms.title_ar') }}</th>
              <th>{{ __('cms.title_en') }}</th>
              <th>{{ __('cms.status') }}</th>
              <th>{{ __('cms.sort_order') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              <tr>
                <td>{{ $item->step_no }}</td>

                <td>
                  @if($item->icon_type === 'image' && $item->icon_image)
                    <img src="{{ asset($item->icon_image) }}" style="width:45px;height:45px;object-fit:contain;">
                  @else
                    <span class="badge bg-secondary">{{ $item->icon_class ?? '—' }}</span>
                  @endif
                </td>

                <td>{{ $item->title_ar }}</td>
                <td>{{ $item->title_en }}</td>

                <td>
                  <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                    {{ $item->is_active ? __('cms.active') : __('cms.inactive') }}
                  </span>
                </td>

                <td>{{ $item->sort_order }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <hr class="horizontal dark my-4">

      {{-- Preview in admin --}}
      <h6 class="mb-3">{{ __('cms.preview') }}</h6>
      <div class="row">
        @foreach($items->where('is_active',1) as $s)
          <div class="col-md-3 mb-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    @if($s->icon_type === 'image' && $s->icon_image)
                      <img src="{{ asset($s->icon_image) }}" style="width:44px;height:44px;object-fit:contain;">
                    @else
                      <i class="{{ $s->icon_class }}"></i>
                    @endif
                  </div>
                  <span class="badge bg-warning text-dark">{{ str_pad($s->step_no,2,'0',STR_PAD_LEFT) }}</span>
                </div>

                <h6 class="mt-3 mb-1">
                  {{ app()->getLocale()=='ar' ? $s->title_ar : $s->title_en }}
                </h6>
                <p class="text-sm text-muted mb-0">
                  {{ app()->getLocale()=='ar' ? $s->desc_ar : $s->desc_en }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
</div>
@endsection
