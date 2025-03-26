<?php

namespace App\Http\Controllers\Api;

use App\Models\Music;
use App\Models\propietari;
use App\Models\Usuari;
use Illuminate\Http\Request;
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
        $usuari->id_rol = $request->input("");

        $usuari->save();
        
        if($usuari){

            $music = new Music();



            $music->save();

        }

        elseif ($usuari) {
            
            $propietari = new propietari();


            $propietari->save();

            if($usuari){

            }
        }

        
        DB::commit();

    } catch (\Throwable $th) {
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
