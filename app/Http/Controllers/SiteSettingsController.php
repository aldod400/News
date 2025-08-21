<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SiteSettingsController extends Controller
{
    /**
     * Display site settings management page with company info
     */
    public function index()
    {
        return view('admin.site-settings.index');
    }

    /**
     * Update site settings including company information
     */
    public function update(Request $request)
    {
        // Validate company settings
        $validator = Validator::make($request->all(), [
            'settings.company_name' => 'required|string|max:255',
            'settings.company_address' => 'required|string|max:500',
            'settings.company_city' => 'required|string|max:100',
            'settings.company_country' => 'required|string|max:100',
            'settings.company_phone' => 'nullable|string|max:20',
            'settings.company_email' => 'nullable|email|max:255',
            'settings.company_latitude' => 'nullable|numeric|between:-90,90',
            'settings.company_longitude' => 'nullable|numeric|between:-180,180',
            // Social Media Links
            'settings.social_twitter' => 'nullable|url|max:255',
            'settings.social_facebook' => 'nullable|url|max:255',
            'settings.social_youtube' => 'nullable|url|max:255',
            'settings.social_instagram' => 'nullable|url|max:255',
            'settings.social_linkedin' => 'nullable|url|max:255',
            'settings.social_pinterest' => 'nullable|url|max:255',
            'settings.social_timber' => 'nullable|url|max:255',
            'settings.social_github' => 'nullable|url|max:255',
        ], [
            'settings.company_name.required' => 'اسم الشركة مطلوب',
            'settings.company_address.required' => 'عنوان الشركة مطلوب',
            'settings.company_city.required' => 'المدينة مطلوبة',
            'settings.company_country.required' => 'الدولة مطلوبة',
            'settings.company_email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'settings.company_latitude.numeric' => 'خط العرض يجب أن يكون رقم',
            'settings.company_longitude.numeric' => 'خط الطول يجب أن يكون رقم',
            'settings.social_twitter.url' => 'رابط Twitter غير صحيح',
            'settings.social_facebook.url' => 'رابط Facebook غير صحيح',
            'settings.social_youtube.url' => 'رابط YouTube غير صحيح',
            'settings.social_instagram.url' => 'رابط Instagram غير صحيح',
            'settings.social_linkedin.url' => 'رابط LinkedIn غير صحيح',
            'settings.social_pinterest.url' => 'رابط Pinterest غير صحيح',
            'settings.social_timber.url' => 'رابط Timber غير صحيح',
            'settings.social_github.url' => 'رابط GitHub غير صحيح',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update each setting
            $settings = $request->input('settings', []);
            
            foreach ($settings as $key => $value) {
                SiteSetting::set($key, $value);
            }

            return redirect()
                ->route('admin.site-settings.index')
                ->with('success', 'تم تحديث إعدادات الموقع بنجاح');

        } catch (\Exception $e) {
            Log::error('Error updating site settings: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء تحديث الإعدادات. حاول مرة أخرى.']);
        }
    }

    /**
     * Get company information as JSON (for API or AJAX requests).
     */
    public function getCompanyInfo()
    {
        try {
            $companyInfo = [
                'name' => SiteSetting::get('company_name', ''),
                'address' => SiteSetting::get('company_address', ''),
                'city' => SiteSetting::get('company_city', ''),
                'country' => SiteSetting::get('company_country', ''),
                'phone' => SiteSetting::get('company_phone', ''),
                'email' => SiteSetting::get('company_email', ''),
                'latitude' => SiteSetting::get('company_latitude', ''),
                'longitude' => SiteSetting::get('company_longitude', ''),
                'full_address' => $this->getFullAddress(),
                'has_location' => $this->hasValidLocation(),
            ];

            return response()->json([
                'success' => true,
                'data' => $companyInfo
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في استرجاع معلومات الشركة'
            ], 500);
        }
    }

    /**
     * Get full formatted address.
     */
    private function getFullAddress()
    {
        $address = SiteSetting::get('company_address', '');
        $city = SiteSetting::get('company_city', '');
        $country = SiteSetting::get('company_country', '');

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

    /**
     * Check if company has valid location coordinates.
     */
    private function hasValidLocation()
    {
        $lat = SiteSetting::get('company_latitude', '');
        $lng = SiteSetting::get('company_longitude', '');

        return !empty($lat) && !empty($lng) && 
               is_numeric($lat) && is_numeric($lng) &&
               $lat >= -90 && $lat <= 90 &&
               $lng >= -180 && $lng <= 180;
    }
}
