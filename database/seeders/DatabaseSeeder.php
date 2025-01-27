<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345'),
        ]);

        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User Dos',
            'email' => 'testdos@example.com',
            'password' => bcrypt('12345'),
        ]);

        Video::create([
            'title' => 'Vídeo de prova',
            'description' => 'Video de Prova per defecte',
            'url' => 'https://www.youtube.com/watch?v=LCV-VXEbpDk',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);

        Video::create([
            'title' => 'Vídeo de prova Dos',
            'description' => 'Video de Prova per defecte segona prova',
            'url' => 'https://www.youtube.com/watch?v=LCV-VXEbpDk',
            'published_at' => Carbon::now()->toDateTimeString(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);
    }
}
