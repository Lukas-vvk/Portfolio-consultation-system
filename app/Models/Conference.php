<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'status',
    ];

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'conference_user', 'conference_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getStatusAttribute()
    {
        $currentDate = now();
        return $this->date < $currentDate ? 'ivykusi' : 'planuojama';
    }
}

