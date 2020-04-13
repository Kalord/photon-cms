<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Страница входа в систему
     */
    public function login()
    {
        return view('site.login');
    }

    public function registration()
    {
        return view('site.registration');
    }
}
