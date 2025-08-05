@extends('layouts.admin')

@section('title', 'اختبار الخريطة - Admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اختبار الخريطة في Admin Layout</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>اختبار:</strong> هذه صفحة لاختبار الخريطة داخل الـ admin layout
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>اختبار الخريطة</span>
                                        <div>
                                            <button type="button" id="testBtn" class="btn btn-sm btn-outline-info me-2">
                                                اختبار
                                            </button>
                                            <button type="button" id="reloadBtn" class="btn btn-sm btn-outline-primary">
                                                إعادة تحميل
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div id="testMap" style="height: 400px; width: 100%; background: #f8f9fa; border: 2px solid #ddd;"></div>
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
}
.leaflet-container {
    height: 400px !important;
    border-radius: 8px;
}
</style>
@endsection

@section('custom-footer')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
let testMap;

function initTestMap() {
    console.log('Initializing test map...');
    
    const container = document.getElementById('testMap');
    if (!container) {
        console.error('Test map container not found!');
        return;
    }
    
    container.innerHTML = '<div class="text-center p-4">جاري التحميل...</div>';
    
    try {
        testMap = L.map('testMap').setView([30.0444, 31.2357], 10);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(testMap);
        
        testMap.on('click', function(e) {
            L.marker([e.latlng.lat, e.latlng.lng]).addTo(testMap);
        });
        
        console.log('Test map loaded successfully!');
        
    } catch (error) {
        console.error('Test map error:', error);
        container.innerHTML = '<div class="alert alert-danger p-3">خطأ: ' + error.message + '</div>';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('Test page loaded');
    console.log('Leaflet available:', typeof L !== 'undefined');
    
    // Test button
    const testBtn = document.getElementById('testBtn');
    if (testBtn) {
        testBtn.addEventListener('click', function() {
            console.log('=== TEST INFO ===');
            console.log('Container:', document.getElementById('testMap'));
            console.log('Leaflet:', typeof L !== 'undefined');
            console.log('Map object:', testMap);
            alert('تحقق من console للمعلومات');
        });
    }
    
    // Reload button
    const reloadBtn = document.getElementById('reloadBtn');
    if (reloadBtn) {
        reloadBtn.addEventListener('click', function() {
            if (testMap) {
                testMap.remove();
                testMap = null;
            }
            setTimeout(initTestMap, 500);
        });
    }
    
    // Initialize map
    setTimeout(function() {
        if (typeof L !== 'undefined') {
            initTestMap();
        } else {
            document.getElementById('testMap').innerHTML = '<div class="alert alert-warning p-3">Leaflet library not loaded</div>';
        }
    }, 1000);
});
</script>
@endsection
