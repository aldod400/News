@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ __('general.news') }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">{{ __('general.news') }}</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>{{ __('admin.manage') }}</a>
                    </li>
                </ul>
            </div>
            {{-- Content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('admin.manage_news') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('admin.title') }}</th>
                                            <th>{{ __('general.category') }}</th>
                                            <th>{{ __('admin.author') }}</th>
                                            <th>{{ __('admin.updated_at') }}</th>
                                            <th>{{ __('admin.status') }}</th>
                                            <th style="width: 10%">{{ __('admin.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Updated At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($allNews as $news)
                                            <tr>
                                                <td>{{ $news->id }}</td>
                                                <td>{{ $news->title }}</td>
                                                <td>{{ $news->category->name }}</td>
                                                <td>{{ $news->author->name }}</td>
                                                <td>{{ $news->updated_at->translatedFormat('m/d/Y H:i') }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="{{ $news->status == 'Accept' ? 'badge bg-success' : ($news->status == 'Reject' ? 'badge bg-danger' : ($news->status == 'Pending' ? 'badge bg-warning' : '')) }}">
                                                        {{ $news->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-button-action d-flex justify-content-center align-items-center">
                                                        <span data-bs-toggle="tooltip" title="Edit">
                                                            <a href="{{ route('admin.news.edit', $news->id) }}" 
                                                               class="btn btn-link btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </span>
                                                        <span data-bs-toggle="tooltip" title="Delete">
                                                            <form action="{{ route('admin.news.destroy', $news->id) }}"
                                                                id="deleteButton" data-id="{{ $news->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link btn-danger">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </div>
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
        </div>
    </div>
@endsection

@section('custom-footer')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endsection
