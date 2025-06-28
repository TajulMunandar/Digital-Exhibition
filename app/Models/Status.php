<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'projectId', 'id');
    }
}
