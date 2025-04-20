<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocalResource;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locals = local::with('multimedia')->get();

        return LocalResource::collection($locals);

    }

public function indexPaginado()
{
    $locals = local::with('multimedia')->paginate(1);
    return LocalResource::collection($locals);
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_local' => 'required|string|max:255',
            'direccio' => 'required|string|max:200',
            'id_tipo_local' => 'required|exists:tipo_local,id_tipo_local',
        ]);
    
        $local = new Local();
        $local->nom_local = $request->input('nom_local');
        $local->direccio = $request->input('direccio');
        $local->id_tipo_local = $request->input('id_tipo_local');
        $local->save();
    
   
    
        return new LocalResource($local);
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {

        return new LocalResource($local->load('multimedia'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {
        $request->validate([
            'nom_local' => 'sometimes|required|string|max:255',
            'direccio' => 'sometimes|required|string|max:200',
            'id_tipo_local' => 'sometimes|required|exists:tipo_local,id_tipo_local',
        ]);
    
        if ($request->has('nom_local')) {
            $local->nom_local = $request->input('nom_local');
        }
    
        if ($request->has('direccio')) {
            $local->direccio = $request->input('direccio');
        }
    
        if ($request->has('id_tipo_local')) {
            $local->id_tipo_local = $request->input('id_tipo_local');
        }
    
        $local->save();
    
        return new LocalResource($local);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return response()->json([
            'message' => 'Local eliminado correctamente.'
        ]);
    }
}
