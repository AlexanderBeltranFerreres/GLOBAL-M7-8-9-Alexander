<?php
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

function createDefaultUser()
{
    return createUser(
        config('default_users.default_user.email', 'usuari@defecte.com'),
        config('default_users.default_user.name', 'Usuari per defecte'),
        config('default_users.default_user.password', 'password'),
        'regular'
    );
}

function createDefaultTeacher()
{
    return createUser(
        config('default_users.default_teacher.email', 'mestre@defecte.com'),
        config('default_users.default_teacher.name', 'Mestre per defecte'),
        config('default_users.default_teacher.password', 'password'),
        'super_admin',
        true // Marca com a super_admin
    );
}

function create_regular_user()
{
    return createUser(
        'regular@videosapp.com',
        'Regular',
        '123456789',
        'regular'
    );
}

function create_video_manager_user()
{
    return createUser(
        'videosmanager@videosapp.com',
        'Video Manager',
        '123456789',
        'video_manager'
    );
}

function create_superadmin_user()
{
    return createUser(
        'superadmin@videosapp.com',
        'Super Admin',
        '123456789',
        'super_admin',
        true // Marca com a super_admin
    );
}

function createUser($email, $name, $password, $role, $superAdmin = false)
{
    // Crea o obté un usuari amb els paràmetres especificats
    $user = User::firstOrCreate(
        ['email' => $email],
        [
            'name' => $name,
            'password' => bcrypt($password),
            'super_admin' => $superAdmin,
        ]
    );

    // Comprovem que $user sigui una instància de User
    if ($user instanceof User) {
        add_personal_team($user, 'Equip per defecte');
        $user->assignRole($role);
    }

    return $user;
}

function add_personal_team(User $user, string $teamName)
{
    // Comprova si l'usuari ja té un equip assignat
    if (!$user->team) {
        // Crea un nou equip per l'usuari
        $team = Team::create([
            'name' => $teamName,
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        // Associa aquest equip amb l'usuari
        $user->team()->associate($team);

        // Desa els canvis de l'usuari, assignant-li l'equip creat
        $user->save();
    }
}

function define_gates()
{
    Gate::define('manage-videos', fn(User $user) => $user->can('manage videos'));
    Gate::define('manage-users', fn(User $user) => $user->can('manage users'));
}

function create_permissions()
{
    $permissions = ['create videos', 'edit videos', 'delete videos', 'manage videos', 'manage users'];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    $roles = [
        'regular' => [],
        'video_manager' => ['create videos', 'edit videos', 'delete videos', 'manage videos'],
        'super_admin' => Permission::pluck('name')->toArray(),
    ];

    foreach ($roles as $role => $perms) {
        Role::firstOrCreate(['name' => $role])->syncPermissions($perms);
    }
}
