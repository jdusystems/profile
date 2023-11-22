<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentsData = [
            ['student_id' => "211132" ,'surname' => "Abduvohidov",'given_name' => "Abdug'afforxon"] ,
            ['student_id' => "211782" ,'surname' => "Ahmedov",'given_name' => "Suhrob"] ,
            ['student_id' => "220708" ,'surname' => "Azimxo'jayev",'given_name' => "Abdulazizxo'ja"] ,
            ['student_id' => "T19B0007" ,'surname' => "Botirov",'given_name' => "Saydiaxror"] ,
            ['student_id' => "214843" ,'surname' => "Boysoatov",'given_name' => "Asilbek"] ,
        ];
        foreach ($studentsData as $studentData){
            Student::create([
                'student_id' => $studentData['student_id'],
                'surname' => $studentData['surname'],
                'given_name' => $studentData['given_name'],
            ]);
        }
    }
}
