<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar la relación con 'user' y 'multimedia'
        $musics = Music::with(['user', 'multimedia'])->get();

        return MusicResource::collection($musics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        // $musicData = Music::select('musics.*', 'usuaris.nom')
        //     ->join('usuaris', 'musics.id_user', '=', 'usuaris.id_user') // Corregido aquí
        //     ->where('musics.id_user', $music->id_user) // Asegurar que 'id_music' se refiera a 'musics'
        //     ->first();

        // return response()->json(['music' => $musicData]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        //
    }
}
