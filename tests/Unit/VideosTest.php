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

}
