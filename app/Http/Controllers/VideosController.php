<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Routing\Controller;

class VideosController extends Controller
{

    public function show($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'message' => 'Vídeo no s\'ha trobat.'
            ], 404);
        }
        return view('videos.vista', compact('video'));
    }
    public function testedBy()
    {
        return $this->belongsToMany(User::class, 'tested_by', 'video_id', 'user_id');
    }

}
