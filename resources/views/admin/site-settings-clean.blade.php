@extends('layouts.admin')

@section('title', 'اختبار إعدادات الموقع - بدون بيانات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اختبار الخريطة - إعدادات الموقع</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        <strong>ملاحظة:</strong> هذه نسخة اختبار بدون بيانات ديناميكية لحل مشكلة Syntax Error
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5>معلومات الشركة</h5>
                            <div class="form-group mb-3">
                                <label>اسم الشركة</label>
                                <input type="text" class="form-control" value="شركة الأخبار" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>العنوان</label>
                                <textarea class="form-control" readonly>شارع التحرير، وسط البلد</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>تحديد الموقع على الخريطة</h5>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>انقر على الخريطة لتحديد الموقع</span>
                                        <div>
                                            <button type="button" id="testBtn" class="btn btn-sm btn-outline-info me-2">
                                                <i class="fas fa-bug"></i> اختبار
                                            </button>
                                            <button type="button" id="reloadBtn" class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-sync-alt"></i> إعادة تحميل
                                            </button>
                                            <button type="button" id="clearBtn" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-times"></i> مسح
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div id="testMap" style="height: 400px; width: 100%;"></div>
                                </div>
                                <div class="card-footer">
                                    <div id="locationInfo" style="display: none;">
                                        <h6><i class="fas fa-map-pin"></i> الموقع المحدد:</h6>
                                        <div id="selectedLocation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<style>
#testMap {
    border-radius: 8px;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    min-height: 400px;
}
.leaflet-container {
    height: 400px !important;
    border-radius: 8px;
}
.custom-div-icon {
    background: none !important;
    border: none !important;
}
</style>
@endsection

@section('custom-footer')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
let testMap;
let testMarker;

function initTestMap() {
    console.log('Starting map initialization...');
    
    // Fixed coordinates (Cairo, Egypt)
    const defaultLat = 30.0444;
    const defaultLng = 31.2357;
    
    const mapContainer = document.getElementById('testMap');
    if (!mapContainer) {
        console.error('Map container not found!');
        return;
    }
    
    console.log('Map container found, dimensions:', {
        width: mapContainer.offsetWidth,
        height: mapContainer.offsetHeight
    });
    
    try {
        // Clear container
        mapContainer.innerHTML = '';
        
        // Initialize map
        testMap = L.map('testMap').setView([defaultLat, defaultLng], 10);
        console.log('Map object created successfully');
        
        // Add tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(testMap);
        console.log('Tiles added successfully');
        
        // Add click handler
        testMap.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            console.log('Map clicked at:', lat, lng);
            
            // Remove existing marker
            if (testMarker) {
                testMap.removeLayer(testMarker);
            }
            
            // Add new marker
            testMarker = L.marker([lat, lng], {draggable: true}).addTo(testMap);
            
            // Update location info
            document.getElementById('locationInfo').style.display = 'block';
            document.getElementById('selectedLocation').innerHTML = 
                '<strong>الإحداثيات:</strong><br>' +
                'خط العرض: ' + lat.toFixed(6) + '<br>' +
                'خط الطول: ' + lng.toFixed(6);
        });
        
        console.log('Map initialized successfully!');
        
    } catch (error) {
        console.error('Map initialization error:', error);
        mapContainer.innerHTML = 
            '<div class="alert alert-danger text-center p-4">' +
            '<i class="fas fa-exclamation-triangle"></i><br>' +
            'خطأ في تحميل الخريطة<br>' +
            '<small>' + error.message + '</small>' +
            '</div>';
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded for site settings test');
    console.log('Leaflet available:', typeof L !== 'undefined');
    
    // Test button
    const testBtn = document.getElementById('testBtn');
    if (testBtn) {
        testBtn.addEventListener('click', function() {
            console.log('=== DIAGNOSTIC INFO ===');
            console.log('Map container:', document.getElementById('testMap'));
            console.log('Leaflet loaded:', typeof L !== 'undefined');
            console.log('Map object:', testMap);
            console.log('Marker object:', testMarker);
            console.log('Buttons exist:', {
                test: !!document.getElementById('testBtn'),
                reload: !!document.getElementById('reloadBtn'),
                clear: !!document.getElementById('clearBtn')
            });
            alert('تم طباعة معلومات التشخيص في console. اضغط F12 لرؤيتها.');
        });
    }
    
    // Reload button
    const reloadBtn = document.getElementById('reloadBtn');
    if (reloadBtn) {
        reloadBtn.addEventListener('click', function() {
            console.log('Reloading map...');
            if (testMap) {
                testMap.remove();
                testMap = null;
                testMarker = null;
            }
            document.getElementById('locationInfo').style.display = 'none';
            setTimeout(initTestMap, 500);
        });
    }
    
    // Clear button
    const clearBtn = document.getElementById('clearBtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            console.log('Clearing marker...');
            if (testMarker && testMap) {
                testMap.removeLayer(testMarker);
                testMarker = null;
                document.getElementById('locationInfo').style.display = 'none';
            }
        });
    }
    
    // Initialize map after a delay
    setTimeout(function() {
        if (typeof L !== 'undefined') {
            initTestMap();
        } else {
            console.error('Leaflet not loaded!');
            document.getElementById('testMap').innerHTML = 
                '<div class="alert alert-danger text-center p-4">' +
                'فشل في تحميل مكتبة Leaflet' +
                '</div>';
        }
    }, 1000);
});
</script>
@endsection
