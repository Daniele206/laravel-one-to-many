<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Functions\Helper;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::All();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Project::where('name', $request->name)->first();

        if($exist){
            return redirect()->route('admin.projects.index')->with('error', 'Progetto gia presente');
        }else{
            $new = new Project();
            $new->name = $request->name;
            $new->slug = Helper::generateSlug($new->name, Project::class);
            $new->save();
            return redirect()->route('admin.projects.index')->with('success', 'Progetto inserito correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:20'
        ],
        [
            'name.required'=> 'il campo name é obbligatorio',
            'name.min'=> 'il campo name deve contener piú di :min caratteri',
            'name.max'=> 'il campo name non puó contenere piú di :max caratteri'
        ]);

        $exist = Project::where('name', $request->name)->first();

        if($exist){
            return redirect()->route('admin.projects.index')->with('error', 'Progetto gia presente');
        }else{
            $val_data['slug'] = Helper::generateSlug($request->name, Project::class);
            $project->update($val_data);
            return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
