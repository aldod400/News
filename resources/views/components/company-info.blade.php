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

@media (max-width: 768px) {
    .company-info-card {
        padding: 1.5rem;
    }
    
    #company-map {
        height: 250px !important;
    }
}
</style>

<script>
function initCompanyMap() {
    @if(hasCompanyLocation())
    const companyLocation = {
        lat: {{ getCompanyLocation()['latitude'] }},
        lng: {{ getCompanyLocation()['longitude'] }}
    };

    const map = new google.maps.Map(document.getElementById("company-map"), {
        zoom: 15,
        center: companyLocation,
        mapTypeControl: false,
        streetViewControl: true,
        fullscreenControl: true,
        styles: [
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [{ visibility: "off" }]
            }
        ]
    });

    const marker = new google.maps.Marker({
        position: companyLocation,
        map: map,
        title: "{{ getCompanyInfo('name') }}",
        animation: google.maps.Animation.DROP,
        icon: {
            url: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAzMiAzMiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMTYiIGN5PSIxNiIgcj0iMTYiIGZpbGw9IiNkYzM1NDUiLz4KPHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4PSI2IiB5PSI2Ij4KPHBhdGggZD0iTTEwIDJDNi42ODYyOSAyIDQgNC42ODYyOSA0IDhDNCA5LjA1NzEgNC4yNzM0MyAxMC4wNzE0IDQuNzY0NjUgMTFMMTAgMThMMTUuMjM1NCAxMUMxNS43MjY2IDEwLjA3MTQgMTYgOS4wNTcxIDE2IDhDMTYgNC42ODYyOSAxMy4zMTM3IDIgMTAgMloiIGZpbGw9IndoaXRlIi8+CjxjaXJjbGUgY3g9IjEwIiBjeT0iOCIgcj0iMiIgZmlsbD0iI2RjMzU0NSIvPgo8L3N2Zz4KPC9zdmc+',
            scaledSize: new google.maps.Size(40, 40),
            anchor: new google.maps.Point(20, 40)
        }
    });

    @if(getCompanyInfo('name') && getCompanyFullAddress())
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div style="padding: 10px; min-width: 200px;">
                <h6 style="margin: 0 0 10px 0; color: #2c3e50; font-weight: bold;">
                    {{ getCompanyInfo('name') }}
                </h6>
                <p style="margin: 0; color: #6c757d; font-size: 14px;">
                    {{ getCompanyFullAddress() }}
                </p>
                @if(getCompanyInfo('phone'))
                <p style="margin: 5px 0 0 0; color: #6c757d; font-size: 14px;">
                    <i class="fas fa-phone" style="color: #28a745; margin-left: 5px;"></i>
                    {{ getCompanyInfo('phone') }}
                </p>
                @endif
            </div>
        `
    });

    marker.addListener("click", () => {
        infoWindow.open(map, marker);
    });

    // Auto-open info window after 2 seconds
    setTimeout(() => {
        infoWindow.open(map, marker);
    }, 2000);
    @endif
    @endif
}

// Initialize map when Google Maps is loaded
if (typeof google !== 'undefined' && google.maps) {
    initCompanyMap();
} else {
    // Load Google Maps if not already loaded
    window.initCompanyMap = initCompanyMap;
}
</script>
@endif
