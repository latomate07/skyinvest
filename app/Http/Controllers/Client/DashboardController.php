<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function showDashboardPage()
    {
        return view('client.dashboard.index');
    }
}
