<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'provider_id',
        'proposed_price',
        'message',
        'status',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}