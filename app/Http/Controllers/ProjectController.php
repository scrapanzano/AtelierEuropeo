<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


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
                return $dl->listProjectsByStatus('completed');
           
            default:
                // Solo per il caso 'all' verifichiamo il ruolo per decidere cosa mostrare
                $isAdmin = Auth::check() && Auth::user()->role === 'admin';
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
    public function store(ProjectRequest $request)
    {
        $dl = new DataLayer();
        $data = $request->validated();
        
        // Gestisci l'upload dell'immagine
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('projects', 'public');
            $data['image_path'] = $imagePath;
        }
        
        $project = $dl->addProject($data);

        if ($project) {
            return redirect()->route('project.show', $project->id)->with('success', 'Progetto creato con successo!');
        } else {
            return redirect()->back()->with('error', 'Errore nella creazione del progetto.');
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
            // Controlla se il progetto è completato
            if ($project->status === 'completed') {
                return view('errors.project-completed')
                    ->with('project', $project)
                    ->with('message', 'Questo progetto è stato completato e non può più essere modificato.');
            }

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
    public function update(ProjectRequest $request, string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project != null) {
            // Controlla se il progetto è completato
            if ($project->status === 'completed') {
                return redirect()->route('project.show', $id)
                    ->with('error', 'Questo progetto è stato completato e non può più essere modificato.');
            }

            $data = $request->validated();
            
            // Se si tenta di impostare lo status come 'completed', reindirizza alla pagina di conferma
            if (isset($data['status']) && $data['status'] === 'completed' && $project->status !== 'completed') {
                // Salva i dati del form in sessione per riutilizzarli dopo la conferma
                session(['completion_form_data' => $data]);
                return redirect()->route('project.confirm.completion', ['id' => $id]);
            }
            
            // Gestisci l'upload dell'immagine se presente
            if ($request->hasFile('image_path')) {
                // Elimina la vecchia immagine SOLO se è un file di storage (non URL o path di default)
                if ($project->image_path && 
                    !str_starts_with($project->image_path, 'http') && 
                    !str_starts_with($project->image_path, 'img/') &&
                    Storage::disk('public')->exists($project->image_path)) {
                    Storage::disk('public')->delete($project->image_path);
                }
                
                // Salva la nuova immagine
                $imagePath = $request->file('image_path')->store('projects', 'public');
                $data['image_path'] = $imagePath;
            } else {
                // Se non c'è una nuova immagine, mantieni quella esistente
                unset($data['image_path']);
            }
            
            $updatedProject = $dl->editProject($id, $data);

            if ($updatedProject) {
                return redirect()->route('project.show', $id)->with('success', 'Progetto aggiornato con successo!');
            } else {
                return redirect()->back()->with('error', 'Errore nell\'aggiornamento del progetto.');
            }
        } else {
            return view('errors.wrongID')->with('message', 'Wrong project ID has been used!');
        }
    }

    /**
     * Mostra la pagina di conferma per il completamento del progetto
     */
    public function confirmCompletion(string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project == null) {
            return view('errors.wrongID')->with('message', 'ID progetto non valido!');
        }

        // Controlla se il progetto è già completato
        if ($project->status === 'completed') {
            return redirect()->route('project.show', $id)
                ->with('info', 'Questo progetto è già stato completato.');
        }

        // Recupera i dati del form dalla sessione
        $formData = session('completion_form_data', []);
        
        return view('project.confirmCompletion')
            ->with('project', $project)
            ->with('formData', $formData);
    }

    /**
     * Completa il progetto dopo la conferma
     */
    public function complete(string $id)
    {
        $dl = new DataLayer();
        $project = $dl->findProjectByID($id);

        if ($project == null) {
            return view('errors.wrongID')->with('message', 'ID progetto non valido!');
        }

        // Controlla se il progetto è già completato
        if ($project->status === 'completed') {
            return redirect()->route('project.show', $id)
                ->with('info', 'Questo progetto è già stato completato.');
        }

        // Recupera i dati del form dalla sessione
        $formData = session('completion_form_data', []);
        
        if (empty($formData)) {
            return redirect()->route('project.edit', $id)
                ->with('error', 'Dati di sessione mancanti. Riprova.');
        }

        // Assicurati che lo status sia impostato su 'completed'
        $formData['status'] = 'completed';

        // Non gestire l'upload dell'immagine qui - sarà gestito separatamente se necessario
        // Rimuovi sempre il campo image_path dai dati della sessione
        unset($formData['image_path']);

        $updatedProject = $dl->editProject($id, $formData);

        // Rimuovi i dati dalla sessione
        session()->forget('completion_form_data');

        if ($updatedProject) {
            return redirect()->route('project.show', $id)
                ->with('success', 'Progetto completato con successo! Non sarà più possibile modificarlo.');
        } else {
            return redirect()->route('project.edit', $id)
                ->with('error', 'Errore nel completamento del progetto.');
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

    /**
     * Validate project data via AJAX
     */
    public function validateAjax(ProjectRequest $request)
    {
        // Se arriviamo qui, la validazione è passata
        return response()->json([
            'success' => true,
            'message' => 'Validazione completata con successo'
        ]);
    }

    /**
     * Check if project title is unique via AJAX
     */
    public function checkTitleUnique(Request $request)
    {
        $title = $request->input('title');
        $projectId = $request->input('project_id'); // Per escludere il progetto corrente in modifica
        
        $query = \App\Models\Project::where('title', $title);
        
        // Se stiamo modificando un progetto, escludi quello corrente
        if ($projectId) {
            $query->where('id', '!=', $projectId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Esiste già un progetto con questo titolo.' : 'Titolo disponibile.'
        ]);
    }
}
