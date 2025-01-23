<?php
namespace App\helpers;

use App\Models\User;
use App\Models\Team;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

function crearVideoDefault(array $overrides = [])
{
    $defaultData = [
        'title' => 'Vídeo de prova',
        'description' => 'Video de Prova per defecte',
        'url' => 'https://www.youtube.com/watch?v=LCV-VXEbpDk',
        'thumbnail' => 'https://i.ytimg.com/vi/6v2L2UGZJAM/hqdefault.jpg',
        'duration' => 60,
        'visibility' => 'public',
        'series_id' => 1,
        'published_at' => Carbon::now()->toDateTimeString()
    ];

    $data= array_merge($defaultData, $overrides);

    return Video::create($data);
}
