<?php

namespace Tests\Feature\Videos;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (!Permission::where('name', 'create videos')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'create videos', 'guard_name' => 'web']);
            // Crear permisos per defecte
            Permission::create(['name' => 'create videos']);
            Permission::create(['name' => 'edit videos']);
            Permission::create(['name' => 'delete videos']);

            // Crear rols per defecte amb Spatie
            Role::create(['name' => 'video_manager']);
            Role::create(['name' => 'super_admin']);
            Role::create(['name' => 'regular']);
        }

    }

    public function test_user_with_permissions_can_manage_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->get(route('videos.manage'));

        $response->assertStatus(200);
    }

    public function test_regular_users_cannot_manage_videos()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage'));

        $response->assertStatus(403); // O l'estat que utilitzis per denegar l'accés
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $response = $this->get(route('videos.manage'));

        $response->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_videos()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('videos.manage'));

        $response->assertStatus(200);
    }

    private function loginAsVideoManager()
    {
        $user = $this->createUserWithTeam('video_manager');
        $user->assignRole('video_manager');
        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = $this->createUserWithTeam('super_admin');
        $user->assignRole('super_admin');
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = $this->createUserWithTeam('regular');
        $user->assignRole('regular');
        return $user;
    }

    private function createUserWithTeam($role)
    {
        // Crear un nou usuari
        $user = User::factory()->create();

        // Crear un team per a l'usuari
        $team = Team::factory()->create();
        $user->teams()->attach($team);

        // Assignar el rol corresponent
        $user->assignRole($role);

        // Assignar els permisos segons el rol
        if ($role == 'video_manager') {
            $user->givePermissionTo(['create videos', 'edit videos', 'delete videos']);
        } elseif ($role == 'super_admin') {
            $user->givePermissionTo(['create videos', 'edit videos', 'delete videos']);
        }

        return $user;
    }
}
