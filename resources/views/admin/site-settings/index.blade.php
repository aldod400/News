@extends('layouts.admin')

@section('title', __('admin.site_settings_management'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs me-2"></i>
                        {{ __('admin.site_settings_management') }}
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.site-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Company Information -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-building text-primary"></i>
                                    {{ __('admin.company_info') }}
                                </h5>
                                
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">{{ __('general.name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="company_name" name="settings[company_name]" 
                                           value="{{ \App\Models\SiteSetting::get('company_name', '') }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="company_address" class="form-label">
                                        {{ __('admin.company_address') }} <span class="text-danger">*</span>
                                        <small class="text-muted">({{ __('admin.address_update_note') }})</small>
                                    </label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="company_address" name="settings[company_address]" rows="3" required>{{ \App\Models\SiteSetting::get('company_address', '') }}</textarea>
                                        <button type="button" class="btn btn-outline-secondary" id="updateAddressBtn" title="{{ __('admin.update_address_from_map') }}">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                    <small class="form-text text-info">
                                        <i class="fas fa-info-circle"></i>
                                        {{ __('admin.map_info_text') }}
                                    </small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_city" class="form-label">{{ __('admin.city') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="company_city" name="settings[company_city]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_city', '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_country" class="form-label">{{ __('admin.country') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="company_country" name="settings[company_country]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_country', '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_phone" class="form-label">{{ __('admin.phone_number') }}</label>
                                            <input type="text" class="form-control" id="company_phone" name="settings[company_phone]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_phone', '') }}" placeholder="+20-xxx-xxx-xxxx">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_email" class="form-label">{{ __('admin.email') }}</label>
                                            <input type="email" class="form-control" id="company_email" name="settings[company_email]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_email', '') }}" placeholder="info@company.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_latitude" class="form-label">{{ __('admin.latitude') }}</label>
                                            <input type="number" step="any" class="form-control" id="company_latitude" name="settings[company_latitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_latitude', '') }}" placeholder="30.0444">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_longitude" class="form-label">{{ __('admin.longitude') }}</label>
                                            <input type="number" step="any" class="form-control" id="company_longitude" name="settings[company_longitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_longitude', '') }}" placeholder="31.2357">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media Links Section -->
                            <div class="col-md-12 mt-4">
                                <div class="social-media-section">
                                    <h5 class="mb-3">
                                        <i class="fas fa-share-alt text-info"></i>
                                        {{ __('admin.social_media_links') }}
                                    </h5>
                                    <p class="text-muted mb-4">{{ __('admin.social_media_description') }}</p>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="social_twitter" class="form-label">
                                            <i class="fab fa-twitter text-primary me-2"></i>Twitter
                                        </label>
                                        <input type="url" class="form-control" id="social_twitter" name="settings[social_twitter]" 
                                               value="{{ \App\Models\SiteSetting::get('social_twitter', '') }}" placeholder="https://twitter.com/yourhandle">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="social_facebook" class="form-label">
                                            <i class="fab fa-facebook-f text-primary me-2"></i>Facebook
                                        </label>
                                        <input type="url" class="form-control" id="social_facebook" name="settings[social_facebook]" 
                                               value="{{ \App\Models\SiteSetting::get('social_facebook', '') }}" placeholder="https://facebook.com/yourpage">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="social_youtube" class="form-label">
                                            <i class="fab fa-youtube text-danger me-2"></i>YouTube
                                        </label>
                                        <input type="url" class="form-control" id="social_youtube" name="settings[social_youtube]" 
                                               value="{{ \App\Models\SiteSetting::get('social_youtube', '') }}" placeholder="https://youtube.com/yourchannel">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="social_instagram" class="form-label">
                                            <i class="fab fa-instagram text-danger me-2"></i>Instagram
                                        </label>
                                        <input type="url" class="form-control" id="social_instagram" name="settings[social_instagram]" 
                                               value="{{ \App\Models\SiteSetting::get('social_instagram', '') }}" placeholder="https://instagram.com/youraccount">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="social_linkedin" class="form-label">
                                            <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn
                                        </label>
                                        <input type="url" class="form-control" id="social_linkedin" name="settings[social_linkedin]" 
                                               value="{{ \App\Models\SiteSetting::get('social_linkedin', '') }}" placeholder="https://linkedin.com/company/yourcompany">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="social_pinterest" class="form-label">
                                            <i class="fab fa-pinterest text-danger me-2"></i>Pinterest
                                        </label>
                                        <input type="url" class="form-control" id="social_pinterest" name="settings[social_pinterest]" 
                                               value="{{ \App\Models\SiteSetting::get('social_pinterest', '') }}" placeholder="https://pinterest.com/youraccount">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="social_timber" class="form-label">
                                            <i class="fas fa-tree text-success me-2"></i>Timber
                                        </label>
                                        <input type="url" class="form-control" id="social_timber" name="settings[social_timber]" 
                                               value="{{ \App\Models\SiteSetting::get('social_timber', '') }}" placeholder="https://timber.com/youraccount">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="social_github" class="form-label">
                                            <i class="fab fa-github text-dark me-2"></i>GitHub
                                        </label>
                                        <input type="url" class="form-control" id="social_github" name="settings[social_github]" 
                                               value="{{ \App\Models\SiteSetting::get('social_github', '') }}" placeholder="https://github.com/youraccount">
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Simple Map Section -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    {{ __('admin.interactive_map') }}
                                </h5>
                                
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>{{ __('admin.click_map_to_select') }}</span>
                                            <button type="button" id="reloadMapBtn" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-sync-alt"></i> {{ __('admin.reload_map') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div id="mapContainer" style="height: 400px; background: #f8f9fa; border-radius: 8px; position: relative;">
                                            <div class="text-center p-4">
                                                <i class="fas fa-spinner fa-spin"></i> {{ __('admin.loading_map') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div id="locationDisplay" class="text-muted" style="display: none;">
                                            <small>{{ __('admin.selected_location') }}: <span id="coordinateText"></span></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-right"></i> العودة للوحة التحكم
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ الإعدادات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
#mapContainer {
    border: 2px solid #dee2e6;
    border-radius: 8px;
}
.leaflet-container {
    height: 400px !important;
    border-radius: 8px;
}

/* Social Media Section Styling */
.social-media-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    border: 1px solid #e9ecef;
}

.social-media-section .form-label {
    font-weight: 600;
    margin-bottom: 8px;
}

.social-media-section .form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.social-media-section .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.social-media-section .fab,
.social-media-section .fas {
    font-size: 16px;
}
</style>
@endsection

@section('custom-footer')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Simple map variables
let simpleMap = null;
let simpleMarker = null;

// Get saved coordinates
const savedLat = {{ \App\Models\SiteSetting::get('company_latitude', '30.0444') }};
const savedLng = {{ \App\Models\SiteSetting::get('company_longitude', '31.2357') }};

console.log('Saved coordinates:', savedLat, savedLng);

function initSimpleMap() {
    console.log('Starting simple map initialization...');
    
    const container = document.getElementById('mapContainer');
    if (!container) {
        console.error('Map container not found!');
        return;
    }
    
    try {
        // Clear container
        container.innerHTML = '';
        
        // Create map
        simpleMap = L.map('mapContainer').setView([savedLat, savedLng], 13);
        
        // Add tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(simpleMap);
        
        // Add existing marker if coordinates exist
        if (savedLat && savedLng) {
            addSimpleMarker([savedLat, savedLng]);
        }
        
        // Add click listener
        simpleMap.on('click', function(e) {
            console.log('Map clicked at:', e.latlng.lat, e.latlng.lng);
            addSimpleMarker([e.latlng.lat, e.latlng.lng]);
            updateCoordinates(e.latlng.lat, e.latlng.lng);
            // Get address for the selected location
            getAddressFromCoordinates(e.latlng.lat, e.latlng.lng);
        });
        
        console.log('Simple map loaded successfully!');
        
    } catch (error) {
        console.error('Error initializing simple map:', error);
        container.innerHTML = '<div class="alert alert-danger p-3">خطأ في تحميل الخريطة: ' + error.message + '</div>';
    }
}

function addSimpleMarker(coords) {
    if (simpleMarker) {
        simpleMap.removeLayer(simpleMarker);
    }
    
    // Create marker with popup
    simpleMarker = L.marker(coords).addTo(simpleMap);
    
    // Add popup with coordinates
    const popupContent = `
        <div style="text-align: center;">
            <strong>الموقع المحدد</strong><br>
            <small>خط العرض: ${coords[0].toFixed(6)}<br>
            خط الطول: ${coords[1].toFixed(6)}</small>
        </div>
    `;
    simpleMarker.bindPopup(popupContent).openPopup();
    
    // Center map on marker
    simpleMap.setView(coords, simpleMap.getZoom());
    
    // Show coordinates in footer
    document.getElementById('locationDisplay').style.display = 'block';
    document.getElementById('coordinateText').innerHTML = `
        <strong>الإحداثيات:</strong> ${coords[0].toFixed(6)}, ${coords[1].toFixed(6)}<br>
        <small class="text-muted">جاري البحث عن العنوان...</small>
    `;
}

function updateCoordinates(lat, lng) {
    document.getElementById('company_latitude').value = lat.toFixed(6);
    document.getElementById('company_longitude').value = lng.toFixed(6);
}

// Get address from coordinates using Nominatim (OpenStreetMap)
async function getAddressFromCoordinates(lat, lng) {
    console.log('Getting address for coordinates:', lat, lng);
    
    try {
        // Show loading message
        const addressField = document.getElementById('company_address');
        const cityField = document.getElementById('company_city');
        const countryField = document.getElementById('company_country');
        
        if (addressField) {
            addressField.value = 'جاري البحث عن العنوان...';
            addressField.style.backgroundColor = '#f8f9fa';
        }
        
        // Make request to Nominatim
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=ar,en`);
        const data = await response.json();
        
        console.log('Address data received:', data);
        
        if (data && data.display_name) {
            // Extract address components
            const address = data.address || {};
            
            // Build full address
            let fullAddress = '';
            if (address.house_number) fullAddress += address.house_number + ' ';
            if (address.road) fullAddress += address.road + ', ';
            if (address.neighbourhood) fullAddress += address.neighbourhood + ', ';
            if (address.suburb) fullAddress += address.suburb + ', ';
            
            // If no detailed address, use display name parts
            if (!fullAddress.trim()) {
                const parts = data.display_name.split(',');
                fullAddress = parts.slice(0, 2).join(', ');
            }
            
            // Remove trailing comma
            fullAddress = fullAddress.replace(/,\s*$/, '');
            
            // Update form fields
            if (addressField && fullAddress) {
                addressField.value = fullAddress;
                addressField.style.backgroundColor = '#d4edda'; // Light green
                setTimeout(() => {
                    addressField.style.backgroundColor = '';
                }, 2000);
            }
            
            if (cityField) {
                const city = address.city || address.town || address.village || address.state_district || '';
                if (city) {
                    cityField.value = city;
                    cityField.style.backgroundColor = '#d4edda';
                    setTimeout(() => {
                        cityField.style.backgroundColor = '';
                    }, 2000);
                }
            }
            
            if (countryField) {
                const country = address.country || '';
                if (country) {
                    countryField.value = country;
                    countryField.style.backgroundColor = '#d4edda';
                    setTimeout(() => {
                        countryField.style.backgroundColor = '';
                    }, 2000);
                }
            }
            
            // Update location display
            const locationDisplay = document.getElementById('locationDisplay');
            const coordinateText = document.getElementById('coordinateText');
            if (locationDisplay && coordinateText) {
                locationDisplay.style.display = 'block';
                coordinateText.innerHTML = `
                    <strong>الإحداثيات:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
                    <strong>العنوان:</strong> ${data.display_name}
                `;
            }
            
            console.log('Address updated successfully');
            
        } else {
            console.warn('No address data found');
            if (addressField) {
                addressField.value = '';
                addressField.placeholder = 'لم يتم العثور على عنوان لهذا الموقع';
            }
        }
        
    } catch (error) {
        console.error('Error getting address:', error);
        
        const addressField = document.getElementById('company_address');
        if (addressField) {
            addressField.value = '';
            addressField.placeholder = 'خطأ في الحصول على العنوان';
            addressField.style.backgroundColor = '#f8d7da'; // Light red
            setTimeout(() => {
                addressField.style.backgroundColor = '';
                addressField.placeholder = '';
            }, 3000);
        }
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking Leaflet...');
    console.log('Leaflet available:', typeof L !== 'undefined');
    
    setTimeout(function() {
        if (typeof L !== 'undefined') {
            initSimpleMap();
        } else {
            console.error('Leaflet not loaded!');
            const container = document.getElementById('mapContainer');
            if (container) {
                container.innerHTML = '<div class="alert alert-warning p-3">فشل في تحميل مكتبة الخرائط</div>';
            }
        }
    }, 1000);
});

// Reload button
document.addEventListener('DOMContentLoaded', function() {
    const reloadBtn = document.getElementById('reloadMapBtn');
    if (reloadBtn) {
        reloadBtn.addEventListener('click', function() {
            console.log('Reloading simple map...');
            if (simpleMap) {
                simpleMap.remove();
                simpleMap = null;
                simpleMarker = null;
            }
            setTimeout(initSimpleMap, 500);
        });
    }
    
    // Update address button
    const updateAddressBtn = document.getElementById('updateAddressBtn');
    if (updateAddressBtn) {
        updateAddressBtn.addEventListener('click', function() {
            const lat = document.getElementById('company_latitude').value;
            const lng = document.getElementById('company_longitude').value;
            
            if (lat && lng) {
                console.log('Manually updating address for:', lat, lng);
                updateAddressBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                updateAddressBtn.disabled = true;
                
                getAddressFromCoordinates(parseFloat(lat), parseFloat(lng)).then(() => {
                    updateAddressBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
                    updateAddressBtn.disabled = false;
                }).catch(() => {
                    updateAddressBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
                    updateAddressBtn.disabled = false;
                });
            } else {
                alert('يرجى تحديد موقع على الخريطة أولاً أو إدخال الإحداثيات');
            }
        });
    }
});
</script>
@endsection
