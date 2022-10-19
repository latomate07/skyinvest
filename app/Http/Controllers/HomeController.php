<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $projects = Project::all();
        $user = auth()->check() ? User::where('id', auth()->user()->id)->first() : '';
        $projects_recently_published = Project::latest()->get();

        return view('home', [
            'projects' => $projects,
            // 'projects_liked' => $user->project_liked,
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
