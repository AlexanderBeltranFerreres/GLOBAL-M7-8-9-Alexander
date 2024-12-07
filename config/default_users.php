<?php


return [
    'default_user' => [
        'name' => env('DEFAULT_USER_NAME', 'Usuari per defecte'),
        'email' => env('DEFAULT_USER_EMAIL', 'usuari@defecte.com'),
        'password' => env('DEFAULT_USER_PASSWORD', 'password'),
    ],
    'default_teacher' => [
        'name' => env('DEFAULT_TEACHER_NAME', 'Mestre per defecte'),
        'email' => env('DEFAULT_TEACHER_EMAIL', 'mestre@defecte.com'),
        'password' => env('DEFAULT_TEACHER_PASSWORD', 'password'),
    ],
    'default_team' => [
        'name' => env('DEFAULT_TEAM_NAME', 'Equip per defecte'),
    ],
];
