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
        ]
    );

    // Crear l'equip si no existeix i associar-lo a l'usuari (teacher)
    $team = Team::firstOrCreate(
        ['name' => $teamConfig['name']],
        ['personal_team' => true, 'user_id' => $teacher->id] // Assignar user_id
    );

    // Associar el mestre a l'equip si encara no s'ha fet
    $teacher->teams()->syncWithoutDetaching([$team->id]);

    return $teacher;
}
