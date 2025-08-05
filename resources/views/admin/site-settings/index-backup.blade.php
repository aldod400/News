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
                                            <div>
                                                <button type="button" id="testConsole" class="btn btn-sm btn-outline-info me-2">
                                                    <i class="fas fa-bug"></i> اختبار
                                                </button>
                                                <button type="button" id="reloadMap" class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-sync-alt"></i> إعادة تحميل
                                                </button>
                                                <button type="button" id="clearLocation" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-times"></i> مسح الموقع
                                                </button>
                                            </div>
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

@section('styles')
<!-- Leaflet Maps CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
      crossorigin=""/>

<style>
/* Additional Leaflet Map Styles */
#map {
    border-radius: 8px;
    position: relative;
    z-index: 1;
    border: 2px solid #e9ecef;
    min-height: 400px;
    background: #f8f9fa;
}

.leaflet-container {
    font-family: inherit;
    height: 400px !important;
    border-radius: 8px;
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

/* Loading and error states */
#map .alert {
    margin: 0;
    border-radius: 8px;
}

/* Ensure map is visible */
.leaflet-container .leaflet-control-attribution {
    background: rgba(255, 255, 255, 0.8);
}
</style>
@endsection

@section('custom-footer')
<!-- Leaflet Maps JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
let map;
let marker;

function initMap() {
    console.log('Initializing Leaflet map...');
    
    // Default location (Cairo, Egypt) with proper escaping
    const defaultLat = parseFloat({{ json_encode(\App\Models\SiteSetting::get('company_latitude', '30.0444')) }}) || 30.0444;
    const defaultLng = parseFloat({{ json_encode(\App\Models\SiteSetting::get('company_longitude', '31.2357')) }}) || 31.2357;
    
    console.log('Default coordinates:', defaultLat, defaultLng);
    
    // Check if map container exists
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.error('Map container not found!');
        return;
    }
    
    try {
        // Clear loading indicator
        mapContainer.innerHTML = '';
        
        // Initialize Leaflet map
        map = L.map('map', {
            zoomControl: true,
            attributionControl: true
        }).setView([defaultLat, defaultLng], 13);
        
        console.log('Map initialized successfully');

        // Add OpenStreetMap tiles with error handling
        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18,
            errorTileUrl: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjU2IiBoZWlnaHQ9IjI1NiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxyZWN0IHdpZHRoPSIyNTYiIGhlaWdodD0iMjU2IiBmaWxsPSIjZjRmNGY0Ii8+CiAgICA8dGV4dCB4PSIxMjgiIHk9IjEyOCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjOTk5Ij5YPC90ZXh0Pgo8L3N2Zz4K'
        }).addTo(map);
        
        tileLayer.on('tileerror', function(error, tile) {
            console.warn('Tile loading error:', error);
        });
        
        console.log('Tiles added successfully');

        // Add existing marker if coordinates exist
        if (defaultLat && defaultLng && (defaultLat !== 30.0444 || defaultLng !== 31.2357)) {
            addMarker([defaultLat, defaultLng]);
            updateLocationInfo([defaultLat, defaultLng]);
            console.log('Existing marker added');
        }

        // Add click listener to map
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            console.log('Map clicked at:', lat, lng);
            
            // Ensure map container is still visible
            const mapContainer = document.getElementById('map');
            if (!mapContainer || !mapContainer.offsetHeight) {
                console.error('Map container lost visibility!');
                return;
            }
            
            addMarker([lat, lng]);
            updateLocationInfo([lat, lng]);
        });
        
        // Show success message and add resize observer
        console.log('Map loaded successfully!');
        
        // Add observer to detect if map container disappears
        if (window.ResizeObserver) {
            const resizeObserver = new ResizeObserver(function(entries) {
                for (let entry of entries) {
                    if (entry.contentRect.height === 0) {
                        console.warn('Map container height became 0, attempting to fix...');
                        setTimeout(() => {
                            if (map) {
                                map.invalidateSize();
                            }
                        }, 100);
                    }
                }
            });
            resizeObserver.observe(mapContainer);
        }
        
    } catch (error) {
        console.error('Error initializing map:', error);
        mapContainer.innerHTML = `
            <div class="alert alert-danger text-center p-4">
                <i class="fas fa-exclamation-triangle mb-2"></i><br>
                <strong>فشل في تحميل الخريطة</strong><br>
                <small>خطأ: ${error.message}</small><br>
                <button class="btn btn-primary btn-sm mt-2" onclick="initMap()">إعادة المحاولة</button>
            </div>
        `;
    }
}

