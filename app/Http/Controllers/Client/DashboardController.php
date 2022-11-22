<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\DashboardTrait;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use DashboardTrait;

    public function showDashboardPage(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('client.dashboard.index', [
            'user' => $user,
            'isReadyToInvest' => User::isReadyToInvest($user_id),
            'isReadyToPublish' => User::isReadyToPublish($user_id)
        ]);
    }
}
