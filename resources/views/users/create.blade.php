@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        
        <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                <h5 class="mb-0">{{ __('messages.create_user') }}</h5>
                <a href="{{ route('admin.users.index') }}" class="btn bg-gradient-primary btn-sm mb-0">
                    {{ __('messages.all_users') }}
                </a>
            </div>
        </div>

        <div class="card-body pt-4 p-3">

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- Name --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('messages.name') }}:</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name') }}" required>
                        </div>
                    </div>
                
                    {{-- Email --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('messages.email') }}:</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                      <div class="col-md-4">
                        <label>{{ __('messages.phone') }}:</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>

               
                    {{-- User Type --}}
                   <div class="row">
    {{-- Account Type --}}
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('messages.account_type') }}:</label>
          <select name="account_type" id="account_type" class="form-control" required>
    <option value="">Select</option>
    <option value="customer">Customer</option>
    <option value="staff">Staff</option>
</select>
        </div>
    </div>

    {{-- Role (for staff) --}}
    <div class="col-md-6">
      <div class="form-group">
    <label>Role</label>
    <select name="role" id="role" class="form-control">
        <option value="">Select Role</option>
        <option value="store-admin">Store Admin</option>
        <option value="order-manager">Order Manager</option>
        <option value="warehouse">Warehouse</option>
        <option value="content-manager">Content Manager</option>
        <option value="finance">Finance</option>
        <option value="support">Support</option>
    </select>
</div>
    </div>
</div>

                {{-- Phone + Verified --}}
                <div class="row">
                   {{-- Password --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{ __('messages.password') }}:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
              <div class="col-md-4">
                        <label>{{ __('messages.status') }}:</label>
                        <select name="status" class="form-control">
                            <option value="0">{{ __('messages.status_inactive') }}</option>
                            <option value="1">{{ __('messages.status_active') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('messages.verified') }}:</label>
                        <select name="verified" class="form-control">
                            <option value="0">{{ __('messages.verified_no') }}</option>
                            <option value="1">{{ __('messages.verified_yes') }}</option>
                        </select>
                    </div>
                </div>

              
              
                {{-- Picture --}}
                <div class="form-group mt-3">
                    <label>{{ __('messages.picture') }}:</label>
                    <input type="file" name="picture" class="form-control">
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
        } else if (type === 'staff' || type === 'admin') {
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