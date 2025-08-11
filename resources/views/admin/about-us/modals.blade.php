<!-- Add Editorial Board Member Modal -->
<div class="modal fade" id="addEditorialModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Editorial Board Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.about-us.store-editorial') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_en">Name (English) *</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_ar">Name (Arabic) *</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position_en">Position (English) *</label>
                                <input type="text" class="form-control" id="position_en" name="position_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position_ar">Position (Arabic) *</label>
                                <input type="text" class="form-control" id="position_ar" name="position_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order">Order *</label>
                                <input type="number" class="form-control" id="order" name="order" value="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Editorial Board Member Modal -->
<div class="modal fade" id="editEditorialModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Editorial Board Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editEditorialForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_member_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name_en">Name (English) *</label>
                                <input type="text" class="form-control" id="edit_name_en" name="name_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name_ar">Name (Arabic) *</label>
                                <input type="text" class="form-control" id="edit_name_ar" name="name_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_position_en">Position (English) *</label>
                                <input type="text" class="form-control" id="edit_position_en" name="position_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_position_ar">Position (Arabic) *</label>
                                <input type="text" class="form-control" id="edit_position_ar" name="position_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_image">Image</label>
                                <input type="file" class="form-control-file" id="edit_image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_order">Order *</label>
                                <input type="number" class="form-control" id="edit_order" name="order" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="edit_is_active" name="is_active">
                            <label class="form-check-label" for="edit_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Office Modal -->
<div class="modal fade" id="addOfficeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.about-us.store-office') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_name_en">Name (English) *</label>
                                <input type="text" class="form-control" id="office_name_en" name="name_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_name_ar">Name (Arabic) *</label>
                                <input type="text" class="form-control" id="office_name_ar" name="name_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_address_en">Address (English) *</label>
                                <textarea class="form-control" id="office_address_en" name="address_en" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_address_ar">Address (Arabic) *</label>
                                <textarea class="form-control" id="office_address_ar" name="address_ar" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_phone">Phone</label>
                                <input type="text" class="form-control" id="office_phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_email">Email</label>
                                <input type="email" class="form-control" id="office_email" name="email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_image">Image</label>
                                <input type="file" class="form-control-file" id="office_image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="office_order">Order *</label>
                                <input type="number" class="form-control" id="office_order" name="order" value="0" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="office_is_active" name="is_active" checked>
                            <label class="form-check-label" for="office_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Office</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Office Modal -->
<div class="modal fade" id="editOfficeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editOfficeForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_office_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_name_en">Name (English) *</label>
                                <input type="text" class="form-control" id="edit_office_name_en" name="name_en" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_name_ar">Name (Arabic) *</label>
                                <input type="text" class="form-control" id="edit_office_name_ar" name="name_ar" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_address_en">Address (English) *</label>
                                <textarea class="form-control" id="edit_office_address_en" name="address_en" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_address_ar">Address (Arabic) *</label>
                                <textarea class="form-control" id="edit_office_address_ar" name="address_ar" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_phone">Phone</label>
                                <input type="text" class="form-control" id="edit_office_phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_email">Email</label>
                                <input type="email" class="form-control" id="edit_office_email" name="email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_image">Image</label>
                                <input type="file" class="form-control-file" id="edit_office_image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_office_order">Order *</label>
                                <input type="number" class="form-control" id="edit_office_order" name="order" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="edit_office_is_active" name="is_active">
                            <label class="form-check-label" for="edit_office_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Office</button>
                </div>
            </form>
        </div>
    </div>
</div>
