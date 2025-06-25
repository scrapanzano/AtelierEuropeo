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
     * Relazione: un progetto appartiene a un admin (user_id)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id')
                    ->where(function ($query) {
                        $query->where('role', User::ROLE_PROJECT_ADMIN);
        });
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
}
