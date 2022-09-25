<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $projects = Project::all();
        return view('home', [
            'projects' => $projects
        ]);
    }

    public function showRecentProjects()
    {
        return Project::all();
    }
}
