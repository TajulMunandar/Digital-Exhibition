<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorGroup extends Model
{
    /** @use HasFactory<\Database\Factories\MentorGroupFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'projectId', 'id');
    }

    public function MentorProject()
    {
        return $this->belongsTo(MentorProject::class, 'mentorId', 'id');
    }
}
