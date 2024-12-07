<?php

namespace App\helpers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

function crearUsuariDefault()
{
    $userConfig = config('default_users.default_user');
    $teamConfig = config('default_users.default_team');

    // Crear l'usuari per defecte
    $user = User::firstOrCreate(
        ['email' => $userConfig['email']],
        [
            'name' => $userConfig['name'],
            'password' => Hash::make($userConfig['password']),
        ]
    );

    // Crear l'equip si no existeix i associar-lo a l'usuari
    $team = Team::firstOrCreate(
        ['name' => $teamConfig['name']],
        ['personal_team' => true, 'user_id' => $user->id] // Assignar user_id
    );

    // Associar l'usuari a l'equip
    $user->teams()->syncWithoutDetaching([$team->id]);

    return $user;
}
