<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'booking_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentsClass()
    {
        return $this->belongsTo(StudentsClass::class, 'class_id');
    }
}
