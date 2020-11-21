<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CopypastaController extends Controller
{
    public function getCreatePage()
    {
        return view('create');
    }
    public function getIndexPage()
    {
        return view('index');
    }
    public function getHomePage()
    {
        return view('home');
    }
}
