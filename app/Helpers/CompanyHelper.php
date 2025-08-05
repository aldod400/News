<?php

if (!function_exists('getCompanyInfo')) {
    /**
     * Get company information.
     *
     * @param string|null $key Specific info key to retrieve
     * @return mixed
     */
    function getCompanyInfo($key = null)
    {
        $companyInfo = [
            'name' => \App\Models\SiteSetting::get('company_name', ''),
            'address' => \App\Models\SiteSetting::get('company_address', ''),
            'city' => \App\Models\SiteSetting::get('company_city', ''),
            'country' => \App\Models\SiteSetting::get('company_country', ''),
            'phone' => \App\Models\SiteSetting::get('company_phone', ''),
            'email' => \App\Models\SiteSetting::get('company_email', ''),
            'latitude' => \App\Models\SiteSetting::get('company_latitude', ''),
            'longitude' => \App\Models\SiteSetting::get('company_longitude', ''),
        ];

        if ($key) {
            return $companyInfo[$key] ?? '';
        }

        return $companyInfo;
    }
}

if (!function_exists('getCompanyFullAddress')) {
    /**
     * Get full formatted address.
     *
     * @return string
     */
    function getCompanyFullAddress()
    {
        $address = \App\Models\SiteSetting::get('company_address', '');
        $city = \App\Models\SiteSetting::get('company_city', '');
        $country = \App\Models\SiteSetting::get('company_country', '');

        $fullAddress = [];
        
        if (!empty($address)) {
            $fullAddress[] = $address;
        }
        
        if (!empty($city)) {
            $fullAddress[] = $city;
        }
        
        if (!empty($country)) {
            $fullAddress[] = $country;
        }

        return implode(', ', $fullAddress);
    }
}

if (!function_exists('hasCompanyLocation')) {
    /**
     * Check if company has valid location coordinates.
     *
     * @return bool
     */
    function hasCompanyLocation()
    {
        $lat = \App\Models\SiteSetting::get('company_latitude', '');
        $lng = \App\Models\SiteSetting::get('company_longitude', '');

        return !empty($lat) && !empty($lng) && 
               is_numeric($lat) && is_numeric($lng) &&
               $lat >= -90 && $lat <= 90 &&
               $lng >= -180 && $lng <= 180;
    }
}

if (!function_exists('getCompanyLocation')) {
    /**
     * Get company location coordinates.
     *
     * @return array|null
     */
    function getCompanyLocation()
    {
        if (!hasCompanyLocation()) {
            return null;
        }

        return [
            'latitude' => (float) \App\Models\SiteSetting::get('company_latitude', ''),
            'longitude' => (float) \App\Models\SiteSetting::get('company_longitude', ''),
        ];
    }
}

if (!function_exists('getGoogleMapsLink')) {
    /**
     * Generate Google Maps link for company location.
     *
     * @return string|null
     */
    function getGoogleMapsLink()
    {
        $location = getCompanyLocation();
        
        if (!$location) {
            return null;
        }

        return sprintf(
            'https://www.google.com/maps?q=%s,%s',
            $location['latitude'],
            $location['longitude']
        );
    }
}

if (!function_exists('getGoogleMapsEmbedUrl')) {
    /**
     * Generate Google Maps embed URL for company location.
     *
     * @param string $apiKey Google Maps API key
     * @return string|null
     */
    function getGoogleMapsEmbedUrl($apiKey = 'YOUR_GOOGLE_MAPS_API_KEY')
    {
        $location = getCompanyLocation();
        
        if (!$location) {
            return null;
        }

        return sprintf(
            'https://www.google.com/maps/embed/v1/place?key=%s&q=%s,%s&zoom=15',
            $apiKey,
            $location['latitude'],
            $location['longitude']
        );
    }
}
