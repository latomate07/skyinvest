<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DashboardTrait;

class DashboardController extends Controller
{
    use DashboardTrait;
    public function showDashboardPage()
    {
        return view('client.dashboard.index');
    }
}
