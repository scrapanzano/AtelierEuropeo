<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminApplicationController extends Controller
{
    /**
     * Mostra tutte le candidature per un progetto specifico
     */
    public function index($projectId)
    {
        // Verifica che l'utente sia admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accesso non autorizzato.');
        }

        $project = Project::findOrFail($projectId);
        
        // Statistiche per la dashboard
        $stats = [
            'pending' => Application::where('project_id', $projectId)->where('status', 'pending')->count(),
            'approved' => Application::where('project_id', $projectId)->where('status', 'approved')->count(),
            'rejected' => Application::where('project_id', $projectId)->where('status', 'rejected')->count(),
            'total' => Application::where('project_id', $projectId)->count(),
        ];
        
        $applications = Application::with(['user', 'updatedByAdmin'])
            ->where('project_id', $projectId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.applications.index', compact('project', 'applications', 'stats'));
    }

    /**
     * Mostra i dettagli di una candidatura
     */
    public function show(Application $application)
    {
        // Verifica che l'utente sia admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accesso non autorizzato.');
        }

        $application->load(['user', 'project', 'updatedByAdmin']);
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Aggiorna lo stato di una candidatura
     */
    public function updateStatus(Request $request, Application $application)
    {
        // Verifica che l'utente sia admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accesso non autorizzato.');
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_message' => 'nullable|string|max:1000'
        ]);

        // Se si sta tentando di approvare, controlla il limite
        if ($request->status === 'approved') {
            $project = $application->project;
            $approvedApplicationsCount = Application::where('project_id', $project->id)
                ->where('status', 'approved')
                ->count();

            if ($approvedApplicationsCount >= $project->requested_people) {
                return redirect()->back()->with('error', 
                    "Non è possibile approvare questa candidatura. Il progetto ha già raggiunto il numero massimo di partecipanti richiesti ({$project->requested_people}).");
            }
        }

        $application->update([
            'status' => $request->status,
            'admin_message' => $request->admin_message,
            'status_updated_at' => now(),
            'updated_by_admin_id' => Auth::id(),
        ]);

        $statusText = [
            'approved' => 'approvata',
            'rejected' => 'rifiutata',
            'pending' => 'rimessa in attesa'
        ];

        return redirect()->back()->with('success', 
            'Candidatura ' . $statusText[$request->status] . ' con successo!');
    }

    /**
     * Approva una candidatura
     */
    public function approve(Request $request, Application $application)
    {
        // Verifica che l'utente sia admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accesso non autorizzato.');
        }

        $request->validate([
            'admin_message' => 'nullable|string|max:1000'
        ]);

        // Controlla se ci sono già abbastanza candidature approvate
        $project = $application->project;
        $approvedApplicationsCount = Application::where('project_id', $project->id)
            ->where('status', 'approved')
            ->count();

        if ($approvedApplicationsCount >= $project->requested_people) {
            return redirect()->back()->with('error', 
                "Non è possibile approvare questa candidatura. Il progetto ha già raggiunto il numero massimo di partecipanti richiesti ({$project->requested_people}).");
        }

        $application->update([
            'status' => 'approved',
            'admin_message' => $request->admin_message ?? 'La tua candidatura è stata approvata! Ti contatteremo presto per i prossimi passi.',
            'status_updated_at' => now(),
            'updated_by_admin_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Candidatura approvata con successo!');
    }

    /**
     * Rifiuta una candidatura
     */
    public function reject(Request $request, Application $application)
    {
        // Verifica che l'utente sia admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Accesso non autorizzato.');
        }

        $request->validate([
            'admin_message' => 'required|string|max:1000'
        ]);

        $application->update([
            'status' => 'rejected',
            'admin_message' => $request->admin_message,
            'status_updated_at' => now(),
            'updated_by_admin_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Candidatura rifiutata con messaggio inviato all\'utente.');
    }
}
