<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function setLocale($locale='en'){
        if (!in_array($locale, ['en', 'ru'])){
            $locale = 'en';
        }
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
