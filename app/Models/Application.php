<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'status',
        'user_id',
        'project_id',
        'phone',
        'document_path',
        'document_name',
        'admin_message',
        'status_updated_at',
        'updated_by_admin_id',
    ];

    protected $casts = [
        'status_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function updatedByAdmin()
    {
        return $this->belongsTo(User::class, 'updated_by_admin_id');
    }

    /**
     * Scope per filtrare per status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessor per ottenere il nome completo dell'utente
     */
    public function getApplicantNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Accessor per ottenere l'email dell'utente
     */
    public function getApplicantEmailAttribute()
    {
        return $this->user->email;
    }
}
