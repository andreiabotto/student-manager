<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Classroom::factory()->count(5)->create();
        Teacher::factory()->count(10)->create();

        // Create students and associate them with classrooms
        Student::factory()->count(50)->create([
            'classroom_id' => Classroom::inRandomOrder()->first()->id, // Ensure classroom exists
            'teacher_id' => Teacher::inRandomOrder()->first()->id, // Ensure classroom exists
        ]);
    }
}
