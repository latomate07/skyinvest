<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
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
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        
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
    public function update(UpdateProjectRequest $request)
    {
    }

    /**
     * Edit project
     */
    public function edit($id)
    {
    }

    /**
     * SoftDelete project
     */
    public function delete(Request $request)
    {
    }
}
