<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstilMusicaResource;
use App\Models\EstilMusica;
use Illuminate\Http\Request;

class EstilMusicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estilMusica = EstilMusica::all();

        return EstilMusicaResource::collection($estilMusica);
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
    public function show(EstilMusica $estilMusica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstilMusica $estilMusica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstilMusica $estilMusica)
    {
        //
    }
}
