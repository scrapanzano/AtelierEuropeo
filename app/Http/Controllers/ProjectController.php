<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $projectsList = $dl->listProjects();

        return view('project.projects')->with('projectsList', $projectsList);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $creatorsList = $dl->listCreators();
        
        return view('project.editProject')->with('creatorsList', $creatorsList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(501);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if($project != null) {
            return view('project.details')->with('project', $project);
        } else {
            return view('errors.wrongID')->with('message', 'Wrong project ID has been used!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $creatorsList = $dl->listCreators();
        $project = $dl->findProjectByID($id);

        if($project != null) {
            return view('project.editProject')->with('creatorsList', $creatorsList)->with('project', $project);
        } else {
            return view('errors.wrongID')->with('message', "Wrong project ID has been used!");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(501);
    }

    public function confirmDestroy($id) {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if($project != null) {
            return view('project.deleteProject')->with('project', $project);
        } else {
            return view('errors.wrongID')->with('message', "Wrong project ID has been used!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(501);
    }
}
