@extends('layouts.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4 mx-4">
      <div class="card-header pb-0 d-flex justify-content-between">
        <h5 class="mb-0">{{ __('messages.categories') }}</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn bg-gradient-primary btn-sm">
          {{ __('messages.add_category') }}
        </a>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-3">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.parent') }}</th>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th class="text-center">{{ __('messages.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ app()->isLocale('ar') ? $category->name_ar : $category->name_en }}</td>
                <td>{{ $category->parent ? (app()->isLocale('ar') ? $category->parent->name_ar : $category->parent->name_en) : '-' }}</td>
                <td>
                  @if($category->image)
                   
                    <img src="{{ asset($category->image) }}"  width="60">

                  @else -
                  @endif
                </td>
                <td>{{ $category->is_active ? __('messages.status_active') : __('messages.status_inactive') }}</td>

                <td class="text-center">
                  <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit', $category->id) }}">{{ __('messages.edit') }}</a>

                  <form action="{{ route('admin.categories.destroy', $category->id) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="mt-3">
            {{ $categories->links() }}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
