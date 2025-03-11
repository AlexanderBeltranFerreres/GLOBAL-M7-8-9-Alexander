<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VideosController extends Controller
{
    use AuthorizesRequests;

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

    public function manage()
    {
        if(auth()->user()->can('manage-videos')) {
            return view('videos.manage');
        }
        abort(403, 'No tens autorització');
    }

    public function index()
    {
        $videos = Video::all();

        return view('videos.index', compact('videos'));
    }
}
