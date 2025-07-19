<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Aggiungi o rimuovi un progetto dai preferiti
     */
    public function toggle(Request $request)
    {
        try {
            $projectId = $request->input('project_id');
            $user = Auth::user();
            
            // Verifica che l'utente sia loggato e non sia admin
            if (!$user || $user->role === 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Azione non consentita.'
                ], 403);
            }
            
            // Verifica che il progetto esista
            $project = Project::find($projectId);
            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Progetto non trovato.'
                ], 404);
            }
            
            // Controlla se il progetto è già nei preferiti
            $isFavorite = $user->favoriteProjects()->where('project_id', $projectId)->exists();
            
            if ($isFavorite) {
                // Rimuovi dai preferiti
                $user->favoriteProjects()->detach($projectId);
                $message = 'Progetto rimosso dai preferiti!';
                $action = 'removed';
            } else {
                // Aggiungi ai preferiti
                $user->favoriteProjects()->attach($projectId);
                $message = 'Progetto aggiunto ai preferiti!';
                $action = 'added';
            }
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'action' => $action,
                'is_favorite' => !$isFavorite
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Si è verificato un errore. Riprova più tardi.'
            ], 500);
        }
    }
    
    /**
     * Mostra la lista dei progetti preferiti dell'utente
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user || $user->role === 'admin') {
            return redirect()->route('home')->with('error', 'Azione non consentita.');
        }
        
        $favoriteProjects = $user->favoriteProjects()
            ->with(['category', 'association'])
            ->where('status', 'published')
            ->orderBy('user_favorites.created_at', 'desc')
            ->paginate(12);
        
        return view('favorites.index', compact('favoriteProjects'));
    }
}
