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
        'author_id',
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

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
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
}
