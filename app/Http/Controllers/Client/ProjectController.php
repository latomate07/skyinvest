<?php

namespace App\Http\Controllers\Client;

use App\Models\Project;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectController extends Controller
{
    use SoftDeletes;
    protected $categorie;

    public function __construct(Categories $categorie)
    {
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
            // Save Image(s)
            $project->medias->url = $path;
            $project->save();
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
        $project = Project::find($id);
        return view('client.project.show', [
            'project' => $project
        ]);
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
