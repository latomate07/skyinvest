<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
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

    /**
     * Add function to register investor entreprise favorites
     * Need Investor ID
     */
    public function saveEntrepriseToThisUser(Request $request)
    {
        $currentUser = User::find(auth()->user()->id);
        $userConcerned = User::find($request->userConcernedId);
        $data = [];

        if($request->has('followThisEnterprise') && $request->followThisEnterprise == "true"){
                $updateOrCreateFavorites = Favorites::updateOrCreate([
                    "favoritable_id" => $currentUser->id,
                    "favoritable_type" => User::class,
                    'target_id' => $userConcerned->id
                ]);

                $data = [
                    "followBy" => $currentUser,
                    "userConcerned" => $userConcerned,
                    "message" => "Vous êtes désormais abonné à $userConcerned->enterprise_name"
                ];

                return response()->json($data);
        }
        else {
            // Remove record
            $removeRecord = Favorites::where([
                "favoritable_id" => $currentUser->id,
                "favoritable_type" => User::class,
                "target_id" => $userConcerned->id
            ])->delete();

            $data = [
                "message" => "Vous ne suivez plus $userConcerned->enterprise_name"
            ];

            return response()->json($data);
        }
    }
}
