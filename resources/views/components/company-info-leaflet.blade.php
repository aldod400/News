@if(hasCompanyLocation() && getCompanyInfo('name'))
<section class="company-info py-5" id="company-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">{{ getCompanyInfo('name') }}</h2>
                    <p class="section-subtitle text-muted">معلومات الاتصال والموقع</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- Company Information -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="company-details">
                    <div class="company-info-card">
                        <h3 class="mb-4">
                            <i class="fas fa-building text-primary me-2"></i>
                            معلومات الشركة
                        </h3>

                        @if(getCompanyInfo('address'))
                        <div class="info-item mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-map-marker-alt text-danger me-3 mt-1"></i>
                                <div>
                                    <h6 class="mb-1">العنوان</h6>
                                    <p class="text-muted mb-0">{{ getCompanyFullAddress() }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(getCompanyInfo('phone'))
                        <div class="info-item mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone text-success me-3"></i>
                                <div>
                                    <h6 class="mb-1">رقم الهاتف</h6>
                                    <p class="text-muted mb-0">
                                        <a href="tel:{{ getCompanyInfo('phone') }}" class="text-decoration-none">
                                            {{ getCompanyInfo('phone') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(getCompanyInfo('email'))
                        <div class="info-item mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-info me-3"></i>
                                <div>
                                    <h6 class="mb-1">البريد الإلكتروني</h6>
                                    <p class="text-muted mb-0">
                                        <a href="mailto:{{ getCompanyInfo('email') }}" class="text-decoration-none">
                                            {{ getCompanyInfo('email') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(getGoogleMapsLink())
                        <div class="mt-4">
                            <a href="{{ getGoogleMapsLink() }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-directions me-2"></i>
                                احصل على الاتجاهات
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="col-lg-6">
                <div class="map-container">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-map text-primary me-2"></i>
                                موقعنا على الخريطة
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div id="company-map" style="height: 350px; width: 100%;"></div>
                        </div>
                        @if(getGoogleMapsLink())
                        <div class="card-footer text-center">
                            <a href="{{ getGoogleMapsLink() }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-external-link-alt me-1"></i>
                                فتح في خرائط جوجل
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
.company-info {
    background-color: #f8f9fa;
}

.company-info-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.info-item {
    padding: 1rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item h6 {
    color: #495057;
    font-weight: 600;
}

.info-item .fas {
    font-size: 1.2rem;
    width: 25px;
    text-align: center;
}

.map-container .card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}

.section-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    font-size: 1.1rem;
}

.custom-div-icon {
    background: none;
    border: none;
}

@media (max-width: 768px) {
    .company-info-card {
        padding: 1.5rem;
    }
    
    #company-map {
        height: 250px !important;
    }
}
</style>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
function initCompanyMap() {
    @if(hasCompanyLocation())
    const companyLocation = [
        {{ getCompanyLocation()['latitude'] }},
        {{ getCompanyLocation()['longitude'] }}
    ];

    // Initialize Leaflet map
    const map = L.map("company-map").setView(companyLocation, 15);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18
    }).addTo(map);

    // Create custom icon
    const customIcon = L.divIcon({
        className: 'custom-div-icon',
        html: '<i class="fas fa-map-marker-alt" style="color: #dc3545; font-size: 30px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    // Add marker
    const marker = L.marker(companyLocation, {
        icon: customIcon
    }).addTo(map);

    @if(getCompanyInfo('name') && getCompanyFullAddress())
    // Add popup to marker
    const popupContent = `
        <div style="padding: 10px; min-width: 200px; text-align: center;">
            <h6 style="margin: 0 0 10px 0; color: #2c3e50; font-weight: bold; font-size: 16px;">
                {{ getCompanyInfo('name') }}
            </h6>
            <p style="margin: 0 0 8px 0; color: #6c757d; font-size: 14px; line-height: 1.4;">
                {{ getCompanyFullAddress() }}
            </p>
            @if(getCompanyInfo('phone'))
            <p style="margin: 5px 0 0 0; color: #6c757d; font-size: 14px;">
                <i class="fas fa-phone" style="color: #28a745; margin-left: 5px;"></i>
                {{ getCompanyInfo('phone') }}
            </p>
            @endif
            @if(getGoogleMapsLink())
            <a href="{{ getGoogleMapsLink() }}" target="_blank" style="color: #007bff; text-decoration: none; font-size: 13px;">
                <i class="fas fa-directions" style="margin-left: 3px;"></i>
                احصل على الاتجاهات
            </a>
            @endif
        </div>
    `;

    marker.bindPopup(popupContent);

    // Auto-open popup after 1.5 seconds
    setTimeout(() => {
        marker.openPopup();
    }, 1500);
    @endif
    @endif
}

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Add a small delay to ensure the map container is ready
    setTimeout(initCompanyMap, 200);
});
</script>
@endif