function addMarker(location) {
    console.log('Adding marker at:', location);
    
    // Check if map exists
    if (!map) {
        console.error('Map not initialized!');
        return;
    }
    
    // Remove existing marker
    if (marker) {
        try {
            map.removeLayer(marker);
            console.log('Existing marker removed');
        } catch (e) {
            console.warn('Error removing marker:', e);
        }
    }

    try {
        // Create custom icon
        const customIcon = L.divIcon({
            className: 'custom-div-icon',
            html: '<i class="fas fa-map-marker-alt" style="color: #dc3545; font-size: 24px;"></i>',
            iconSize: [24, 24],
            iconAnchor: [12, 24]
        });

        // Add new marker
        marker = L.marker(location, {
            draggable: true,
            icon: customIcon
        }).addTo(map);

        // Add drag listener to marker
        marker.on('dragend', function(e) {
            const lat = e.target.getLatLng().lat;
            const lng = e.target.getLatLng().lng;
            console.log('Marker dragged to:', lat, lng);
            updateLocationInfo([lat, lng]);
        });

        // Center map on marker (keep current zoom level)
        map.setView(location, map.getZoom());
        
        console.log('Marker added successfully');
        
    } catch (error) {
        console.error('Error adding marker:', error);
    }
}

function updateLocationInfo(location) {
    const lat = location[0];
    const lng = location[1];

    // Show location info in existing alert element
    const locationInfo = document.getElementById('locationInfo');
    const selectedLocation = document.getElementById('selectedLocation');
    
    if (locationInfo && selectedLocation) {
        locationInfo.style.display = 'block';
        selectedLocation.innerHTML = `
            <strong>الإحداثيات:</strong><br>
            خط العرض: ${lat.toFixed(6)}<br>
            خط الطول: ${lng.toFixed(6)}<br>
            <small class="text-success"><i class="fas fa-check-circle"></i> تم تحديد الموقع بنجاح</small>
        `;
    }
    
    // Update coordinate fields
    updateCoordinateFields(location);
    
    console.log('Location updated:', lat, lng);
}

function updateCoordinateFields(location) {
    document.getElementById('company_latitude').value = location[0].toFixed(6);
    document.getElementById('company_longitude').value = location[1].toFixed(6);
}

// Clear location function
function clearLocation() {
    console.log('Clearing location...');
    
    if (marker && map) {
        map.removeLayer(marker);
        marker = null;
    }
    
    // Clear form fields
    const latField = document.getElementById('company_latitude');
    const lngField = document.getElementById('company_longitude');
    const locationInfo = document.getElementById('locationInfo');
    
    if (latField) latField.value = '';
    if (lngField) lngField.value = '';
    if (locationInfo) locationInfo.style.display = 'none';
    
    console.log('Location cleared successfully');
}

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
const addressField = document.getElementById('company_address');
const cityField = document.getElementById('company_city');
const countryField = document.getElementById('company_country');

