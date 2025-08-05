@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">About Us Management</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Description Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Company Description</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about-us.update-description') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_en">Description (English) *</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                      id="description_en" 
                                      name="description_en" 
                                      rows="10" 
                                      required>{{ old('description_en', $aboutUs ? $aboutUs->raw_description['en'] ?? '' : '') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_ar">Description (Arabic) *</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                      id="description_ar" 
                                      name="description_ar" 
                                      rows="10" 
                                      required>{{ old('description_ar', $aboutUs ? $aboutUs->raw_description['ar'] ?? '' : '') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Description
                </button>
            </form>
        </div>
    </div>

    <!-- Editorial Board Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Editorial Board</h6>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addEditorialModal">
                <i class="fas fa-plus"></i> Add Member
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name (EN)</th>
                            <th>Name (AR)</th>
                            <th>Position (EN)</th>
                            <th>Position (AR)</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($editorialBoard as $member)
                        <tr>
                            <td>
                                @if($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}" 
                                         alt="{{ $member->raw_name['en'] ?? 'N/A' }}" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $member->raw_name['en'] ?? 'N/A' }}</td>
                            <td>{{ $member->raw_name['ar'] ?? 'N/A' }}</td>
                            <td>{{ $member->raw_position['en'] ?? 'N/A' }}</td>
                            <td>{{ $member->raw_position['ar'] ?? 'N/A' }}</td>
                            <td>{{ $member->order }}</td>
                            <td>
                                @if($member->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-editorial-btn" 
                                        data-member="{{ json_encode($member) }}"
                                        data-toggle="modal" 
                                        data-target="#editEditorialModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="{{ route('admin.about-us.delete-editorial', $member) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this member?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Offices Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Offices</h6>
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addOfficeModal">
                <i class="fas fa-plus"></i> Add Office
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name (EN)</th>
                            <th>Name (AR)</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offices as $office)
                        <tr>
                            <td>
                                @if($office->image)
                                    <img src="{{ asset('storage/' . $office->image) }}" 
                                         alt="{{ $office->raw_name['en'] ?? 'N/A' }}" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-building text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $office->raw_name['en'] ?? 'N/A' }}</td>
                            <td>{{ $office->raw_name['ar'] ?? 'N/A' }}</td>
                            <td>{{ $office->phone ?? 'N/A' }}</td>
                            <td>{{ $office->email ?? 'N/A' }}</td>
                            <td>{{ $office->order }}</td>
                            <td>
                                @if($office->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-office-btn" 
                                        data-office="{{ json_encode($office) }}"
                                        data-toggle="modal" 
                                        data-target="#editOfficeModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="{{ route('admin.about-us.delete-office', $office) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this office?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

@include('admin.about-us.modals')
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    ClassicEditor.create(document.querySelector('#description_en')).catch(error => { console.error(error); });
    ClassicEditor.create(document.querySelector('#description_ar')).catch(error => { console.error(error); });
    
    // Edit Editorial Board Member
    $('.edit-editorial-btn').click(function() {
        const member = $(this).data('member');
        $('#edit_member_id').val(member.id);
        $('#edit_name_en').val(member.raw_name.en);
        $('#edit_name_ar').val(member.raw_name.ar);
        $('#edit_position_en').val(member.raw_position.en);
        $('#edit_position_ar').val(member.raw_position.ar);
        $('#edit_order').val(member.order);
        $('#edit_is_active').prop('checked', member.is_active);
        $('#editEditorialForm').attr('action', `/admin/about-us/editorial-board/${member.id}`);
    });
    
    // Edit Office
    $('.edit-office-btn').click(function() {
        const office = $(this).data('office');
        $('#edit_office_id').val(office.id);
        $('#edit_office_name_en').val(office.raw_name.en);
        $('#edit_office_name_ar').val(office.raw_name.ar);
        $('#edit_office_address_en').val(office.raw_address.en);
        $('#edit_office_address_ar').val(office.raw_address.ar);
        $('#edit_office_phone').val(office.phone);
        $('#edit_office_email').val(office.email);
        $('#edit_office_order').val(office.order);
        $('#edit_office_is_active').prop('checked', office.is_active);
        $('#editOfficeForm').attr('action', `/admin/about-us/offices/${office.id}`);
    });
</script>
@endsection
