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
}
