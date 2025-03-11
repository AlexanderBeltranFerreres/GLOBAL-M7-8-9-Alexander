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

    add_personal_team($user, 'Default User Team');


    return $user;
}


