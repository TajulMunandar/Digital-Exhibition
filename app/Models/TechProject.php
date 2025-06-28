<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechProject extends Model
{
    /** @use HasFactory<\Database\Factories\TechProjectFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Tech()
    {
        return $this->belongsTo(Tech::class, 'techId', 'id');
    }

    public function Project()
    {
        return $this->belongsToMany(Project::class, 'tech_projects', 'techId', 'projectId');
    }
}
