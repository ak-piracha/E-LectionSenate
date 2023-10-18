<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'election_id',
        'type_id',
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

    public function vote_type()
    {
        return $this->belongsTo(VoteType::class, 'type_id');
    }

    public function candidate()
    {
        return $this->belongsTo(candidate::class, 'candidate_id');
    }
}
