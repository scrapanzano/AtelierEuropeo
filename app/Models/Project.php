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

    /**
     * Relazione: un progetto è creato da un utente
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope: filtra progetti gestiti da un admin specifico
     */
    public function scopeManagedBy($query, User $user)
    {
        // Project admin vede solo i suoi progetti
        return $query->where('user_id', $user->id);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    /**
     * Scope: ricerca per testo nei campi principali
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('sum_description', 'LIKE', "%{$search}%")
                  ->orWhere('full_description', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Scope: filtra per categoria
     */
    public function scopeByCategory($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    /**
     * Scope: filtra per associazione
     */
    public function scopeByAssociation($query, $associationId)
    {
        if ($associationId) {
            return $query->where('association_id', $associationId);
        }
        return $query;
    }

    /**
     * Scope: filtra per località
     */
    public function scopeByLocation($query, $location)
    {
        if ($location) {
            return $query->where('location', 'LIKE', "%{$location}%");
        }
        return $query;
    }

    /**
     * Scope: filtra per stato
     */
    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }
}
