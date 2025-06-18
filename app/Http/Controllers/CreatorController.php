<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dl = new DataLayer();
        $creatorsList = $dl->listCreators();

        foreach ($creatorsList as $creator) {
            if ($dl->findProjectByCreatorID($creator->getID())) {
                $creator->hasProjects = true;
            } else {
                $creator->hasProjects = false;
            }
        }

        return view('creator.creators')->with('creatorsList', $creatorsList);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('creator.editCreator');
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
        abort(501);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dl = new DataLayer();
        $creator = $dl->findCreatorByID($id);

        if ($creator != null) {
            return view('creator.editCreator')->with('creator', $creator);
        } else {
            return view('errors.wrongID')->with('message', "L'ID utilizzato è scorretto!");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(501);
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $creator = $dl->findCreatorById($id);
        if ($creator !== null) {
            return view('creator.deletecreator')->with('creator', $creator);
        } else {
            return view('errors.wringID')->with('message', "L'ID utilizzato è scorretto!");
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
