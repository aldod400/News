<?php

require_once __DIR__.'/vendor/autoload.php';

use Carbon\Carbon;

echo "Carbon locale tests:\n";

// Test English
Carbon::setLocale('en');
echo "Locale: " . Carbon::getLocale() . "\n";
echo "English date: " . Carbon::now()->translatedFormat('j F Y') . "\n";

// Test Arabic
Carbon::setLocale('ar');
echo "Locale: " . Carbon::getLocale() . "\n";
echo "Arabic date: " . Carbon::now()->translatedFormat('j F Y') . "\n";

// Test with specific date
$testDate = Carbon::create(2024, 8, 10, 14, 30, 0);

Carbon::setLocale('en');
echo "Test date EN: " . $testDate->translatedFormat('j F Y') . "\n";

Carbon::setLocale('ar');
echo "Test date AR: " . $testDate->translatedFormat('j F Y') . "\n";
