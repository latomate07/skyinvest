<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Show User Profil Page
     */
    public function index(User $id, Request $request)
    {
        $data = User::find($id)->first();
        $projects_liked = collect();

        foreach($data->project_liked as $project_liked)
        {
            $query = Project::where('id', $project_liked->likeable_id)->first();
            $projects_liked->push($query);
        }

        return view('client.profil.index', [
            'data' => $data,
            'projects_liked' => $projects_liked
        ]);
    }
}
