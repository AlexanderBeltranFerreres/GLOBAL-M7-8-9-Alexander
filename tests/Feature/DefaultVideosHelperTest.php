<?php

namespace Tests\Feature;

use App\helpers\DefaultVideoHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class DefaultVideosHelperTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_default_video()
    {
        $video = DefaultVideoHelper::crearVideoDefault();

        $this->assertDatabaseHas('videos', [
            'title' => 'Vídeo de prova',
            'description' => 'Video de Prova per defecte',
            'url' => 'https://www.youtube.com/watch?v=LCV-VXEbpDk',
        ]);

        $this->assertEquals('Vídeo de prova', $video->title);
        $this->assertEquals('Video de Prova per defecte', $video->description);
        $this->assertEquals('https://www.youtube.com/watch?v=LCV-VXEbpDk', $video->url);
    }

}
