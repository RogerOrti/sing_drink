<?php

namespace App\Http\Controllers\Api;

use App\Models\MultimediaLocal;
use App\Models\MultimediaMusic;
use App\Models\Local;
use App\Models\Music;
use App\Models\Usuari;
use App\Clases\Utilitat;
use App\Models\propietari;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsuariResource;
use Illuminate\Database\QueryException;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = Usuari::with('roluser')->get();
        return UsuariResource::collection($usuaris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    try {

        DB::beginTransaction();

        $usuari = new Usuari();

        $usuari->nom = $request->input("nom");
        $usuari->cognom = $request->input("cognom");
        $usuari->mail = $request->input("email");
        $usuari->contrasenya = Hash::make($request->input("contrasenya"));
        $usuari->id_rol = $request->input("tipus_usuari");

        $usuari->save();

        if($usuari->id_rol == 2){

            $music = new Music();

            $music->id_user = $usuari->id_user;
            $music->id_estil = $request->input("estilMusica");

            $music->save();


            $multimedia = new MultimediaMusic();

            $file = $request->file("file");
           // $ruta = $file->storeAs('public/media', $file->getClientOriginalName());
            $file->storeAs('', $file->getClientOriginalName(), 'public');
            // $multimedia->ruta = $ruta;
            $multimedia->ruta = 'media/' . $file->getClientOriginalName(); // Ruta relativa
            $multimedia->data = Carbon::now();
            $multimedia->id_tipo_multimedia = 1;
            $multimedia->music_id_user = $usuari->id_user;

            $multimedia->save();

        }

        elseif ($usuari->id_rol == 3) {

            $local = new Local();
            $local->nom_local = $request->input("nom_local");
            $local->direccio = $request->input("direccio");
            $local->id_tipo_local = $request->input("tipusLocal");
            $local->save();

            $propietari = new propietari();
            $propietari->id_user = $usuari->id_user;
            $propietari->id_local = $local->id_local;

            $propietari->save();

            $multimedia = new MultimediaLocal();

            $file = $request->file("file");

            // $ruta = $file->storeAs('public/media', $file->getClientOriginalName());
            $file->storeAs('', $file->getClientOriginalName(), 'public');
            // $multimedia->ruta = $ruta;
            $multimedia->ruta = 'media/' . $file->getClientOriginalName(); // Ruta relativa
            $multimedia->data = Carbon::now();
            $multimedia->id_tipo_multimedia = 1;
            $multimedia->id_local = $local->id_local;

            $multimedia->save();

        }


        DB::commit();

    } catch (QueryException $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);

    }


    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        $usuari = Usuari::with('usuari')->find($usuari->id);
        return new UsuariResource($usuari);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {
        try {
            $usuari->nom = $request->input("nom");
            $usuari->cognom = $request->input("cognom");
            $usuari->mail = $request->input("mail");
            $usuari->contrasenya = Hash::make($request->input("contrasenya"));
            $usuari->id_rol = $request->input("id_rol");

            $usuari->save();
            return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
        } catch (QueryException $ex) {
            return response()->json(['error' => Utilitat::errorMessage($ex)], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuari $usuari)
    {
        try {
            $usuari->delete();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (QueryException $ex) {
            return response()->json(['error' => Utilitat::errorMessage($ex)], 500);
        }
    }
}
