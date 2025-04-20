<?php

namespace App\Http\Controllers\Api;

use App\Models\Music;
use Illuminate\Support\Carbon;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;

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
    public function indexPaginado()
    {
        $musics = Music::with(['user', 'multimedia'])->paginate(1);
        return MusicResource::collection($musics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $file = $request->file("file");
            $ruta = $file->storeAs('public/media', $file->getClientOriginalName());

            $multimedia = new Multimedia();
            $multimedia->ruta = $ruta;
            $multimedia->data = Carbon::now();
            $multimedia->id_tipo_multimedia = $request->input("id_tipo_multimedia"); // o $request->input("id_tipo_multimedia")
            $multimedia->save();

            $music = new Music();
            $music->id_user = $request->input("id_user");
            $music->id_estil = $request->input("id_estil");
            $music->id_multimedia = $multimedia->id_multimedia;
            $music->save();

            DB::commit();

            return response()->json(['message' => 'Music creada correctament'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al crear music', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
        {
            $musicData = Music::with(['user', 'multimedia', 'estilMusica'])
                ->where('id_user', $music->id_user)
                ->where('id_estil', $music->id_estil)
                ->where('id_multimedia', $music->id_multimedia)
                ->first();

            return response()->json(['music' => $musicData]);
        }



    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Music $music)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile("file")) {
                $file = $request->file("file");
                $ruta = $file->storeAs('public/media', $file->getClientOriginalName());

                $multimedia = $music->multimedia;
                $multimedia->ruta = $ruta;
                $multimedia->data = Carbon::now();
                $multimedia->save();
            }

            $music->id_user = $request->input("id_user", $music->id_user);
            $music->id_estil = $request->input("id_estil", $music->id_estil);
            $music->save();

            DB::commit();

            return response()->json(['message' => 'Music actualitzada correctament']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al actualitzar music', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        try {
            DB::beginTransaction();

            $music->delete();

            DB::commit();

            return response()->json(['message' => 'Music eliminada correctament']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error al eliminar music', 'error' => $e->getMessage()], 500);
        }
    }
}
