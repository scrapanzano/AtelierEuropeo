<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'association_id',
        'image_path',
        'status',
        'requested_people',
        'location',
        'start_date',
        'end_date',
        'expire_date',
        'sum_description',
        'full_description',
        'requirements',
        'travel_conditions',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'expire_date' => 'date',
    ];

    /**
     * Get the correct image URL for this project
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('img/projects/default.png'); // Fallback di default
        }

        // Se inizia con http, è un URL esterno (es. da faker)
        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }

        // Se inizia con img/, è un path pubblico (es. immagini di default)
        if (str_starts_with($this->image_path, 'img/')) {
            return asset($this->image_path);
        }

        // Altrimenti è un file di storage (upload)
        return asset('storage/' . $this->image_path);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'project_id');
    }

    public function testimonial()
    {
        return $this->hasMany(Testimonial::class, 'project_id');
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_favorites', 'project_id', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Verifica se il progetto può accettare altre candidature approvate
     * Restituisce un array con informazioni dettagliate per l'admin
     */
    public function checkApprovalLimit()
    {
        $approvedCount = $this->application()->where('status', 'approved')->count();
        $canApprove = $approvedCount < $this->requested_people;
        $remaining = max(0, $this->requested_people - $approvedCount);
        
        return [
            'can_approve' => $canApprove,
            'approved_count' => $approvedCount,
            'requested_people' => $this->requested_people,
            'remaining_slots' => $remaining,
            'is_full' => !$canApprove,
            'status_message' => $this->getApprovalStatusMessage($approvedCount, $remaining)
        ];
    }

    /**
     * Genera un messaggio di stato chiaro per l'admin
     */
    private function getApprovalStatusMessage($approved, $remaining)
    {
        if ($remaining === 0) {
            return "⚠️ LIMITE RAGGIUNTO: {$approved}/{$this->requested_people} candidature approvate";
        } elseif ($remaining <= 2) {
            return "🔶 ATTENZIONE: Solo {$remaining} posto/i rimasto/i ({$approved}/{$this->requested_people})";
        } else {
            return "✅ Disponibili: {$remaining} posti rimasti ({$approved}/{$this->requested_people})";
        }
    }
}
