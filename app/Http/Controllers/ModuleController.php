<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Страница с установленными модулями
     */
    public function index()
    {
        return view('module.index');
    }
}
