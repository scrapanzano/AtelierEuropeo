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

        $project = $application->project;

        // Controllo limite per approvazione
        if ($request->status === 'approved') {
            $approvalCheck = $project->checkApprovalLimit();
            
            if (!$approvalCheck['can_approve']) {
                return redirect()->back()
                    ->withErrors(['approval_limit' => $approvalCheck['status_message']])
                    ->with('project_status', $approvalCheck);
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

        // Messaggio di successo con info sul progetto per le approvazioni
        $successMessage = 'Candidatura ' . $statusText[$request->status] . ' con successo!';
        if ($request->status === 'approved') {
            $updatedCheck = $project->checkApprovalLimit();
            $successMessage .= ' ' . $updatedCheck['status_message'];
            
            return redirect()->back()
                ->with('success', $successMessage)
                ->with('project_status', $updatedCheck);
        }

        return redirect()->back()->with('success', $successMessage);
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

        $project = $application->project;
        $approvalCheck = $project->checkApprovalLimit();
        
        if (!$approvalCheck['can_approve']) {
            return redirect()->back()
                ->withErrors(['approval_limit' => $approvalCheck['status_message']])
                ->with('project_status', $approvalCheck);
        }

        $application->update([
            'status' => 'approved',
            'admin_message' => $request->admin_message ?? 'La tua candidatura è stata approvata! Ti contatteremo presto per i prossimi passi.',
            'status_updated_at' => now(),
            'updated_by_admin_id' => Auth::id(),
        ]);

        $updatedCheck = $project->checkApprovalLimit();
        $successMessage = 'Candidatura approvata con successo! ' . $updatedCheck['status_message'];

        return redirect()->back()
            ->with('success', $successMessage)
            ->with('project_status', $updatedCheck);
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
