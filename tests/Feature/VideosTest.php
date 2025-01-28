<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Video;
class VideosTest extends TestCase
{
   public function test_users_can_view_videos()
   {
     $video = Video::create([
            'title' => 'Video TEST',
            'description' => 'Descripció del vídeo TEST',
            'url' => 'https://www.youtube.com/watch?v=video1',
            'published_at' => '2025-01-27 23:19:00',
            'previous' => null,
            'next' => null,
            'series_id' => 1
     ]);

     //petició GET al end point del vide
     $response = $this->get(route('/videos/'.$video->id));

     //Mirem si el estatus és 200 que vol dir que funciona be
       // I mirem el titol
     $response->assertStatus(200);
     $response->assertSee($video->title);
   }

   public function test_users_cant_view_not_existing_videos()
   {
        //petició GET a un video que no existeix
        $response = $this->get(route('/videos/56982'));

        //Mirem si el estatus és 404 que vol dir que no existeix
        $response->assertStatus(404);
   }
}
