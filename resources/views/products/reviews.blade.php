@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">

  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
          <h5 class="mb-1">
            {{ __('messages.reviews') }}:
            <span class="text-dark">
              {{ app()->getLocale()==='ar' ? ($product->name_ar ?? $product->name_en) : ($product->name_en ?? $product->name_ar) }}
            </span>
          </h5>

          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-gradient-dark">{{ __('messages.total') }}: {{ $counts['total'] ?? 0 }}</span>
            <span class="badge bg-gradient-warning text-dark">{{ __('messages.pending') }}: {{ $counts['pending'] ?? 0 }}</span>
            <span class="badge bg-gradient-secondary">{{ __('messages.hidden') }}: {{ $counts['hidden'] ?? 0 }}</span>
          </div>
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm mb-0">
            <i class="fa fa-arrow-left me-1"></i> {{ __('messages.back_to_products') }}
          </a>
        </div>
      </div>
    </div>

    <div class="card-body pt-3">

      {{-- Flash --}}
      @if(session('success'))
        <div class="alert alert-success py-2">{{ session('success') }}</div>
      @endif

      {{-- Filters --}}
      <form method="GET" action="{{ route('admin.products.reviews', $product->id) }}" class="row g-2 mb-3">
        <div class="col-12 col-md-4">
          <input
            type="text"
            name="q"
            value="{{ $q ?? '' }}"
            class="form-control"
            placeholder="{{ __('messages.search_in_comments') }}"
          >
        </div>

        <div class="col-12 col-md-3">
          <select name="status" class="form-select">
            <option value="all"      @selected(($status ?? 'all')==='all')>{{ __('messages.all') }}</option>
            <option value="pending"  @selected(($status ?? 'all')==='pending')>{{ __('messages.pending') }}</option>
            <option value="approved" @selected(($status ?? 'all')==='approved')>{{ __('messages.approved_visible') }}</option>
            <option value="hidden"   @selected(($status ?? 'all')==='hidden')>{{ __('messages.hidden') }}</option>
          </select>
        </div>

        <div class="col-12 col-md-5 d-flex gap-2">
          <button class="btn bg-gradient-primary btn-sm mb-0" type="submit">
            <i class="fa fa-search me-1"></i> {{ __('messages.filter') }}
          </button>

          <a href="{{ route('admin.products.reviews', $product->id) }}" class="btn btn-outline-secondary btn-sm mb-0">
            {{ __('messages.reset') }}
          </a>
        </div>
      </form>

      {{-- Tabs quick links --}}
      <div class="d-flex flex-wrap gap-2 mb-3">
        @php $active = $status ?? 'all'; @endphp

        <a class="btn btn-sm {{ $active==='all' ? 'bg-gradient-dark text-white' : 'btn-outline-dark' }}"
           href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}">
          {{ __('messages.all') }}
          <span class="badge bg-light text-dark ms-1">{{ $counts['total'] ?? 0 }}</span>
        </a>

        <a class="btn btn-sm {{ $active==='pending' ? 'bg-gradient-warning text-dark' : 'btn-outline-warning' }}"
           href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">
          {{ __('messages.pending') }}
          <span class="badge bg-light text-dark ms-1">{{ $counts['pending'] ?? 0 }}</span>
        </a>

        <a class="btn btn-sm {{ $active==='approved' ? 'bg-gradient-success text-white' : 'btn-outline-success' }}"
           href="{{ request()->fullUrlWithQuery(['status' => 'approved']) }}">
          {{ __('messages.approved') }}
        </a>

        <a class="btn btn-sm {{ $active==='hidden' ? 'bg-gradient-secondary text-white' : 'btn-outline-secondary' }}"
           href="{{ request()->fullUrlWithQuery(['status' => 'hidden']) }}">
          {{ __('messages.hidden') }}
          <span class="badge bg-light text-dark ms-1">{{ $counts['hidden'] ?? 0 }}</span>
        </a>
      </div>

      {{-- Table --}}
      <div class="table-responsive">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.user') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.rating') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.comment') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.created') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('messages.approved') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('messages.visible') }}</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">{{ __('messages.actions') }}</th>
            </tr>
          </thead>

          <tbody>
            @forelse($reviews as $r)
              <tr>
                <td>
                  <div class="d-flex flex-column">
                    <span class="text-sm font-weight-bold">
                      {{ $r->user->name ?? __('messages.user') }}
                    </span>
                    <span class="text-xs text-secondary">
                      {{ $r->user->email ?? '' }}
                    </span>
                  </div>
                </td>

                <td>
                  <div class="d-flex align-items-center gap-1">
                    <span class="text-sm font-weight-bold">{{ (int)$r->rating }}/5</span>
                    <span class="text-xs text-secondary">
                      @for($i=1; $i<=5; $i++)
                        <i class="fas fa-star {{ $i <= (int)$r->rating ? 'text-warning' : 'text-muted' }}"></i>
                      @endfor
                    </span>
                  </div>
                </td>

                <td style="max-width: 520px;">
                  <div class="text-sm" style="white-space: normal;">
                    {{ $r->comment }}
                  </div>
                </td>

                <td>
                  <span class="text-xs text-secondary">
                    {{ optional($r->created_at)->format('Y-m-d H:i') }}
                  </span>
                </td>

                {{-- Approved toggle --}}
                <td class="text-center">
                  <form method="POST" action="{{ route('admin.reviews.toggleApprove', $r->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                      class="btn btn-sm mb-0 {{ $r->is_approved ? 'bg-gradient-success' : 'btn-outline-warning' }}">
                      {{ $r->is_approved ? __('messages.approved') : __('messages.pending') }}
                    </button>
                  </form>
                </td>

                {{-- Visible toggle --}}
                <td class="text-center">
                  <form method="POST" action="{{ route('admin.reviews.toggleVisible', $r->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                      class="btn btn-sm mb-0 {{ $r->is_visible ? 'bg-gradient-info' : 'btn-outline-secondary' }}">
                      {{ $r->is_visible ? __('messages.visible') : __('messages.hidden') }}
                    </button>
                  </form>

                  @if(!$r->is_approved)
                    <div class="text-xs text-secondary mt-1">
                      ({{ __('messages.not_approved') }})
                    </div>
                  @endif
                </td>

                {{-- Actions --}}
                <td class="text-center">
                  <form method="POST" action="{{ route('admin.reviews.destroy', $r->id) }}"
                        onsubmit="return confirm('{{ __('messages.delete_review_confirm') }}');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger mb-0">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-secondary">
                  {{ __('messages.no_reviews_found') }}
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      <div class="mt-3">
        {{ $reviews->links() }}
      </div>

    </div>
  </div>

</div>
@endsection
