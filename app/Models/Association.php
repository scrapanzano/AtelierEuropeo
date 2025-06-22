<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Association extends Model
{
    use HasFactory;

    protected $table = 'association';

    protected $fillable = [
        'name',
        'description',
    ];

    public function projects() {
        return $this->hasMany(Project::class, 'association_id');
    }
}
