<?php
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

function createDefaultUser()
{
    $existingUser = User::where('email', config('default_users.default_user.email'))->first();

    if ($existingUser) {
        return $existingUser; // Si ja existeix, simplement el retornem
    }

    $user = User::create([
        'name' => config('default_users.default_user.name', 'Usuari per defecte'),
        'email' => config('default_users.default_user.email', 'usuari@defecte.com'),
        'password' => bcrypt(config('default_users.default_user.password', 'password')),
    ]);

    $user->save();

    add_personal_team($user, config('default_users.default_team.name', 'Equip per defecte'));

    // Assignar el rol per defecte
    $user->assignRole('regular');

    return $user;
}


function createDefaultTeacher()
{
    $existingTeacher = User::where('email', config('default_users.default_teacher.email'))->first();

    if ($existingTeacher) {
        return $existingTeacher; // Si ja existeix, simplement el retornem
    }

    $teacher = User::create([
        'name' => config('default_users.default_teacher.name', 'Mestre per defecte'),
        'email' => config('default_users.default_teacher.email', 'mestre@defecte.com'),
        'password' => bcrypt(config('default_users.default_teacher.password', 'password')),
        'super_admin' => true,
    ]);

    $teacher->save();

    add_personal_team($teacher, config('default_users.default_team.name', 'Equip per defecte'));

    // Assignar el rol d'super admin
    $teacher->assignRole('super_admin');

    return $teacher;
}

function add_personal_team(User $user, string $teamName)
{
    $team = Team::create([
        'name' => $teamName,
        'user_id' => $user->id,
        'personal_team' => true,
    ]);

    $user->team()->associate($team);
    $user->save();
}

function create_regular_user()
{
    // Crear l'usuari regular i assignar-li el rol
    $user = User::firstOrCreate(
        ['email' => 'regular@videosapp.com'],
        [
            'name' => 'Regular',
            'password' => bcrypt('123456789'),
        ]
    );

    // Afegir l'equip personal i assignar el rol
    add_personal_team($user, 'Equip per defecte');
    $user->assignRole('regular');

    return $user;
}

function create_video_manager_user()
{
    // Crear l'usuari video manager i assignar-li el rol
    $user = User::firstOrCreate(
        ['email' => 'videosmanager@videosapp.com'],
        [
            'name' => 'Video Manager',
            'password' => bcrypt('123456789'),
        ]
    );

    // Afegir l'equip personal i assignar el rol
    add_personal_team($user, 'Equip per defecte');
    $user->assignRole('video_manager');

    return $user;
}

function create_superadmin_user()
{
    // Crear l'usuari super admin i assignar-li el rol
    $user = User::firstOrCreate(
        ['email' => 'superadmin@videosapp.com'],
        [
            'name' => 'Super Admin',
            'password' => bcrypt('123456789'),
            'super_admin' => true,
        ]
    );

    // Afegir l'equip personal i assignar el rol
    add_personal_team($user, 'Equip per defecte');
    $user->assignRole('super_admin');

    return $user;
}

function define_gates()
{
    // Defineix les portes d'autorització
    Gate::define('manage-videos', function (\App\Models\User $user) {
        return $user->hasRole('video_manager') || $user->isSuperAdmin();
    });

    Gate::define('manage-users', function (\App\Models\User $user) {
        return $user->isSuperAdmin();
    });
}

function create_permissions()
{
    // Defineix els permisos
    $permissions = [
        'create videos',
        'edit videos',
        'delete videos',
        'manage users'
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Defineix els rols i els permisos associats
    $roles = [
        'regular' => [],
        'video_manager' => ['create videos', 'edit videos', 'delete videos'],
        'super_admin' => Permission::pluck('name')->toArray(),
    ];

    foreach ($roles as $role => $perms) {
        $roleInstance = Role::firstOrCreate(['name' => $role]);
        $roleInstance->syncPermissions($perms);
    }
}
