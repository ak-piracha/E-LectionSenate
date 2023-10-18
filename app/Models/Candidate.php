<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'party_id',
        'status',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}
