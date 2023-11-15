<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtlVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id',
        'election_id',
        'party_id',
        'priority',
    ];

    public function voter()
    {
        return $this->belongsTo(Voter::class, 'voter_id');
    }

    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id');
    }

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}
