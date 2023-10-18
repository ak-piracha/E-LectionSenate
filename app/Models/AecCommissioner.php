<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AecCommissioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'aec_commissioners',
        'user_id',
        'phone_number',
        'started_at',
        'end_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
