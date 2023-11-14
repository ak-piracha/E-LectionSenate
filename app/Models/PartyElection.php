<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyElection extends Model
{
    use HasFactory;

    protected $fillable = [
        'election_id',
        'party_id',
    ];

    public function elections()
    {
        return $this->belongsToMany(Election::class);
    }

    public function parties()
    {
        return $this->belongsToMany(Party::class);
    }
}
