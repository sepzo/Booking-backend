<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookClassRequest;
use App\Services\BookingService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; 

class BookingController extends Controller
{
    public function __construct(
        private BookingService $bookingService
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            //get the authenticated user's upcoming bookings
            $bookings = $this->bookingService->getUserUpcomingBookings($request->user()->id);
            return api_success($bookings, 'Bookings fetched successfully.');
            
        } catch (\Exception $e) {
            return api_error('Unexpected error while fetching bookings.', 500);
            Log::error('Bookings fetch error', ['error' => $e->getMessage()]);
        }
    }

    public function store(BookClassRequest $request): JsonResponse
    {
        $user = $request->user();

        try {
            $booking = $this->bookingService->bookClassForUser(
                $user->id,
                $request->class_id,
                $request->booking_date
            );
            return api_success($booking, 'Booked successfully.', 201);

        } catch (\Exception $e) {
            // Check deadlock
            if ($e->getCode() === '40P01') {  // PostgreSQL deadlock error code
                return api_error('Deadlock detected. Please try again later.', 409);
            }

            // Handle other exceptions 
            if ($e->getCode() === 404) {
                return api_error($e->getMessage(), 404);
            }
            if ($e->getCode() === 409) {
                return api_error($e->getMessage(), 409);
            }

            // Catch other exceptions with generic error message
            return api_error('Unexpected error. Try again later.', 500);
        }
    }

}
