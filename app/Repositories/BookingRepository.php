<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Collection;

class BookingRepository
{
    public function getUpcomingBookings(int $userId): Collection
    {
        return Booking::with('studentsClass')
            ->where('user_id', $userId)
            ->where('booking_date', '>=', now()->toDateString())
            ->orderBy('booking_date')
            ->get();
    }

    public function existsForUserOnDate(int $userId, string $date): bool
    {
        return Booking::where('user_id', $userId)
            ->where('booking_date', $date)
            ->exists();
    }

    public function countBookingsForClassOnDate(int $classId, string $date): int
    {
        return Booking::where('class_id', $classId)
            ->where('booking_date', $date)
            ->count();
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }
}
