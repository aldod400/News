<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage(Request $request)
    {
        $language = $request->input('lang');

        if (in_array($language, ['ar', 'en'])) {
            Session::put('locale', $language);
        }

        return redirect()->back();
    }
}
