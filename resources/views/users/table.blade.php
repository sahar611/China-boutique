<div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('messages.id') }}</th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.user') }}
            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.phone') }}
            </th>

            
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.status') }}
            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.verified') }}
            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.created_at') }}
            </th>

            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ __('messages.action') }}
            </th>
        </tr>
        </thead>

        <tbody>
        @forelse ($list as $user)
            <tr>
            
                <td class="ps-4 text-center">{{ $user->id }}</td>

                {{-- User (Picture + Name + Email) --}}
                <td class="text-center">
                    <div class="d-flex flex-column align-items-center justify-content-center py-2">
                     

                    
                        <div class="fw-bold">{{ $user->name }}</div>
                        <div class="text-xs text-secondary">{{ $user->email }}</div>
                    </div>
                </td>

                {{-- Phone --}}
                <td class="text-center">
                    {{ $user->phone ?? '-' }}
                </td>

               

                {{-- Status --}}
                <td class="text-center">
                    @if((int)($user->status ?? 0) === 1)
                        <span class="badge bg-gradient-success">{{ __('messages.status_active') }}</span>
                    @else
                        <span class="badge bg-gradient-secondary">{{ __('messages.status_inactive') }}</span>
                    @endif
                </td>

                {{-- Verified --}}
                <td class="text-center">
                    @if((int)($user->verified ?? 0) === 1)
                        <span class="badge bg-gradient-success">{{ __('messages.verified_yes') }}</span>
                    @else
                        <span class="badge bg-gradient-warning">{{ __('messages.verified_no') }}</span>
                    @endif
                </td>

                {{-- Created At --}}
                <td class="text-center">
                    {{ optional($user->created_at)->format('Y-m-d') }}
                </td>

                {{-- Actions --}}
                <td class="text-center">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                        {{ __('messages.edit') }}
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                          method="POST"
                          style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('{{ __('users.confirm_delete') }}')">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-secondary">
                    {{ __('messages.no_data') }}
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
