<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    protected $fillable = [
        'name',
        'path',
        'user_id',
        'title_communication',
        'office',
        'remarks',
        'date_received',
    ];

    protected $casts = [
        'date_received' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

