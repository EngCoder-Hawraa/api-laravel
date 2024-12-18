<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => 'Ahmed Elsayed',
                'age' => 33,
                'grade' => 'First Grade',
                'gender' => 'Male',
                'favourite_sports' => json_encode(['Tennis', 'Basketball']),
            ],
            [
                'name' => 'Eman Mohamed',
                'age' => 14,
                'grade' => 'Second Grade',
                'gender' => 'Female',
                'favourite_sports' => json_encode(['Basketball', 'Swimming']),
            ],
            [
                'name' => 'Mohamed Ibrahim',
                'age' => 16,
                'grade' => 'First Grade',
                'gender' => 'Male',
                'favourite_sports' => json_encode(['Tennis', 'Football']),
            ],
        ]);
    }
}
