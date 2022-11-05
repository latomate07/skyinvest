<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Show User Profil Page
     */
    public function index(User $id, Request $request)
    {
        $data = User::find($id);

        return view('client.profil.index', [
            'data' => $data
        ]);
    }
}
