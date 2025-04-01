<?php
namespace App\helpers;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class defaultVideoHelper {
    public static function crearVideoDefault(array $overrides = [])
    {
        $defaultData = [
            'title' => 'PAIN',
            'description' => 'Video de Prova per defecte',
            'url' => 'https://www.youtube.com/embed/1GGRfdd2tcs?si=GqE1JA_gBfQBL0kd',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
            'user_id' => 3,
        ];

        $data= array_merge($defaultData, $overrides);

        return Video::create($data);
    }

    public static function crearVideoDefault2(array $overrides = []){
        $defaultData = [
            'title' => 'Black Roses',
            'description' => 'Video de Prova per defecte 2',
            'url' => 'https://www.youtube.com/embed/j05bvEDJWAo?si=lF7hZ--Jc4DAX7KF',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
            'user_id' => 1,
        ];

        $data = array_merge($defaultData, $overrides);

        return Video::create($data);
    }
    public static function crearVideoDefault3(array $overrides = []){
        $defaultData = [
            'title' => 'Street Shark',
            'description' => 'Video de Prova per defecte 3',
            'url' => 'https://www.youtube.com/embed/G80kKs0ait4?si=Bf8SwCK3fT3oqj-8',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
            'user_id' => 3,
        ];

        $data = array_merge($defaultData, $overrides);

        return Video::create($data);
    }

}
