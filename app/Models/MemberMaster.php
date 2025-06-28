<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberMaster extends Model
{
    /** @use HasFactory<\Database\Factories\MemberMasterFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function Kategori()
    {
        return $this->belongsTo(KategoriProject::class, 'kategoriId', 'id');
    }

    public function Member()
    {
        return $this->hasMany(Member::class, 'roleId');
    }
}
