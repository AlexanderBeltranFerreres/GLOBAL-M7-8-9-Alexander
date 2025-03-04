<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        try {
            // Protegeix la ruta amb el gate 'manage-videos'
            $this->authorize('manage-videos');

            $videos = Video::all();
            return view('videos.manage', compact('videos'));

        } catch (AuthorizationException $e) {
            // Si l'usuari no té permís, retorna una resposta de error
            return response()->json([
                'message' => 'No tens permisos per gestionar vídeos.'
            ], 403);
        }
    }

}
