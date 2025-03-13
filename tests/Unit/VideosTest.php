<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Video;
class VideosTest extends TestCase
{
    public function test_can_get_formatted_published_at_date()
    {
        $video = new Video();
        $video-> published_at = '2025-01-27 22:48:00';

        $formattedDate = $video->getFormattedPublishedAtDate();

        $this-> assertEquals('27/01/2025 22:48', $formattedDate);
    }

    public function test_can_get_formatted_published_at_date_when_not_published()
    {
        $video = new Video();
        $video-> published_at = null;

        $formattedDate = $video->getFormattedPublishedAtDate();

        $this-> assertEquals('No publicat', $formattedDate);
    }

    public function test_user_without_permissions_can_see_default_videos_page()
    {
        // Crear un usuari sense permisos
        $user = User::factory()->create();

        // Realitzar una petició GET a la pàgina per defecte de vídeos
        $response = $this->actingAs($user)->get(route('videos.index'));

        // Verificar que l'usuari pot veure la pàgina de vídeos
        $response->assertStatus(200);
        $response->assertSee('Videos');
    }

    public function test_user_with_permissions_can_see_default_videos_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('manage videos');

        // Realitzar una petició GET a la pàgina per defecte de vídeos
        $response = $this->actingAs($user)->get(route('videos.index'));

        // Verificar que l'usuari pot veure la pàgina de vídeos
        $response->assertStatus(200);
        $response->assertSee('Videos');
    }

    public function test_not_logged_users_can_see_default_videos_page()
    {
        // Peticio sense estar loguejat
        $response = $this->get(route('videos.index'));

        // Verificar que la resposta és exitosa i l'usuari no ha d'estar autenticat
        $response->assertStatus(200);
        $response->assertSee('Videos');
    }


}
