<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'sector',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
