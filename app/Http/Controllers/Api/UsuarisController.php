<?php

namespace App\Http\Controllers\Api;

use App\Models\Local;
use App\Models\Multimedia;
use App\Models\Music;
use App\Models\propietari;
use App\Models\Usuari;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsuariResource;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = Usuari::all();

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

            $multimedia = new Multimedia();

            $file = $request->input("");
            $nom = "";
            
            // $multimedia->ruta = $nom;
            // $multimedia->data = Carbon::now();

            $multimedia->save();

            $music = new Music();

            $music->id_user = $usuari->id_user;
            $music->id_estil = $request->input("estilMusica");
            $music->id_multimedia = $multimedia->id_multimedia;

            $music->save();

        }

        elseif ($usuari->id_rol == 3) {
            
            $multimedia = new Multimedia();
            $multimedia->ruta = $request->input();
            $multimedia->data = Carbon::now();

            $multimedia->save();

            $local = new Local();
            $local->nom_local = $request->input("nom_local");
            $local->direccio = $request->input("direccio");
            $local->id_tipo_local = $request->input("tipusLocal");
            $local->multimedia_id_multimedia = $multimedia->id_multimedia;
            $local->save();

            $propietari = new propietari();
            $propietari->id_user = $usuari->id_user;
            $propietari->id_local = $local->id_local;

            $propietari->save();

        }

        
        DB::commit();

    } catch (Exception $e) {
        DB::rollBack();

    }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuari $usuari)
    {
        //
    }
}
