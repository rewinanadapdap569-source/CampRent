<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Akan mencari file di resources/views/pages/dashboard.blade.php
       
        return view('pages.dashboard');
    }
}