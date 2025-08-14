@extends('layouts.admin')

@section('title', __('admin.robots_txt_management'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('admin.robots_txt_management') }}</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i> {{ __('admin.add_new') }}
                    </button>
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('admin.robots_content') }}</th>
                                    <th>{{ __('admin.robots_status') }}</th>
                                    <th>{{ __('admin.creation_date') }}</th>
                                    <th>{{ __('admin.operations') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($robotsTxts as $robotsTxt)
                                    <tr class="{{ $robotsTxt->is_active ? 'table-success' : '' }}">
                                        <td>{{ $robotsTxt->id }}</td>
                                        <td>
                                            <pre style="max-height: 100px; overflow-y: auto; white-space: pre-wrap;">{{ Str::limit($robotsTxt->content, 200) }}</pre>
                                        </td>
                                        <td>
                                            @if($robotsTxt->is_active)
                                                <span class="badge bg-success">{{ __('admin.active') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ __('admin.inactive') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $robotsTxt->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                @if(!$robotsTxt->is_active)
                                                    <form action="{{ route('admin.robots-txt.set-active', $robotsTxt) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" title="{{ __('admin.activate') }}">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <button type="button" class="btn btn-sm btn-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editModal{{ $robotsTxt->id }}"
                                                        title="{{ __('admin.edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                @if(!$robotsTxt->is_active)
                                                    <form action="{{ route('admin.robots-txt.destroy', $robotsTxt) }}" method="POST" style="display: inline;" onsubmit="return confirm('{{ __('admin.confirm_delete_robots') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="{{ __('admin.delete') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $robotsTxt->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('admin.edit_robots') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.robots-txt.update', $robotsTxt) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="content{{ $robotsTxt->id }}" class="form-label">{{ __('admin.robots_content') }}</label>
                                                            <textarea class="form-control" id="content{{ $robotsTxt->id }}" name="content" rows="15" required>{{ $robotsTxt->content }}</textarea>
                                                            <div class="form-text">{{ __('admin.modify_content_as_needed') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.cancel') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('admin.save_changes') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('admin.no_robots_content') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Current Active Robots.txt Preview -->
            @if($activeRobotsTxt)
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>{{ __('admin.current_active_robots') }}</h4>
                    </div>
                    <div class="card-body">
                        <pre style="background-color: #f8f9fa; padding: 15px; border-radius: 5px;">{{ $activeRobotsTxt->content }}</pre>
                        <p class="text-muted">
                            <small>{{ __('admin.last_updated') }}: {{ $activeRobotsTxt->updated_at->format('Y-m-d H:i:s') }}</small>
                        </p>
                        <a href="{{ url('/robots.txt') }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i> {{ __('admin.view_live_robots') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('admin.add_new_robots') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.robots-txt.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newContent" class="form-label">{{ __('admin.robots_content') }}</label>
                        <textarea class="form-control" id="newContent" name="content" rows="15" required>User-agent: *
Disallow: /admin/
Disallow: /dashboard/
Disallow: /profile/
Disallow: /login/
Disallow: /register/

# Allow all other pages
Allow: /

# Sitemap
Sitemap: {{ url('/sitemap.xml') }}</textarea>
                        <div class="form-text">{{ __('admin.modify_content_as_needed') }}</div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6>{{ __('admin.robots_examples') }}:</h6>
                        <ul class="mb-0">
                            <li><code>User-agent: *</code> - {{ __('admin.user_agent_all') }}</li>
                            <li><code>Disallow: /admin/</code> - {{ __('admin.disallow_admin') }}</li>
                            <li><code>Allow: /</code> - {{ __('admin.allow_all') }}</li>
                            <li><code>Sitemap: {{ url('/sitemap.xml') }}</code> - {{ __('admin.sitemap_link') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
