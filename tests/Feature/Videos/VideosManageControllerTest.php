<?php

namespace Tests\Feature\Videos;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        create_permissions();
    }

    public function test_user_with_permissions_can_manage_videos()
    {
        // Login com a VideoManager
        $videoManager = $this->loginAsVideoManager();

        // Fer la petició GET per accedir a la llista de vídeos
        $response = $this->actingAs($videoManager)->get(route('videos.manage.index'));

        // Assert que la resposta sigui correcta
        $response->assertStatus(200);

    }


    public function test_regular_users_cannot_manage_videos()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage.index'));

        $response->assertStatus(403);
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $response = $this->get(route('videos.manage.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_superadmins_can_manage_videos()
    {
        $superAdmin = $this->loginAsSuperAdmin();

        $response = $this->actingAs($superAdmin)->get(route('videos.manage.index'));

        $response->assertStatus(200);
    }

    // Funcions de login per a cada tipus d'usuari
    private function loginAsVideoManager()
    {
        $user = create_video_manager_user();
        $user->save();

        $user->assignRole('video_manager');
        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = create_superadmin_user();
        $user->save();

        $user->assignRole('super_admin');
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = create_regular_user();
        $user->save();

        $user->assignRole('regular');
        return $user;
    }
}
