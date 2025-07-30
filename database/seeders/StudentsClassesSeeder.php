<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentsClass;

class StudentsClassesSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            ['class_name' => 'Yoga', 'start_time' => '10:00:00', 'end_time' => '11:00:00', 'capacity' => 3],
            ['class_name' => 'Zumba', 'start_time' => '12:00:00', 'end_time' => '13:00:00', 'capacity' => 2],
            ['class_name' => 'CrossFit', 'start_time' => '15:00:00', 'end_time' => '16:00:00', 'capacity' => 2],
            ['class_name' => 'Pilates', 'start_time' => '08:00:00', 'end_time' => '09:00:00', 'capacity' => 3],
            ['class_name' => 'Kickboxing', 'start_time' => '17:00:00', 'end_time' => '18:00:00', 'capacity' => 20],
            ['class_name' => 'Spin Class', 'start_time' => '06:30:00', 'end_time' => '07:30:00', 'capacity' => 2],
            ['class_name' => 'HIIT', 'start_time' => '09:30:00', 'end_time' => '10:30:00', 'capacity' => 3],
            ['class_name' => 'Boxing', 'start_time' => '11:30:00', 'end_time' => '12:30:00', 'capacity' => 2],
            ['class_name' => 'Strength Training', 'start_time' => '13:30:00', 'end_time' => '14:30:00', 'capacity' => 15],
            ['class_name' => 'Dance Aerobics', 'start_time' => '16:30:00', 'end_time' => '17:30:00', 'capacity' => 2],
            ['class_name' => 'Tai Chi', 'start_time' => '07:30:00', 'end_time' => '08:30:00', 'capacity' => 3],
            ['class_name' => 'Barre', 'start_time' => '10:30:00', 'end_time' => '11:30:00', 'capacity' => 1],
            ['class_name' => 'Kickboxing Advanced', 'start_time' => '18:30:00', 'end_time' => '19:30:00', 'capacity' => 20],
            ['class_name' => 'Yoga for Seniors', 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'capacity' => 8],
            ['class_name' => 'Ballet', 'start_time' => '12:00:00', 'end_time' => '13:00:00', 'capacity' => 4],
            ['class_name' => 'Functional Training', 'start_time' => '14:00:00', 'end_time' => '15:00:00', 'capacity' => 88],
            ['class_name' => 'TRX Suspension', 'start_time' => '17:30:00', 'end_time' => '18:30:00', 'capacity' => 3],
            ['class_name' => 'Core Strength', 'start_time' => '08:30:00', 'end_time' => '09:30:00', 'capacity' => 15],
            ['class_name' => 'Strength and Conditioning', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'capacity' => 2],
            ['class_name' => 'Stretch and Flex', 'start_time' => '19:00:00', 'end_time' => '20:00:00', 'capacity' => 10],
        ];

        foreach ($classes as $class) {
            StudentsClass::firstOrCreate(
                ['class_name' => $class['class_name'], 'start_time' => $class['start_time']], 
                [
                    'end_time' => $class['end_time'],
                    'capacity' => $class['capacity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
