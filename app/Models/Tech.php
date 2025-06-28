<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    /** @use HasFactory<\Database\Factories\TechFactory> */
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function TechProject()
    {
        return $this->hasMany(Tech::class, 'techId');
    }
}
