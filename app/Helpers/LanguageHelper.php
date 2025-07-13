<?php

if (!function_exists('isRtl')) {
    function isRtl()
    {
        return app()->getLocale() === 'ar';
    }
}

if (!function_exists('textDirection')) {
    function textDirection()
    {
        return isRtl() ? 'rtl' : 'ltr';
    }
}

if (!function_exists('getCurrentLanguageName')) {
    function getCurrentLanguageName()
    {
        return app()->getLocale() === 'ar' ? 'العربية' : 'English';
    }
}
