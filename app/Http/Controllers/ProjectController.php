<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dl = new DataLayer();
        $status = $request->get('status', 'all'); // default 'all'

        // Determina quali progetti mostrare in base al ruolo e ai filtri
        $projectsList = $this->getFilteredProjects($dl, $status);

        return view('project.projects')
            ->with('projectsList', $projectsList)
            ->with('currentStatus', $status);
    }

    /**
     * Metodo helper per filtrare i progetti
     */
    private function getFilteredProjects($dl, $status)
    {
        switch ($status) {
            case 'published':
                return $dl->listProjectsByStatus('published');

            case 'draft':
                // Il middleware ha già verificato che solo admin arrivino qui
                return $dl->listProjectsByStatus('draft');

            case 'completed':
                return $dl->listProjectsByStatus('completed');        case 'all':
        default:
            // Solo per il caso 'all' verifichiamo il ruolo per decidere cosa mostrare
            $isAdmin = auth()->check() && auth()->user()->isAdmin();
            if ($isAdmin) {
                return $dl->listProjects(); // Tutti i progetti
            } else {
                return $dl->listProjectsByStatus('published'); // Solo pubblicati per non-admin
            }
        }
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dl = new DataLayer();
        $categories = $dl->listCategories();
        $associations = $dl->listAssociations();

        return view('project.editProject')
            ->with('categories', $categories)
            ->with('associations', $associations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $project = $dl->addProject($request->all());

        if ($project) {
            return redirect()->route('project.show', $project->id)->with('success', 'Project created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create project.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project != null) {
            // Carica le testimonianze se il progetto è completato
            if ($project->status === 'completed') {
                $project->load(['testimonial.author']);
            }
            
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
        $project = $dl->findProjectByID($id);

        if ($project != null) {
            $categories = $dl->listCategories();
            $associations = $dl->listAssociations();

            return view('project.editProject')
                ->with('project', $project)
                ->with('categories', $categories)
                ->with('associations', $associations);
        } else {
            return view('errors.wrongID')->with('message', "Wrong project ID has been used!");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project != null) {
            $updatedProject = $dl->editProject($id, $request->all());

            if ($updatedProject) {
                return redirect()->route('project.show', $id)->with('success', 'Project updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update project.');
            }
        } else {
            return view('errors.wrongID')->with('message', "Wrong project ID has been used!");
        }
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project != null) {
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
        $dl = new DataLayer();
        $deleted = $dl->deleteProject($id);
        return redirect()->route('project.index')->with('success', 'Project deleted successfully!');
    }

    /**
     * Display portfolio of completed projects with testimonials.
     */
    public function portfolio()
    {
        $dl = new DataLayer();
        $completedProjects = $dl->listProjectsByStatus('completed');
        
        // Carica le testimonianze per ogni progetto
        foreach ($completedProjects as $project) {
            $project->load(['testimonial.author', 'category', 'association']);
        }

        return view('project.portfolio')
            ->with('completedProjects', $completedProjects);
    }
}
