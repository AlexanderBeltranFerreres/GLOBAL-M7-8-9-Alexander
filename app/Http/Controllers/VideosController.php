<?php

namespace App\Http\Controllers;

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
        return response()->json($video);
    }
    public function testedBy($id)
    {
        // Recuperem el vídeo per ID
        $video = Video::find($id);

        if (!$video) {
            return response()->json([
                'message' => 'Vídeo no trobat.'
            ], 404);
        }
        $testers = $video->testedBy;
        return response()->json($testers);
    }

}
