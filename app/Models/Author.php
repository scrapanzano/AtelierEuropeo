<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $fillable = [
        'name',
        'surname',
        'email',
    ];

    public function projects() {
        return $this->hasMany(Project::class, 'author_id');
    }
}
