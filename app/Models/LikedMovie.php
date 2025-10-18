<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LikedMovie extends Model
{
    protected $fillable = ['session_id', 'titles'];

    protected $casts = [
        'titles' => 'array',
    ];
}
