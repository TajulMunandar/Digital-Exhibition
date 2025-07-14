<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    /** @use HasFactory<\Database\Factories\MentorFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function MentorProject()
    {
        return $this->hasMany(MentorProject::class, 'mentorId');
    }
}
