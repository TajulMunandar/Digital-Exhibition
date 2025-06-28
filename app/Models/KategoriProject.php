<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProject extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriProjectFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function MentorProject()
    {
        return $this->hasMany(MentorProject::class, 'kategoriId');
    }

    public function MemberMaster()
    {
        return $this->hasMany(MemberMaster::class, 'kategoriId');
    }
    public function Project()
    {
        return $this->hasMany(Project::class, 'kategoriId');
    }
}
