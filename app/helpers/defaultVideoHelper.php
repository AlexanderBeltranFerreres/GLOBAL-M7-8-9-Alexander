<?php
namespace App\helpers;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class defaultVideoHelper {
    public static function crearVideoDefault(array $overrides = [])
    {
        $defaultData = [
            'title' => 'Vídeo de prova',
            'description' => 'Video de Prova per defecte',
            'url' => 'https://www.youtube.com/watch?v=LCV-VXEbpDk',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
        ];

        $data= array_merge($defaultData, $overrides);

        return Video::create($data);
    }

}
