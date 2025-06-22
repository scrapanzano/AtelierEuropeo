<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    /**
     * Relazione con i progetti.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
