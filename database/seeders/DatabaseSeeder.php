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
        // Crear rols de manera segura
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $regularRole = Role::firstOrCreate(['name' => 'regular']);
        $videoManagerRole = Role::firstOrCreate(['name' => 'video_manager']);

        // Crear permisos
        create_permissions();

        // Crear usuaris per defecte
        $superAdmin = create_superadmin_user();
        $regularUser = create_regular_user();
        $videoManager = create_video_manager_user();

        // Assignar rols als usuaris
        $superAdmin->assignRole($superAdminRole);
        $regularUser->assignRole($regularRole);
        $videoManager->assignRole($videoManagerRole);

        // Guardar usuaris
        $superAdmin->save();
        $regularUser->save();
        $videoManager->save();

        // Crear altres usuaris per defecte
        createDefaultTeacher();
        createDefaultUser();

        // Crear vídeos per defecte
        DefaultVideoHelper::crearVideoDefault();

        // Definir portes d'accés (Gates)
        define_gates();
    }
}
