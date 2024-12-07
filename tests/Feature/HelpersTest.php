<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use function App\helpers\crearProfessorDefault;
use function app\helpers\crearUsuariDefault;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_crearUsuariDefault()
    {
        // Arrange: Configurar les dades per l'usuari i l'equip (ambdues a default_users)
        $userConfig = config('default_users.default_user');
        $teamConfig = config('default_users.default_team');

        // Act: Crear l'usuari per defecte
        $user = crearUsuariDefault();
        dump("Usuari creat:", $user->toArray()); // Mostrar les dades de l'usuari creat

        // Assert: Verificar que l'usuari es crea correctament
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'name' => $userConfig['name'],
            'email' => $userConfig['email'],
        ]);
        dump("Usuari trobat a la base de dades."); // Missatge si arriba aquí

        // Assert: Verificar que la contrasenya és correcta
        $this->assertTrue(Hash::check($userConfig['password'], $user->password));
        dump("Contrasenya validada correctament."); // Missatge si passa la validació

        // Act: Recuperar l'equip associat a l'usuari (utilitzant el mateix nom de configuració)
        $team = Team::where('name', $teamConfig['name'])->first();
        dump("Equip recuperat:", $team->toArray()); // Mostrar les dades de l'equip

        // Assert: Verificar que l'usuari està associat a l'equip correctament
        $this->assertTrue($user->teams->contains($team));
        dump("Usuari associat correctament a l'equip.");
    }

    public function test_crearProfessorDefault()
    {
        // Arrange: Preparar les dades de configuració necessàries per al test
        $teacherConfig = config('default_users.default_teacher');
        $teamConfig = config('default_users.default_team');

        // Act: Crear el professor per defecte
        $teacher = crearProfessorDefault();
        dump("Professor creat:", $teacher->toArray()); // Mostrar les dades del professor creat

        // Assert: Verificar que el professor ha estat creat correctament
        $this->assertInstanceOf(User::class, $teacher);

        // Assert: Verificar que el professor existeix a la base de dades
        $this->assertDatabaseHas('users', [
            'name' => $teacherConfig['name'],
            'email' => $teacherConfig['email'],
        ]);
        dump("Professor trobat a la base de dades."); // Missatge si arriba aquí

        // Assert: Verificar que la contrasenya s'ha encriptat correctament
        $this->assertTrue(Hash::check($teacherConfig['password'], $teacher->password));
        dump("Contrasenya del professor validada correctament."); // Missatge si passa la validació

        // Act: Recuperar l'equip associat
        $team = Team::where('name', $teamConfig['name'])->first();
        dump("Equip recuperat:", $team->toArray()); // Mostra les dades de l'equip

        // Assert: Verificar que el professor està associat a l'equip
        $this->assertTrue($teacher->teams->contains($team));
        dump("Professor associat correctament a l'equip.");
    }

}
