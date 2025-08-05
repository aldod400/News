@extends('layouts.admin')

@section('title', __('general.advisory_board_management'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('general.advisory_board_management') }}</h3>
                    <a href="{{ route('admin.advisory-board.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('general.add_new_member') }}
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($members && $members->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('general.image') }}</th>
                                        <th>{{ __('general.name') }}</th>
                                        <th>{{ __('general.job_title') }}</th>
                                        <th>{{ __('general.order') }}</th>
                                        <th>{{ __('general.status') }}</th>
                                        <th>{{ __('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td class="text-center">
                                                @if($member->image)
                                                    <img src="{{ asset('storage/uploads/' . $member->image) }}" 
                                                         alt="{{ json_decode($member->getRawOriginal('name'), true)[app()->getLocale()] ?? json_decode($member->getRawOriginal('name'), true)['en'] ?? '' }}" 
                                                         class="rounded-circle" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>EN:</strong> {{ json_decode($member->getRawOriginal('name'), true)['en'] ?? '' }}
                                                </div>
                                                <div>
                                                    <strong>AR:</strong> {{ json_decode($member->getRawOriginal('name'), true)['ar'] ?? '' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>EN:</strong> {{ json_decode($member->getRawOriginal('job_title'), true)['en'] ?? '' }}
                                                </div>
                                                <div>
                                                    <strong>AR:</strong> {{ json_decode($member->getRawOriginal('job_title'), true)['ar'] ?? '' }}
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $member->order }}</td>
                                            <td class="text-center">
                                                @if($member->is_active)
                                                    <span class="badge bg-success">{{ __('general.active') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('general.inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.advisory-board.edit', $member->id) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> {{ __('general.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.advisory-board.destroy', $member->id) }}" 
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
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ __('general.no_advisory_board_members') }}</h4>
                            <p class="text-muted">{{ __('general.start_by_adding_first_member') }}</p>
                            <a href="{{ route('admin.advisory-board.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('general.add_first_member') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
