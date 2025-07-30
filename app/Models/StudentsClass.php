<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsClass extends Model
{
    protected $fillable = [
        'class_name',
        'start_time',
        'end_time',
        'capacity',
    ];

    public function bookings() { 
        return $this->hasMany(Booking::class, 'class_id'); 
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bookings', 'class_id', 'user_id')
                    ->withPivot('booking_date');
    }

}
