<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentee extends Model
{
    /** @use HasFactory<\Database\Factories\MenteeFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
    public function Kategori()
    {
        return $this->belongsTo(KategoriProject::class, 'kategoriId', 'id');
    }
}
