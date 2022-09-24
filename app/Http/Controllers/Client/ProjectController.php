<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectController extends Controller
{
    use SoftDeletes;
    public function showProjectPage()
    {
        return view('client.project.index');
    }

    /**
     * Store project
     */
    public function store(Request $request)
    {
    }

    /**
     * Show project
     */
    public function show($id)
    {
    }

    /**
     * Update project
     */
    public function update()
    {
    }

    /**
     * Edit project
     */
    public function edit()
    {
    }

    /**
     * SoftDelete project
     */
    public function delete()
    {
    }
}
