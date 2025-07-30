<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StudentsClassService;
use App\Http\Requests\StudentClassRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StudentClassController extends Controller
{
    public function __construct(
        private StudentsClassService $studentsClassService
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $date = $request->query('date');
            $classes = $this->studentsClassService->getAvailableClasses($date);

            return api_success($classes, 'Classes fetched successfully.', 200);
        } catch (HttpException $e) {
            return api_error($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('StudentsClass index error', [
                'error' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return api_error('Unexpected error while fetching classes.', 500);
        }
    }

    public function store(StudentClassRequest $request): JsonResponse
    {
        try {
            $class = $this->studentsClassService->createClass($request->validated());
            return api_success($class, 'Class created successfully.', 201);
        } catch (HttpException $e) {
            return api_error($e->getMessage(), $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('StudentsClass create error', [
                'error' => $e->getMessage(),
                'input' => $request->all()
            ]);
            return api_error('Unexpected error while creating class.', 500);
        }
    }
}
