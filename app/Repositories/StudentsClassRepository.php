<?php

namespace App\Repositories;

use App\Models\StudentsClass;

class StudentsClassRepository
{
    public function allAvailable($date = null)
    {
        $query = StudentsClass::query();

        if ($date) {
            $query->whereDate('start_time', $date);
        }

        return $query->withCount(['bookings'])->get();
    }

    public function find(int $id): ?StudentsClass
    {
        return StudentsClass::find($id);
    }

    public function findByIdAndDate(int $id, string $date): ?StudentsClass
    {
        return StudentsClass::where('id', $id)
            ->whereDate('start_time', $date)
            ->first();
    }

    public function create(array $data): StudentsClass
    {
        return StudentsClass::create($data);
    }
}
