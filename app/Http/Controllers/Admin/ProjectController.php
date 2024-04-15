<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Doctrine\DBAL\Types\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
   
        $projects = Project::orderBy('id', 'DESC')->where('user_id', Auth::id())->paginate(6);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $project = new Project;
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // valido la richiesta
        $request->validated();

        // recupero i dati della richiesta
        $data = $request->all();

        // instanzio un nuovo project
        $project = new Project;      

        // fillo il progetto con i dati del form
        $project->fill($data);

        // lo lego all'utente loggato
        $project->user_id = Auth::id();

        // genero lo slug
        $project->slug = Str::slug($project->title);

        // gestisco l'immaine erecupero il path
        // se è arrivata una nuova immagine
        if(Arr::exists($data, "image")) {
        $img_path = Storage::put('uploads/projects', $data["image"]);
        $project->image = $img_path;
        }

        // salvo il posto in DataBase
        $project->save();
        

        //  relaziono il progetto alle tecnologie associate
        if (array_key_exists('technologies', $data)) {

            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->validated();

        $data = $request->all();
        
        $project->fill($data);
        $project->slug = Str::slug($project->title);
        
        
        // se è arrivata una nuova immagine
        if(Arr::exists($data, "image")) {
            // se ce n'era una prima
            if(!empty($project->image)){
                // la elimino
                Storage::delete($project->image);
            } 
            
            // salva la nuova image
            $img_path = Storage::put('uploads/projects', $data["image"]);
            $project->image = $img_path;
        }
        $project->save();

        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back();
    }
}
