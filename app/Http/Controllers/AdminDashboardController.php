<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminDashboardController extends BaseController
{
    public function index()
    {
        return view('dashboards.admin');
    }
}
