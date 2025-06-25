<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    /** @use HasFactory<\Database\Factories\AssociationFactory> */
    use HasFactory;
    protected $table = 'associations';

    protected $fillable = [
        'name',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'association_id');
    }
}
