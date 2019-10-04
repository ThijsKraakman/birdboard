<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('projects'));
    }

    public function store() 
    {
        //validate
        $attributes = request()->validate([
            'title' => 'required', 
            'description' => 'required',
            'owner_id' => 'required'
            ]);
        
        
        //persist
        auth()->user()->projects()->create($attributes);

        //redirect
        return redirect('/projects');
    }
  
}
