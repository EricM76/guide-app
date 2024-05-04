<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();
        $newest = Project::latest()->get();
        $paginates = Project::paginate(2);

        return view('projects.index', [
            'projects' => $projects, 
            'newest' => $newest,
            'paginates' => $paginates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
    
    /* VALIDACIONES EN EL CONTROLADOR */

      /*   $request->validate([
            'title' => 'bail|required|min:2|max:255',
            'description' => 'bail|required|min:20'
        ]);

        $project = new Project;

        $project->title = $request->title;
        $project->description = $request->description;

        $project->save();
        
        return redirect()->route('projects.show',$project); */

    /* VALIDACIONES EN EL REQUEST  */
               
        $request->validated();
      
        $project = new Project;

        $project->title = $request->title;
        $project->description = $request->description;

        $project->save();
        
        return redirect()->route('projects.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => Project::all()->find($project)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit',['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateProjectRequest $request, Project $project)
    {
        $request->validated();

        $project->title =  $request->title;
        $project->description = $request->description;

        $project->save();

        return redirect()->route('projects.show',$project);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}