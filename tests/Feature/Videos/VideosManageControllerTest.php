<?php

namespace Tests\Feature\Videos;

use App\helpers\defaultVideoHelper;
use App\Models\Video;
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
        $video1 = DefaultVideoHelper::crearVideoDefault();
        $video2 = DefaultVideoHelper::crearVideoDefault2();
        $video3 = DefaultVideoHelper::crearVideoDefault3();

        // Login amb permisos
        $videoManager = $this->loginAsVideoManager();

        // Fer la petició GET per accedir a la llista de vídeos
        $response = $this->actingAs($videoManager)->get(route('videos.manage.index'));

        // Assert que la resposta sigui correcta
        $response->assertStatus(200);

        $response->assertSee($video1->title);
        $response->assertSee($video2->title);
        $response->assertSee($video3->title);

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

    public function test_user_with_permissions_can_see_add_videos()
    {
        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->get(route('videos.manage.create'));

        $response->assertStatus(200);
    }

    public function test_user_without_permissions_cannot_see_add_videos()
    {
        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage.create'));

        $response->assertStatus(403); // Forbidden
    }

    public function test_user_with_permissions_can_store_videos()
    {
        $videoData = [
            'title' => 'Nou Video de Prova Desde Test',
            'description' => 'Video Prova Fet desde Test per guardar',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ];

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->post(route('videos.manage.store'), $videoData);

        $response->assertStatus(302);
        $response->assertRedirect(route('videos.manage.index'));

        // Verificar que el vídeo ha estat creat i existeix a la base de dades
        $this->assertDatabaseHas('videos', [
            'title' => $videoData['title'],
            'description' => $videoData['description'],
            'url' => $videoData['url'],
        ]);
    }

    public function test_user_without_permissions_cannot_store_videos()
    {
        $videoData = [
            'title' => 'Nou Video de Prova Desde Test',
            'description' => 'Video Prova Fet desde Test per guardar',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ];

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->post(route('videos.manage.store'), $videoData);

        // Assert que la resposta sigui un error de Forbidden (403)
        $response->assertStatus(403);

        // Comprovar que el vídeo no s'ha creat a la base de dades
        $this->assertDatabaseMissing('videos', [
            'title' => $videoData['title'],
            'description' => $videoData['description'],
            'url' => $videoData['url'],
        ]);
    }

    public function test_user_with_permissions_can_destroy_videos()
    {
        // Crear un vídeo de prova
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test DESTROY',
            'description' => 'Video Prova Fet desde Test per DESTROY',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->delete(route('videos.manage.destroy', $video->id));

        $response->assertRedirect(route('videos.manage.index'));

        // Comprovar que el vídeo s'ha eliminat de la base de dades
        $this->assertDatabaseMissing('videos', [
            'id' => $video->id,
        ]);
    }

    public function test_user_without_permissions_cannot_destroy_videos()
    {
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test DESTROY',
            'description' => 'Video Prova Fet desde Test per DESTROY',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->delete(route('videos.manage.destroy', $video->id));

        $response->assertStatus(403);

        // Comprovar que el vídeo segueix existint a la base de dades
        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
        ]);
    }

    public function test_user_with_permissions_can_see_edit_videos()
    {
        // Crear un vídeo de prova
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test DESTROY',
            'description' => 'Video Prova Fet desde Test per DESTROY',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->get(route('videos.manage.edit', $video->id));

        $response->assertStatus(200);

        // Verificar que la pàgina d'editar vídeo conté el títol del vídeo
        $response->assertSee($video->title);
    }

    public function test_user_without_permissions_cannot_see_edit_videos()
    {
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test DESTROY',
            'description' => 'Video Prova Fet desde Test per DESTROY',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        $regularUser = $this->loginAsRegularUser();

        $response = $this->actingAs($regularUser)->get(route('videos.manage.edit', $video->id));

        $response->assertStatus(403);
    }

    public function test_user_with_permissions_can_update_videos()
    {
        // Crear un vídeo de prova
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test UPDATE',
            'description' => 'Video Prova Fet desde Test per update',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        $videoManager = $this->loginAsVideoManager();

        $response = $this->actingAs($videoManager)->put(route('videos.manage.update', $video->id), [
            'title' => 'Nou Video de Prova Desde Test UPDATE',
            'description' => 'Video Prova Fet desde Test per UPDATE',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        // Assert que la resposta sigui correcta
        $response->assertStatus(302); // Redirecció després d'una actualització exitosa

        // Assert que el vídeo s'ha actualitzat correctament a la base de dades
        $updatedVideo = Video::find($video->id);
        $this->assertEquals('Títol actualitzat', $updatedVideo->title);
        $this->assertEquals('Descripció actualitzada del vídeo.', $updatedVideo->description);
        $this->assertEquals('https://www.youtube.com/watch?v=updatedexample', $updatedVideo->url);
    }

    public function test_user_without_permissions_cannot_update_videos()
    {
        // Crear un vídeo de prova
        $video = Video::create([
            'title' => 'Nou Video de Prova Desde Test UPDATE',
            'description' => 'Video Prova Fet desde Test per update',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        // Login com a usuari sense permisos per gestionar vídeos (per exemple, un usuari regular)
        $regularUser = $this->loginAsRegularUser();

        // Fer la petició PUT per intentar actualitzar el vídeo
        $response = $this->actingAs($regularUser)->put(route('videos.manage.update', $video->id), [
            'title' => 'Nou Video de Prova Desde Test UPDATE',
            'description' => 'Video Prova Fet desde Test per UPDATE',
            'url' => 'https://www.youtube.com/embed/G0gmuXYq1vw?si=uantA7m5IYYbuXeg',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        // Assert que la resposta sigui un error 403 (Forbidden)
        $response->assertStatus(403);

        // Assert que el vídeo no ha estat actualitzat
        $updatedVideo = Video::find($video->id);
        $this->assertEquals('Video de prova', $updatedVideo->title);
        $this->assertEquals('Descripció del vídeo de prova.', $updatedVideo->description);
        $this->assertEquals('https://www.youtube.com/watch?v=example', $updatedVideo->url);
    }
}
