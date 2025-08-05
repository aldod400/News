@extends('layouts.admin')

@section('title', 'إعدادات الموقع ومعلومات الشركة')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cogs me-2"></i>
                        إعدادات الموقع ومعلومات الشركة
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
                                    معلومات الشركة
                                </h5>
                                
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">اسم الشركة <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="company_name" name="settings[company_name]" 
                                           value="{{ \App\Models\SiteSetting::get('company_name', '') }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="company_address" class="form-label">عنوان الشركة <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="company_address" name="settings[company_address]" rows="3" required>{{ \App\Models\SiteSetting::get('company_address', '') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_city" class="form-label">المدينة <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="company_city" name="settings[company_city]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_city', '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_country" class="form-label">الدولة <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="company_country" name="settings[company_country]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_country', '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_phone" class="form-label">رقم الهاتف</label>
                                            <input type="text" class="form-control" id="company_phone" name="settings[company_phone]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_phone', '') }}" placeholder="+20-xxx-xxx-xxxx">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_email" class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="company_email" name="settings[company_email]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_email', '') }}" placeholder="info@company.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_latitude" class="form-label">خط العرض (Latitude)</label>
                                            <input type="number" step="any" class="form-control" id="company_latitude" name="settings[company_latitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_latitude', '') }}" placeholder="30.0444" readonly>
                                            <small class="form-text text-muted">سيتم ملؤه تلقائياً من الخريطة</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="company_longitude" class="form-label">خط الطول (Longitude)</label>
                                            <input type="number" step="any" class="form-control" id="company_longitude" name="settings[company_longitude]" 
                                                   value="{{ \App\Models\SiteSetting::get('company_longitude', '') }}" placeholder="31.2357" readonly>
                                            <small class="form-text text-muted">سيتم ملؤه تلقائياً من الخريطة</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Map Section -->
                            <div class="col-md-6">
                                <h5 class="mb-3">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    تحديد الموقع على الخريطة
                                </h5>
                                
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>انقر على الخريطة لتحديد الموقع</span>
                                            <button type="button" id="clearLocation" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-times"></i> مسح الموقع
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div id="map" style="height: 400px; width: 100%; z-index: 1;"></div>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            انقر على أي مكان في الخريطة لتحديد موقع الشركة. سيتم تحديث الإحداثيات تلقائياً.
                                        </small>
                                    </div>
                                </div>

                                <!-- Current Location Info -->
                                <div class="mt-3">
                                    <div class="alert alert-info" id="locationInfo" style="display: none;">
                                        <h6><i class="fas fa-map-pin"></i> الموقع المحدد:</h6>
                                        <div id="selectedLocation"></div>
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

@section('scripts')
<!-- Leaflet Maps (Open Source Alternative to Google Maps) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
/* Additional Leaflet Map Styles */
#map {
    border-radius: 0;
    position: relative;
    z-index: 1;
}

.leaflet-container {
    font-family: inherit;
}

.leaflet-popup-content-wrapper {
    border-radius: 8px;
}

.custom-div-icon {
    background: none !important;
    border: none !important;
}

.leaflet-control-zoom {
    border-radius: 8px;
    overflow: hidden;
}

.leaflet-control-zoom a {
    background-color: #fff;
    border-bottom: 1px solid #ccc;
}

.leaflet-control-zoom a:hover {
    background-color: #f4f4f4;
}
</style>

<script>
let map;
let marker;

function initMap() {
    console.log('Initializing Leaflet map...');
    
    // Default location (Cairo, Egypt)
    const defaultLat = {{ \App\Models\SiteSetting::get('company_latitude', '30.0444') }};
    const defaultLng = {{ \App\Models\SiteSetting::get('company_longitude', '31.2357') }};
    
    console.log('Default coordinates:', defaultLat, defaultLng);
    
    // Check if map container exists
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.error('Map container not found!');
        return;
    }
    
    try {
        // Initialize Leaflet map
        map = L.map('map').setView([defaultLat, defaultLng], 13);
        console.log('Map initialized successfully');

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);
        console.log('Tiles added successfully');

        // Add existing marker if coordinates exist
        if (defaultLat && defaultLng && defaultLat !== '30.0444') {
            addMarker([defaultLat, defaultLng]);
            updateLocationInfo([defaultLat, defaultLng]);
            console.log('Existing marker added');
        }

        // Add click listener to map
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            console.log('Map clicked at:', lat, lng);
            addMarker([lat, lng]);
            updateLocationInfo([lat, lng]);
            updateCoordinateFields([lat, lng]);
        });
        
    } catch (error) {
        console.error('Error initializing map:', error);
    }
}

