<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'projectId', 'id');
    }
    
    public function MemberMaster()
    {
        return $this->belongsTo(MemberMaster::class, 'roleId', 'id');
    }
}
