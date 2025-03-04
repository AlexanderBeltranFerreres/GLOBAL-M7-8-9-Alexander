<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AddVideoPermissions extends Migration
{
    public function up()
    {
        // Crear els permisos per a vídeos
        Permission::create(['name' => 'create videos']);
        Permission::create(['name' => 'edit videos']);
        Permission::create(['name' => 'delete videos']);
    }

    public function down()
    {
        // Eliminar els permisos per a vídeos
        Permission::whereIn('name', ['create videos', 'edit videos', 'delete videos'])->delete();
    }
}
