@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">

        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <h5 class="mb-0">{{ __('messages.edit_user') }}</h5>
                <a href="{{ route('admin.users.index') }}" class="btn bg-gradient-primary btn-sm mb-0">
                    {{ __('messages.all_users') }}
                </a>
            </div>
        </div>

        <div class="card-body pt-4 p-3">

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name / Email / Phone --}}
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ __('messages.name') }}:</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="col-md-4">
                        <label>{{ __('messages.email') }}:</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-md-4">
                        <label>{{ __('messages.phone') }}:</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>

                {{-- Account Type / Role --}}
                <div class="row mt-3">
                   {{-- Account Type --}}
<div class="col-md-6">
    <label>{{ __('messages.account_type') }}</label>
    <select name="account_type" id="account_type" class="form-control" required>
        <option value="customer" {{ $user->account_type === 'customer' ? 'selected' : '' }}>
            Customer
        </option>
        <option value="staff" {{ $user->account_type === 'staff' ? 'selected' : '' }}>
            Staff
        </option>
    </select>
</div>

{{-- Role --}}
@php
    $currentRole = $user->roles->first()?->name;
@endphp

<div class="col-md-6" id="role-wrapper">
    <label>{{ __('messages.role') }}</label>
    <select name="role" id="role" class="form-control">
        <option value="">Select Role</option>

        <option value="store-admin" {{ $currentRole === 'store-admin' ? 'selected' : '' }}>Store Admin</option>
        <option value="order-manager" {{ $currentRole === 'order-manager' ? 'selected' : '' }}>Order Manager</option>
        <option value="warehouse" {{ $currentRole === 'warehouse' ? 'selected' : '' }}>Warehouse</option>
        <option value="content-manager" {{ $currentRole === 'content-manager' ? 'selected' : '' }}>Content Manager</option>
        <option value="finance" {{ $currentRole === 'finance' ? 'selected' : '' }}>Finance</option>
        <option value="support" {{ $currentRole === 'support' ? 'selected' : '' }}>Support</option>
    </select>
</div>

                </div>

                {{-- Password / Status / Verified --}}
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>{{ __('messages.password') }}:</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">{{ __('messages.leave_empty') }}</small>
                    </div>

                    <div class="col-md-4">
                        <label>{{ __('messages.status') }}:</label>
                        <select name="status" class="form-control">
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                                {{ __('messages.status_inactive') }}
                            </option>
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                {{ __('messages.status_active') }}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>{{ __('messages.verified') }}:</label>
                        <select name="verified" class="form-control">
                            <option value="0" {{ $user->verified == 0 ? 'selected' : '' }}>
                                {{ __('messages.verified_no') }}
                            </option>
                            <option value="1" {{ $user->verified == 1 ? 'selected' : '' }}>
                                {{ __('messages.verified_yes') }}
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Picture --}}
                <div class="form-group mt-3">
                    <label>{{ __('messages.picture') }}:</label>
                    <input type="file" name="picture" class="form-control">

                    @if($user->picture)
                        <div class="mt-3">
                          <img src="{{ asset($user->picture) }}" width="120" class="img-thumbnail">

                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">
                        {{ __('messages.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const accountTypeSelect = document.getElementById('account_type');
    const roleSelect = document.getElementById('role');

    if (!accountTypeSelect || !roleSelect) return;

    const roleWrapper = roleSelect.closest('.form-group') || roleSelect.parentElement;

    function toggleRoleField() {
        const type = accountTypeSelect.value;

        if (type === 'customer') {
            roleWrapper.style.display = 'none';
            roleSelect.value = '';
            roleSelect.removeAttribute('required');
        } else if (type === 'staff') {
            roleWrapper.style.display = 'block';
            roleSelect.setAttribute('required', 'required');
        } else {
            roleWrapper.style.display = 'none';
            roleSelect.removeAttribute('required');
        }
    }

    toggleRoleField();
    accountTypeSelect.addEventListener('change', toggleRoleField);
});
</script>
@endpush
