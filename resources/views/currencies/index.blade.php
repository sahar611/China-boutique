@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">

      <div class="card-header pb-0">
        <div class="d-flex flex-row justify-content-between">
          <div><h5 class="mb-0">Currencies</h5></div>
          <a href="{{ route('admin.currencies.create') }}" class="btn bg-gradient-primary btn-sm mb-0">
            Add Currency
          </a>
        </div>
      </div>
@if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Symbol</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Decimals</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Default</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($currencies as $currency)
              <tr>
                <td class="ps-4">{{ $loop->iteration }}</td>
                <td>{{ $currency->code }}</td>
                <td>{{ $currency->name }}</td>
                <td>{{ $currency->symbol }}</td>
                <td>{{ $currency->decimal_places }}</td>
                <td>
                  {!! $currency->is_default ? '<span class="badge bg-gradient-success">Yes</span>' : '<span class="badge bg-gradient-secondary">No</span>' !!}
                </td>
                <td>
                  {!! $currency->is_active ? '<span class="badge bg-gradient-info">Active</span>' : '<span class="badge bg-gradient-danger">Inactive</span>' !!}
                </td>
                <td class="text-center">
                  <a href="{{ route('admin.currencies.edit', $currency->id) }}" class="btn btn-sm btn-warning">Edit</a>

                  <form action="{{ route('admin.currencies.destroy', $currency->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this currency?')">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
