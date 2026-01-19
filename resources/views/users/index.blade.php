@extends('layouts.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">{{ __('messages.all_users') }}</h5>
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
                        {{ __('messages.add_user') }}
                    </a>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
               <div class="nav-wrapper position-relative end-0 mt-3">
    <ul class="nav nav-pills nav-fill p-1 bg-transparent" id="userTabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1 active" id="all-tab" data-bs-toggle="tab"
               href="#all" role="tab">{{ __('messages.all_users') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link mb-0 px-0 py-1" id="clients-tab" data-bs-toggle="tab"
               href="#clients" role="tab">{{ __('messages.clients') }}</a>
        </li>

      
       
<li class="nav-item">
    <a class="nav-link mb-0 px-0 py-1" id="staff-tab" data-bs-toggle="tab"
       href="#staff" role="tab">{{ __('messages.staff') }}</a>
</li>

    </ul>
</div>
<div class="tab-content">

    {{-- ALL USERS --}}
    <div class="tab-pane fade show active" id="all" role="tabpanel">
        @include('users.table', ['list' => $users])
    </div>

    {{-- CLIENTS --}}
    <div class="tab-pane fade" id="clients" role="tabpanel">
        @include('users.table', ['list' => $customers])
    </div>

   
  

   
{{-- STAFF --}}
<div class="tab-pane fade" id="staff" role="tabpanel">
    @include('users.table', ['list' => $staff])
</div>

</div>

              
            </div>

        </div>
    </div>
</div>


@endsection

