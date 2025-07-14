<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorProject extends Model
{
    /** @use HasFactory<\Database\Factories\MentorProjectFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function Mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentorId');
    }

    public function Kategori()
    {
        return $this->belongsTo(KategoriProject::class, 'kategoriId');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function MentorGroup()
    {
        return $this->hasMany(MentorGroup::class, 'mentorId');
    }
}
