<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use App\Models\Thumbnail;
use App\Models\Categories;

class ProjectController extends Controller
{
    use SoftDeletes;
    protected $thumbnail;
    protected $categorie;

    public function __construct(Thumbnail $thumbnail, Categories $categorie)
    {
        $this->thumbnail = $thumbnail;
        $this->categorie = $categorie;
    }
    public function showProjectPage()
    {
        return view('client.project.index');
    }

    /**
     * Store project
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->except(['images', 'categorie']));
        foreach($request->images as $image)
        {
            $path = $image->store('thumbnails', ['disk' => 'project_thumbnails']);
            $this->thumbnail->url = $path;
            $this->thumbnail->project_id = $project->id;
            $this->thumbnail->save();
        }
        // Store categorie
        $this->categorie->name = $request->categorie;
        $this->categorie->project_id = $project->id;
        $this->categorie->save();
        
        if(!$project)
        {
            return redirect()->back()->withErrors('Veuillez remplir tout les champs !');
        }
        $data = [
            "project_id" => $project->id,
            "author_id" => auth()->user()->id,
            "successMessage" => "Votre projet a été crée avec succès !"
        ];
        return response()->json($data, 200);
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
