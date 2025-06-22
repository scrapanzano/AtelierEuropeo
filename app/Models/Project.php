<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';

    protected $fillable = [
        'title', 
        'author_id',
        'category_id',
        'association_id',
        'requested_people',
        'location',
        'start_date',
        'end_date',
        'expire_date', 
        'sum_description',
        'full_description',
        'requirements',
        'travel_conditions'];

    
    public function author() {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    } 

    public function association() {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function applications() {
        return $this->hasMany(Application::class, 'project_id');
    }

    public function savedUsers() {
        return $this->belongsToMany(User::class, 'project_user')
                    ->wherePivot('is_favorite', true)
                    ->withTimestamps();
    }

    public function appliedUsers() {
        return $this->belongsToMany(User::class, 'applications', 'project_id', 'user_id')
                    ->withPivot('status', 'message', 'application_date')
                    ->withTimestamps();
    } 
}
