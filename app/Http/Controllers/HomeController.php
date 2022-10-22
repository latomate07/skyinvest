<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('home', [
            'projects' => $projects,
            'projects_liked' => $show_projects_liked,
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
}
