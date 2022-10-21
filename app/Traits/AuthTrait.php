<?php 
namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\WelcomeUserNotification;

trait AuthTrait 
{
    /**
     * Store the request user
     */
    function register(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);
        auth()->login($user);

        // Notifier l'utilisateur
        // WelcomeUserNotification::dispatch();
        
        return redirect('/')->with('success', 'Votre compte a été crée avec succès.');
    }

    /**
     * Login the request user
     */
    function login(LoginUserRequest $request)
    {
        $enterprise_credentials = [
            'enterprise_name' => $request->identifiant,
            'password' => $request->password
        ];
        $investor_credentials = [
            'investor_username' => $request->identifiant,
            'password' => $request->password
        ];

        // Login user
        if(Auth()->attempt($enterprise_credentials) or Auth()->attempt($investor_credentials)) { 
            return redirect('/')->with('success', 'Bon retour parmi nous !');
        }

        return redirect()->back()->withErrors('Oups ! Aucun utilisateur trouvé.');
    }

    /**
     * Logout the request user
     */
    function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}


