<?php

namespace App\helpers;

use App\Models\Serie;
use Carbon\Carbon;

class seriesHelper
{
    public static function createDefaultSerie1()
    {
        return Serie::create([
            'title' => 'Canonico',
            'description' => 'Descripcio Canonica',
            'image' => null,
            'user_name' => 'Admin',
            'user_photo_url' => null,
            'published_at' => Carbon::now()->subDays(rand(0, 10)),
        ]);
    }
    public static function createDefaultSerie2()
    {
        return Serie::create([
            'title' => 'Formatadora',
            'description' => 'Descripcio formatadora',
            'image' => null,
            'user_name' => 'Admin',
            'user_photo_url' => null,
            'published_at' => Carbon::now()->subDays(rand(0, 10)),
        ]);
    }
    public static function createDefaultSerie3()
    {
        return Serie::create([
            'title' => 'Ramses II',
            'description' => 'Descripcio Ramses II',
            'image' => null,
            'user_name' => 'Admin',
            'user_photo_url' => null,
            'published_at' => Carbon::now()->subDays(rand(0, 10)),
        ]);
    }
}