function addMarker(location) {
    // Remove existing marker
    if (marker) {
        map.removeLayer(marker);
    }

    // Add new marker with custom icon
    const customIcon = L.divIcon({
        className: 'custom-div-icon',
        html: '<i class="fas fa-map-marker-alt" style="color: #dc3545; font-size: 24px;"></i>',
        iconSize: [24, 24],
        iconAnchor: [12, 24]
    });

    marker = L.marker(location, {
        draggable: true,
        icon: customIcon
    }).addTo(map);

    // Add drag listener to marker
    marker.on('dragend', function(e) {
        const lat = e.target.getLatLng().lat;
        const lng = e.target.getLatLng().lng;
        updateLocationInfo([lat, lng]);
        updateCoordinateFields([lat, lng]);
    });

    // Center map on marker
    map.setView(location, map.getZoom());
}

function updateLocationInfo(location) {
    const lat = location[0];
    const lng = location[1];

    // Show location info
    document.getElementById('locationInfo').style.display = 'block';
    document.getElementById('selectedLocation').innerHTML = `
        <strong>الإحداثيات:</strong><br>
        خط العرض: ${lat.toFixed(6)}<br>
        خط الطول: ${lng.toFixed(6)}<br>
        <small class="text-success"><i class="fas fa-check-circle"></i> تم تحديد الموقع بنجاح</small>
    `;
}

function updateCoordinateFields(location) {
    document.getElementById('company_latitude').value = location[0].toFixed(6);
    document.getElementById('company_longitude').value = location[1].toFixed(6);
}

// Clear location button
document.getElementById('clearLocation').addEventListener('click', function() {
    if (marker) {
        map.removeLayer(marker);
        marker = null;
    }
    document.getElementById('company_latitude').value = '';
    document.getElementById('company_longitude').value = '';
    document.getElementById('locationInfo').style.display = 'none';
    
    // Show success message
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>تم مسح الموقع بنجاح
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.querySelector('.card-body').prepend(alertDiv);
    
    // Auto remove alert after 3 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 3000);
});

// Search functionality using Nominatim (OpenStreetMap)
async function searchLocation() {
    const address = document.getElementById('company_address').value + ', ' + 
                   document.getElementById('company_city').value + ', ' + 
                   document.getElementById('company_country').value;
    
    if (address.trim() === ', , ') return;

    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1&accept-language=ar`);
        const data = await response.json();
        
        if (data && data.length > 0) {
            const lat = parseFloat(data[0].lat);
            const lng = parseFloat(data[0].lon);
            map.setView([lat, lng], 15);
            addMarker([lat, lng]);
            updateLocationInfo([lat, lng]);
            updateCoordinateFields([lat, lng]);
            
            // Show search success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-info alert-dismissible fade show mt-3';
            alertDiv.innerHTML = `
                <i class="fas fa-search me-2"></i>تم العثور على الموقع وتحديده على الخريطة
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.card-body').prepend(alertDiv);
            
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 4000);
        }
    } catch (error) {
        console.log('Search error:', error);
    }
}

// Auto-search when address fields are filled
document.getElementById('company_address').addEventListener('blur', searchLocation);
document.getElementById('company_city').addEventListener('blur', searchLocation);
document.getElementById('company_country').addEventListener('blur', searchLocation);

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    console.log('Leaflet available:', typeof L !== 'undefined');
    
    // Add a small delay to ensure the map container is ready
    setTimeout(function() {
        console.log('Initializing map after timeout...');
        initMap();
    }, 100);
});
</script>
@endsection
