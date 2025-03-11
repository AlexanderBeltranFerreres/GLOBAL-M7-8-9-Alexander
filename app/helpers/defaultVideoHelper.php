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

    public static function crearVideoDefault2(array $overrides = []){
        $defaultData = [
            'title' => 'Top 5 Monkey',
            'description' => 'This is a default video 2',
            'url' => 'https://www.youtube.com/embed/SPAw3KmyeQ8?si=0ChJ4TIPpFgJbrXx',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ];

        $data = array_merge($defaultData, $overrides);

        return Video::create($data);
    }
    public static function crearVideoDefault3(array $overrides = []){
        $defaultData = [
            'title' => 'C.R.O - Tony Montana (LETRA)',
            'description' => 'This is a default video 3',
            'url' => 'https://www.youtube.com/embed/TGqSWFJDWXM?si=CWJ22qcqYq3sWyKf',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ];

        $data = array_merge($defaultData, $overrides);

        return Video::create($data);
    }

}
