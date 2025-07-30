<?php

namespace App\Services;

use App\Repositories\StudentsClassRepository;

class StudentsClassService
{
    public function __construct(
        private StudentsClassRepository $classRepo
    ) {}

    ///// Get all classes with real-time capacity checks.
    public function getAvailableClasses($date = null)
    {
        return $this->classRepo->allAvailable($date);
    }

    ///// Fetch a single class by its ID. 
    public function getClassById(int $id)
    {
        return $this->classRepo->find($id);
    }

    public function createClass(array $data)
    {
        return $this->classRepo->create($data);
    }
}
