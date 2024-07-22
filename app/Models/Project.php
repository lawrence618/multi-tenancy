<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    protected static function booted(): void 
    {
        static::creating(function (Project $project) {
            $project->user_id = auth()->id();
        });

        static::addGlobalScope(function (Builder $builder) { 
            $builder->where('user_id', auth()->id());
        });
    } 
}
