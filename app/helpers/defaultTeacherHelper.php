<?php

namespace App\helpers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

function crearProfessorDefault()
{
    $teacherConfig = config('default_users.default_teacher');
    $teamConfig = config('default_users.default_team');

    // Crear el mestre per defecte
    $teacher = User::firstOrCreate(
        ['email' => $teacherConfig['email']],
        [
            'name' => $teacherConfig['name'],
            'password' => Hash::make($teacherConfig['password']),
            'super_admin' => true
        ]
    );

    add_personal_team($teacher, 'Default Teacher Team');


    return $teacher;
}
