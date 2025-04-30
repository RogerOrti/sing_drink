<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MultimediaMusic;
use App\Http\Controllers\Controller;
use App\Http\Resources\MultimediaMusicResource;

class MultimediaMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $multimediaMusic = MultimediaMusic::all();

        return MultimediaMusicResource::collection($multimediaMusic);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file("file");
        $TipoMultimedia = $request->input("id_tipo_multimedia");
        $IDuser = $request->input("id_user");
        // Guardar el archivo en la carpeta public/media
        $file->storeAs('', $file->getClientOriginalName(), 'public');
        $multimedia = new MultimediaMusic();
        $multimedia->ruta = 'media/' . $file->getClientOriginalName(); // Ruta relativa
        $multimedia->data = now();
        $multimedia->id_tipo_multimedia = $TipoMultimedia;
        $multimedia->music_id_user = $IDuser;
        $multimedia->save();
        return response()->json(['message' => 'Multimedia subida correctamente']);
    }



    /**
     * Display the specified resource.
     */
    public function show(MultimediaMusic $multimediaMusic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MultimediaMusic $multimediaMusic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MultimediaMusic $multimediaMusic)
    {
        //
    }
}
