@extends('layouts.admin')

@section('title', __('admin.contact_messages'))

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-envelope"></i> {{ __('admin.contact_messages') }}
            @if($unreadCount > 0)
                <span class="badge badge-danger ml-2">{{ $unreadCount }} {{ __('admin.new_messages') }}</span>
            @endif
        </h1>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Messages Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.all_messages') }}</h6>
        </div>
        <div class="card-body">
            @if($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('admin.message_status_header') }}</th>
                                <th>{{ __('admin.sender_name') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.message_subject') }}</th>
                                <th>{{ __('admin.send_date') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                                <td class="text-center">
                                    @if(!$message->is_read)
                                        <span class="badge badge-warning">{{ __('admin.new_status') }}</span>
                                    @elseif($message->is_replied)
                                        <span class="badge badge-success">{{ __('admin.replied_status') }}</span>
                                    @else
                                        <span class="badge badge-info">{{ __('admin.read_status') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$message->is_read)
                                        <strong>{{ $message->name }}</strong>
                                    @else
                                        {{ $message->name }}
                                    @endif
                                </td>
                                <td>
                                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                </td>
                                <td>
                                    {{ Str::limit($message->subject, 50) }}
                                </td>
                                <td>
                                    {{ $message->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                           class="btn btn-sm btn-primary" title="{{ __('admin.view_action') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if(!$message->is_read)
                                        <button type="button" class="btn btn-sm btn-info mark-read-btn" 
                                                data-id="{{ $message->id }}" title="{{ __('admin.mark_as_read_action') }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        
                                        @if(!$message->is_replied)
                                        <button type="button" class="btn btn-sm btn-success mark-replied-btn" 
                                                data-id="{{ $message->id }}" title="{{ __('admin.mark_as_replied_action') }}">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                        @endif
                                        
                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('{{ __('admin.confirm_delete_message') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="{{ __('admin.delete_action') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">{{ __('admin.no_messages_yet') }}</h5>
                    <p class="text-muted">{{ __('admin.messages_will_appear_here') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Mark as read
    $('.mark-read-btn').click(function() {
        let messageId = $(this).data('id');
        let button = $(this);
        
        $.ajax({
            url: '{{ url("admin/contact-messages") }}/' + messageId + '/mark-read',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    button.closest('tr').removeClass('table-warning');
                    button.remove();
                    location.reload();
                }
            }
        });
    });
    
    // Mark as replied
    $('.mark-replied-btn').click(function() {
        let messageId = $(this).data('id');
        let button = $(this);
        
        $.ajax({
            url: '{{ url("admin/contact-messages") }}/' + messageId + '/mark-replied',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    button.remove();
                    location.reload();
                }
            }
        });
    });
});
</script>
@endsection
