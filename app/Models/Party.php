<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader',
    ];

    public function party_elections()
    {
        return $this->belongsToMany(PartyElection::class);
    }
}
