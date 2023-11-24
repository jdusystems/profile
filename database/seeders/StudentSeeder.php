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
        $studentsData = json_decode(file_get_contents('https://script.google.com/macros/s/AKfycbwgXs73c3IWAi2PeEMZ3HduaB2OsYzU4YjiGcIEpVPxKJDkE4V71dZfK1bOUNXK64yHTg/exec'));
        foreach ($studentsData->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }

        //Intermediate and Upper Japanese Language Attendance 2023-2024 Fall

        $studentsData1 = json_decode(file_get_contents('https://script.google.com/macros/s/AKfycbyV1wBwSdPpObcvdR-Xb-5tCWApVHLi03KWh0MHYzhAKF4oW0QRJHSiTEpJ0xKw1v2KlQ/exec'));
        foreach ($studentsData1->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }
        //Cowork Attendance 2023-2024 Fall
        $studentsData2 = json_decode(file_get_contents('https://script.googleusercontent.com/a/macros/jdu.uz/echo?user_content_key=79lq7ygNU1Qyb9KwSvwqaFdfj2BQZSw2F2lCbw2yF-OlF_yRc0WNVwGGk4h-W-tqVR1a-JE_vBjsIMpe7NfF_2nZgX3OLZjsm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_nRPgeZU6HP87MydjzGMtdEuHIcJ3mEdrFiz6Vwg5WPPdW7qS8VnfsUF94QqIQLnxxi4xszTuKtSOvHLD9NJYvoTNIA43lblWkG6Cv50RUBJi7S-7xcETWhGqtnaZaobs&lib=MgFxl2t93XLh6mBVLkC4YYqZukY-4D7e0'));
        foreach ($studentsData2->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }
        //Enployment skills in Japan Attendance 2023-2024 Fall

        $studentsData3 = json_decode(file_get_contents('https://script.google.com/macros/s/AKfycbzR8WX6xCvcfFW_2cSPwj3SX3dV0whkwnUXqhb3TNbsshAltV6EsYT8J06HN2OwriGkcQ/exec'));
        foreach ($studentsData3->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }
        //JSL Attendance 2023-2024 Fall
        $studentsData4 = json_decode(file_get_contents('https://script.google.com/macros/s/AKfycbwOox8twVTIUaZEMvR_Ql6QRF1iSUAwTNMZ6XjsE7yzXyeu4x3P_xRAgbHHeM_RRy-M/exec'));
        foreach ($studentsData4->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }
        //Partner Universities Attendance 2023-2024 Fall
        $studentsData5 = json_decode(file_get_contents('https://script.google.com/macros/s/AKfycbxLWVF9lVkxvghU-gJGz9PLFE19u7Gqat02iWQzD91vHEFRYvob9U8XgjSb5M1B4jYu/exec'));
        foreach ($studentsData5->data as $student){
            if(empty($student->name) or empty($student->id)){
                continue;
            }
            $name = $student->name;
            $parts = explode(' ' , $name);
            $firstname = $parts[1];
            $surname = $parts[0];
            Student::updateOrCreate(
                [
                    'studentId' => $student->id,
                ],
                [
                    'surname' => $surname,
                    'given_name' => $firstname,
                ]
            );
        }

    }
}
