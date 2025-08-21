@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Sub Category</h3>
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
                        <a href="{{ route('admin.subcategory.manage') }}">Sub Category</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Manage</a>
                    </li>
                </ul>
            </div>

            {{-- Content --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage Sub Categories</h4>
                                <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Sub Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Parent Category</th>
                                            <th>Total News</th>
                                            <th style="width: 5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Parent Category</th>
                                            <th>Total News</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($allSubCategories as $subCategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subCategory->id }}</td>
                                                <td>{{ $subCategory->name }}</td>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $subCategory->parentCategory->name }}
                                                    </span>
                                                </td>
                                                <td>{{ $subCategory->news->count() }}</td>
                                                <td>
                                                    <div class="form-button-action d-flex justify-content-center align-items-center">
                                                        <span data-bs-toggle="tooltip" title="Edit">
                                                            <a href="{{ route('admin.subcategory.edit', $subCategory->id) }}" class="btn btn-link btn-primary btn-lg">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </span>

                                                        <span data-bs-toggle="tooltip" title="Delete">
                                                            <form action="{{ route('admin.subcategory.destroy', $subCategory->id) }}" 
                                                                  id="deleteButton" data-id="{{ $subCategory->id }}">
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
        $("#add-row").DataTable({
            pageLength: 5,
        });
    </script>
@endsection
