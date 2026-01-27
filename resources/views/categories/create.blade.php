@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
  <div class="card">

    <div class="card-header pb-0 d-flex justify-content-between">
      <h5>{{ __('messages.add_category') }}</h5>
      <a href="{{ route('admin.categories.index') }}" class="btn bg-gradient-primary btn-sm">
        {{ __('messages.categories') }}
      </a>
    </div>

    <div class="card-body">

      {{-- Errors summary --}}
      @if ($errors->any())
        <div class="alert alert-danger text-white mb-3">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label class="form-label">{{ __('messages.name_en') }}</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
            @error('name_en') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">{{ __('messages.name_ar') }}</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
            @error('name_ar') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <label class="form-label">{{ __('messages.parent') }}</label>
            <select name="parent_id" class="form-control">
              <option value="">{{ __('messages.no_parent') }}</option>
              @foreach($parents as $p)
                <option value="{{ $p->id }}" @selected(old('parent_id') == $p->id)>
                  {{ app()->isLocale('ar') ? $p->name_ar : $p->name_en }}
                </option>
              @endforeach
            </select>
            @error('parent_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">{{ __('messages.image') }}</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        {{-- Admin Sort + Status --}}
        <div class="row mt-3">
          <div class="col-md-6">
            <label class="form-label">{{ __('messages.sort_order') }}</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
          
            @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
          </div>


          <div class="col-md-6">
            <label class="form-label">{{ __('messages.status') }}</label>
            <select name="is_active" class="form-control">
              <option value="1" @selected(old('is_active','1') == '1')>{{ __('messages.status_active') }}</option>
              <option value="0" @selected(old('is_active') == '0')>{{ __('messages.status_inactive') }}</option>
            </select>
            @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        {{-- Home Controls --}}
        <div class="row mt-4">
          <div class="col-md-4">
            <label class="form-label">{{ __('messages.show_in_home') }}</label>
            <select name="is_featured" id="is_featured" class="form-control">
              <option value="0" @selected(old('is_featured','0') == '0')>{{ __('messages.no') }}</option>
              <option value="1" @selected(old('is_featured') == '1')>{{ __('messages.yes') }}</option>
            </select>
            @error('is_featured') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

         
          <div class="col-md-4">
            @php
              $posOptions = [
                'none' => __('messages.position_none'),
                'home_sidebar' => __('messages.position_home_sidebar'),
                'header_dropdown' => __('messages.position_header_dropdown'),
                'home_top_categories' => __('messages.position_home_top_categories'),
                'home_tabs' => __('messages.position_home_tabs'),
              ];

              $selectedPositions = old('positions', ['none']);
              if (!is_array($selectedPositions)) $selectedPositions = ['none'];
            @endphp

            <label class="form-label">{{ __('messages.display_positions') }}</label>

            <div class="border rounded-3 p-3" style="background:#fff">
              <div class="row">
                @foreach($posOptions as $key => $label)
                  <div class="col-12 mb-2">
                    <div class="form-check">
                      <input
                        class="form-check-input position-check"
                        type="checkbox"
                        name="positions[]"
                        value="{{ $key }}"
                        id="pos_{{ $key }}"
                        @checked(in_array($key, $selectedPositions))
                      >
                      <label class="form-check-label" for="pos_{{ $key }}">
                        {{ $label }}
                      </label>
                    </div>
                  </div>
                @endforeach
              </div>
              <small class="text-muted d-block mt-2">{{ __('messages.home_position_note') }}</small>
            </div>

            @error('positions') <small class="text-danger">{{ $message }}</small> @enderror
            @error('positions.*') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="col-md-4">
            <label class="form-label">{{ __('messages.home_sort') }}</label>
            <input type="number" name="home_sort" id="home_sort" class="form-control" value="{{ old('home_sort', 0) }}">
           
            @error('home_sort') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>

        <p class="text-muted mt-3 mb-0">
          {{ __('messages.slug_auto_note') }}
        </p>
<div class="alert alert-info mt-3">
  <strong>{{ __('messages.note') }}:</strong>
  <ul class="mb-0">
    <li>{{ __('messages.sort_order_explain') }}</li>
    <li>{{ __('messages.home_sort_explain') }}</li>
  </ul>
</div>
        <div class="text-end mt-4">
          <button class="btn bg-gradient-dark">{{ __('messages.save') }}</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  const isFeatured = document.getElementById('is_featured');
  const homeSort = document.getElementById('home_sort');

  // positions checkboxes
  const none = document.getElementById('pos_none');
  const checks = document.querySelectorAll('.position-check');

  function syncNone(){
    if(!none) return;
    if(none.checked){
      checks.forEach(c => { if(c !== none) c.checked = false; });
    }
  }

  checks.forEach(c => {
    c.addEventListener('change', function(){
      if(this === none) syncNone();
      else if(none && none.checked) none.checked = false;
    });
  });

  function toggleHomeSort(){
    if(!isFeatured || !homeSort) return;
    const enabled = (String(isFeatured.value) === '1');
    homeSort.disabled = !enabled;
    if(!enabled){
      homeSort.value = 0;
    }
  }

  if(isFeatured){
    isFeatured.addEventListener('change', toggleHomeSort);
  }

  syncNone();
  toggleHomeSort();
});
</script>
@endpush
