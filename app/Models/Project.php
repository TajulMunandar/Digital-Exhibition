<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Kategori()
    {
        return $this->belongsTo(KategoriProject::class, 'kategoriId', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function Member()
    {
        return $this->hasMany(Member::class, 'projectId');
    }

    public function Teches()
    {
        return $this->belongsToMany(Tech::class, 'tech_projects', 'projectId', 'techId');
    }

    public function Status()
    {
        return $this->hasMany(Status::class, 'projectId');
    }
}
