<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BtlVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id',
        'election_id',
        'candidate_id',
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

    public function candidate()
    {
        return $this->belongsTo(candidate::class, 'candidate_id');
    }
}
