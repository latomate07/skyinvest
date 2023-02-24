<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\ProjectLikes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $projects = Project::all();
        $projects_recently_published = Project::latest()->get();
        $user = auth()->check() ? User::where('id', auth()->user()->id)->first() : '';

        if($user !== '')
        {
            $projects_liked = $user->project_liked()
                                ->where('is_liked', 'yes')
                                ->get();
            $show_projects_liked = [];
            foreach($projects_liked as $project_liked)
            {
            $show_project_liked = Project::where('id', $project_liked->likeable_id)
                                    ->latest()
                                    ->first();
            array_push($show_projects_liked, $show_project_liked);
            }
        }
    
        return view('home', [
            'projects' => $projects,
            'projects_liked' => $show_projects_liked ?? [],
            'latest_projects' => $projects_recently_published
        ]);
    }

    /**
     * Get and Send Project User needs
     */
    public function switchProjects(Request $request)
    {
        if($request->has('needAllProject'))
        {
            $projects = Project::all();
            return response()->json($projects, 200);
        }

        return response()->json(Project::all(), 200);
    }

    /**
     * Store user wish newsletter
     */
    public function isWishNewsletter(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if(!is_null($request->userMail))
        {
            if($user->email !== $request->userMail)
            {
                $user->email = $request->userMail;
                $user->wishNewsletter = "on";
                $user->save();
            }
            $user->wishNewsletter = "on";
            $user->save();

            $data = [
                'user' => $user,
                'message' => 'Votre demande a bien été prise en compte.'
            ];
        }
        else {
            $data = [
                'user' => $user,
                'warning' => 'Vous devez indiqué votre mail.'
            ];
        }

        return response()->json($data);
    }
}
