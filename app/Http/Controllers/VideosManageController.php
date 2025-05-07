<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrador');
        }
        $videos = Video::all();

        return view('videos.manage.index', compact('videos'));
    }

    public function create()
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrador');
        }
        return view('videos.manage.create');
    }

    public function store(Request $request)
    {
        //dd(auth()->id());
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrado');
        }
        logger('Abans de crear vídeo', ['user_id' => auth()->id()]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exists:series,id',
        ]);

        $video = Video::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'published_at' => $validated['published_at'],
            'previous' => $validated['previous'],
            'next' => $validated['next'],
            'series_id' => $validated['series_id'],
            'user_id' => auth()->id()
        ]);
        logger('DESPRES de crear vídeo', ['user_id' => auth()->id()]);
        return redirect()->route('videos.manage.index')->with('success', 'El video s\'ha creat correctament');

    }

    public function show(string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrado');
        }

        $video = Video::find($id);

        if(!$video){
            return response()->json([
                'message' => 'El video no existeix'
            ], 404);
        }

        return view('videos.manage.show', compact('video'));
    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrador');
        }

        $video = Video::find($id);

        if(!$video){
            return response()->json([
                'message' => 'El video no existeix'
            ], 404);
        }

        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrador');
        }

        $video = Video::find($id);

        if(!$video){
            return response()->json([
                'message' => 'El video no existeix'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exists:series,id',
        ]);

        $video->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'published_at' => $validated['published_at'],
            'previous' => $validated['previous'],
            'next' => $validated['next'],
            'series_id' => $validated['series_id'],
            'user_id' => auth()->id()
        ]);

        return redirect()->route('videos.manage.index')->with('success', 'El video s\'ha editat correctament');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'Necessites permisos de administrador');
        }

        $video = Video::find($id);

        if(!$video){
            return response()->json([
                'message' => 'El video no existeix'
            ], 404);
        }

        $video->delete();

        return redirect()->route('videos.manage.index')->with('success', 'El video s\' eliminat correctament');
    }

    public function testedBy()
    {
        return VideosManageControllerTest::class;
    }

}
