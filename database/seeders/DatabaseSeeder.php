<?php

namespace Database\Seeders;

use App\helpers\defaultVideoHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Borrem cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        create_permissions();

        // Crear usuaris per defecte
        $superAdmin = create_superadmin_user();
        $regularUser = create_regular_user();
        $videoManager = create_video_manager_user();

        $superAdmin->refresh()->assignRole('super_admin');
        $regularUser->refresh()->assignRole('regular');
        $videoManager->refresh()->assignRole('video_manager');

        $superAdmin->syncPermissions(Permission::all());

        // Guardar usuaris
        /*$superAdmin->save();
        $regularUser->save();
        $videoManager->save();*/



        createDefaultTeacher();
        createDefaultUser();


        DefaultVideoHelper::crearVideoDefault();
        DefaultVideoHelper::crearVideoDefault2();
        DefaultVideoHelper::crearVideoDefault3();

        define_gates();
    }
}
