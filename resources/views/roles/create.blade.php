@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>

        <div class="col-md-6 text-right">
            <a href="{{ route('roles.index') }}" class="btn btn-primary">All roles</a>
        </div>
      </div>
    </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Create New Role</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group mt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <label class="mb-0">Permissions</label>

                    <div>
                        <input id="select-all" type="checkbox">
                        <label for="select-all" class="mb-0">Check ALL</label>
                    </div>
                </div>

                <hr>

                {{-- Groups --}}
                @foreach($permissions as $module => $modulePermissions)
                    @php
                        $moduleId = 'module_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $module);
                    @endphp

                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="mb-2 text-uppercase">{{ ucfirst(str_replace('-', ' ', $module)) }}</h6>

                            <div>
                                <input type="checkbox" class="module-check" data-module="{{ $moduleId }}" id="{{ $moduleId }}_all">
                                <label for="{{ $moduleId }}_all" class="mb-0">Check {{ ucfirst($module) }}</label>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($modulePermissions as $permission)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                type="checkbox"
                                                class="permission-checkbox {{ $moduleId }}"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                            >
                                            {{ str_replace($module.'.', '', $permission->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>

            <button type="submit" class="btn btn-primary pull-right">Create</button>
        </form>
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Global select all
    const selectAll = document.getElementById('select-all');
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = selectAll.checked);
            document.querySelectorAll('.module-check').forEach(cb => cb.checked = selectAll.checked);
        });
    }

    // Per module select
    document.querySelectorAll('.module-check').forEach(moduleToggle => {
        moduleToggle.addEventListener('change', function () {
            const moduleClass = this.dataset.module;
            document.querySelectorAll('.' + moduleClass).forEach(cb => cb.checked = this.checked);
        });
    });

});
</script>
@endpush
@endsection