if (addressField) addressField.addEventListener('blur', searchLocation);
if (cityField) cityField.addEventListener('blur', searchLocation);
if (countryField) countryField.addEventListener('blur', searchLocation);

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Site Settings Page');
    console.log('jQuery available:', typeof $ !== 'undefined');
    console.log('Leaflet available:', typeof L !== 'undefined');
    console.log('Map container exists:', !!document.getElementById('map'));
    console.log('Reload button exists:', !!document.getElementById('reloadMap'));
    console.log('Clear button exists:', !!document.getElementById('clearLocation'));
    console.log('Test button exists:', !!document.getElementById('testConsole'));
    
    // Check if Leaflet is loaded
    if (typeof L === 'undefined') {
        console.error('Leaflet library not loaded!');
        const mapContainer = document.getElementById('map');
        if (mapContainer) {
            mapContainer.innerHTML = `
                <div class="alert alert-danger text-center p-4">
                    <i class="fas fa-exclamation-triangle"></i><br>
                    فشل في تحميل مكتبة الخرائط<br>
                    <small>تأكد من اتصال الإنترنت</small><br>
                    <button class="btn btn-primary btn-sm mt-2" onclick="location.reload()">إعادة تحميل الصفحة</button>
                </div>
            `;
        }
        return;
    }
    
    // Check if map container exists
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.error('Map container not found!');
        return;
    }
    
    console.log('Map container dimensions:', {
        width: mapContainer.offsetWidth,
        height: mapContainer.offsetHeight,
        display: window.getComputedStyle(mapContainer).display,
        visibility: window.getComputedStyle(mapContainer).visibility
    });
    
    // Add loading indicator
    mapContainer.innerHTML = '<div class="text-center p-4"><i class="fas fa-spinner fa-spin"></i> جاري تحميل الخريطة...</div>';
    
    // Setup button event listeners
    setupEventListeners();
    
    // Add a delay to ensure everything is ready
    setTimeout(function() {
        console.log('Initializing map after timeout...');
        try {
            initMap();
        } catch (error) {
            console.error('Map initialization failed:', error);
            mapContainer.innerHTML = `
                <div class="alert alert-warning text-center p-4">
                    <i class="fas fa-map"></i><br>
                    حدث خطأ في تحميل الخريطة<br>
                    <small>خطأ: ${error.message}</small><br>
                    <button class="btn btn-primary btn-sm mt-2" onclick="location.reload()">إعادة المحاولة</button>
                </div>
            `;
        }
    }, 1000);
});

// Setup event listeners function
function setupEventListeners() {
    console.log('Setting up event listeners...');
    
    // Test button
    const testBtn = document.getElementById('testConsole');
    if (testBtn) {
        testBtn.addEventListener('click', function() {
            console.log('=== DIAGNOSTIC INFO ===');
            console.log('Map container:', document.getElementById('map'));
            console.log('Leaflet available:', typeof L !== 'undefined');
            console.log('Map object:', map);
            console.log('Marker object:', marker);
            console.log('Map container visible:', !!document.getElementById('map').offsetHeight);
            alert('معلومات التشخيص في console (F12)');
        });
        console.log('Test button listener added');
    }
    
    // Reload button
    const reloadBtn = document.getElementById('reloadMap');
    if (reloadBtn) {
        reloadBtn.addEventListener('click', function() {
            console.log('Reloading map...');
            const mapContainer = document.getElementById('map');
            if (mapContainer) {
                mapContainer.innerHTML = '<div class="text-center p-4"><i class="fas fa-spinner fa-spin"></i> جاري إعادة تحميل الخريطة...</div>';
            }
            
            // Destroy existing map if it exists
            if (map) {
                try {
                    map.remove();
                    map = null;
                    marker = null;
                    console.log('Map destroyed');
                } catch (e) {
                    console.log('Error destroying map:', e);
                }
            }
            
            // Reinitialize after a short delay
            setTimeout(function() {
                initMap();
            }, 500);
        });
        console.log('Reload button listener added');
    }
    
    // Clear button
    const clearBtn = document.getElementById('clearLocation');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            clearLocation();
        });
        console.log('Clear button listener added');
    }
}
</script>
@endsection
