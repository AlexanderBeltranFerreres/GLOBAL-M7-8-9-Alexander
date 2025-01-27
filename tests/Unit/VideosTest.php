<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Video;
class VideosTest extends TestCase
{
    public function test_can_get_formatted_published_at_date()
    {
        $video = new Video();
        $video-> published_at = '2025-01-27 22:48:00';

        $formattedDate = $video->getFormattedPublishedAtAttribute();

        $this-> assertEquals('27 de 01 de 2025', $formattedDate);
    }

    public function test_can_get_formatted_published_at_date_when_not_published()
    {
        $video = new Video();
        $video-> published_at = null;

        $formattedDate = $video->getFormattedPublishedAtAttribute();

        $this-> assertEquals('No publicat', $formattedDate);
    }

}
