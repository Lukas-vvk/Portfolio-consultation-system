<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'status',
        'teacher_id',
        'time',
    ];

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'consultation_user', 'consultation_id', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_confirmed')->withTimestamps();
    }

    public function getStatusAttribute()
    {
        $currentDate = now();
        return $this->date < $currentDate ? 'ivykusi' : 'planuojama';
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'consultation_user', 'consultation_id', 'user_id')
            ->withPivot('is_confirmed')
            ->withTimestamps();
    }
    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i');
    }
}
