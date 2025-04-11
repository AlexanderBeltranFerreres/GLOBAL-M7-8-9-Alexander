<?php
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


function createDefaultUser()
{

    $user = User::create([
        'name' => config('default_users.default_user.name'),
        'email' => config('default_users.default_user.email'),
        'password' => bcrypt(config('default_users.default_user.password')),
    ]);

    $user->save();


    add_personal_team($user, 'Default Team');

    return $user;
}

function createDefaultTeacher()
{

    $teacher = User::create([
        'name' => config('default_users.default_teacher.name'),
        'email' => config('default_users.default_teacher.email'),
        'password' => bcrypt(config('default_users.default_teacher.password')),
        'super_admin' => true,
    ]);

    $teacher->save();

    add_personal_team($teacher, 'Default Teacher Team');

    return $teacher;
}


function add_personal_team(User $user, string $teamName)
{

    $user->save();

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
    $user = User::create([
        'name' => 'Regular',
        'email' => 'regular@videosapp.com',
        'password' => bcrypt('123456789'),
    ]);
    $user->save();

    add_personal_team($user, 'Regular Team');

    return $user;
}

function create_video_manager_user()
{
    $user = User::create([
        'name' => 'Video Manager',
        'email' => 'videosmanager@videosapp.com',
        'password' => bcrypt('123456789'),
    ]);
    $user->save();

    add_personal_team($user, 'Video Manager Team');

    return $user;
}



function create_superadmin_user()
{
    $user = User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@videosapp.com',
        'password' => bcrypt('123456789'),
        'super_admin' => true,
        'id' => 1,
    ]);
    $user->save();

    add_personal_team($user, 'Super Admin Team');

    return $user;
}

function define_gates()
{
    Gate::define('manage-videos', function (\App\Models\User $user) {
        return $user->hasRole('video_manager') || $user->isSuperAdmin();
    });

    Gate::define('manage-users', function (\App\Models\User $user) {
        return $user->isSuperAdmin();
    });
}


function create_permissions()
{
    //Borrem cache de permisos
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
        'manage users',
        'manage videos',
        'manage series',
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission,  'guard_name' => 'web']);
    }

    $roles = [
        'regular' => [],
        'video_manager' => ['manage videos'],
        'super_admin' => Permission::pluck('name')->toArray(),
    ];

    foreach ($roles as $role => $perms) {
        $roleInstance = Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        $roleInstance->syncPermissions($perms); //Guardem els permisos
    }
    $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
    $superAdmin->syncPermissions(Permission::all());
}
