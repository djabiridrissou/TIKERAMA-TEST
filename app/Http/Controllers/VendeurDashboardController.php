<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendeurDashboardController extends Controller
{
    public function index()
    {
        return view('dashboards.vendeur');
    }
}
