<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthTrait;
    public function showLoginPage() {
        if(auth()->check()) {
            return view('client.dashboard.index');
        }

        return view('auth.login');
    }

    public function showSigninPage() {
        if(auth()->check()) {
            return view('client.dashboard.index');
        }
        
        return view('auth.signin');
    }
}
