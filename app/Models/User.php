<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relazione per i progetti salvati dall'utente.
     */
    public function savedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
                    ->withPivot('is_favorite')
                    ->withTimestamps();
    }

    /**
     * Relazione diretta alle applicazioni fatte dall'utente.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    /**
     * Relazione per i progetti a cui l'utente ha fatto domanda.
     */
    public function appliedProjects()
    {
        return $this->belongsToMany(Project::class, 'applications', 'user_id', 'project_id')
                    ->withPivot('status', 'message', 'application_date')
                    ->withTimestamps();
    }
}
