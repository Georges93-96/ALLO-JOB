<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',
        'service_id',
        'title',
        'description',
        'budget',
        'ville',
        'quartier',
        'status',
    ];
    public function applications()
{
    return $this->hasMany(\App\Models\Application::class);
}
}