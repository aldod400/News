@extends('layouts.admin')

@section('title', __('general.privacy_policy_management'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('general.privacy_policy_management') }}</h3>
                    <a href="{{ route('admin.privacy-policy.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('general.add_new_policy') }}
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($policies && $policies->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('general.title') }}</th>
                                        <th>{{ __('general.last_updated') }}</th>
                                        <th>{{ __('general.status') }}</th>
                                        <th>{{ __('general.created_at') }}</th>
                                        <th>{{ __('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($policies as $policy)
                                        <tr class="{{ $policy->is_active ? 'table-success' : '' }}">
                                            <td>
                                                <div>
                                                    <strong>EN:</strong> {{ json_decode($policy->getRawOriginal('title'), true)['en'] ?? '' }}
                                                </div>
                                                <div>
                                                    <strong>AR:</strong> {{ json_decode($policy->getRawOriginal('title'), true)['ar'] ?? '' }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($policy->last_updated)
                                                    {{ $policy->last_updated->format('Y-m-d H:i') }}
                                                @else
                                                    {{ $policy->updated_at->format('Y-m-d H:i') }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($policy->is_active)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>{{ __('general.active') }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">{{ __('general.inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $policy->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if(!$policy->is_active)
                                                        <a href="{{ route('admin.privacy-policy.set-active', $policy->id) }}" 
                                                           class="btn btn-sm btn-success"
                                                           onclick="return confirm('{{ __('general.confirm_set_active') }}')">
                                                            <i class="fas fa-check"></i> {{ __('general.set_active') }}
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('admin.privacy-policy.edit', $policy->id) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> {{ __('general.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.privacy-policy.destroy', $policy->id) }}" 
                                                          method="POST" 
                                                          style="display: inline-block;"
                                                          onsubmit="return confirm('{{ __('general.confirm_delete') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> {{ __('general.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info mt-4">
                            <h5><i class="fas fa-info-circle me-2"></i>{{ __('general.privacy_policy_info') }}</h5>
                            <ul class="mb-0">
                                <li>{{ __('general.only_one_policy_can_be_active') }}</li>
                                <li>{{ __('general.active_policy_shown_on_website') }}</li>
                                <li>{{ __('general.update_last_updated_automatically') }}</li>
                            </ul>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ __('general.no_privacy_policies') }}</h4>
                            <p class="text-muted">{{ __('general.start_by_creating_first_policy') }}</p>
                            <a href="{{ route('admin.privacy-policy.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('general.create_first_policy') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
