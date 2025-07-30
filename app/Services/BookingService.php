<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Repositories\StudentsClassRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingService
{
    public function __construct(
        private BookingRepository $bookingRepo,
        private StudentsClassRepository $classRepo
    ) {}

    public function getUserUpcomingBookings(int $userId)
    {
        return $this->bookingRepo->getUpcomingBookings($userId);
    }

    // Book a class for the user if not already booked and if capacity allows.
    public function bookClassForUser(int $userId, int $classId, string $date)
    {
        DB::transaction(function () use ($userId, $classId, $date) {
                // Set the lock timeout for this transaction
                DB::statement('SET lock_timeout = \'5s\'');

                // Class locked the row for update
                $class = $this->classRepo->findByIdAndDate($classId, $date); 
                if (!$class) {
                    throw new \Exception('No Class exists for this date.', 404);
                }

                
                // Check if the user has already booked a class for the same date
                if ($this->bookingRepo->existsForUserOnDate($userId, $date)) {
                    throw new \Exception('You have already booked a class for this day.', 409);
                }

                // Count the number of slots available for a class on the given date
                $count = $this->bookingRepo->countBookingsForClassOnDate($classId, $date);
                if ($count >= $class->capacity) {
                    throw new \Exception('Class does not have any slots to book.', 409);
                }

                $booking = $this->bookingRepo->create([
                    'user_id'      => $userId,
                    'class_id'     => $classId,
                    'booking_date' => $date,
                ]); 

                return $booking;
            }, 5);  // transaction timeout
    }

}
