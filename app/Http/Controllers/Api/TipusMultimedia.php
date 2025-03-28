<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipusMultimediaResource;
use App\Models\TipoMultimedia;
use Illuminate\Http\Request;

class TipusMultimedia extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipusMultimedia = TipoMultimedia::all();

        return TipusMultimediaResource::collection($tipusMultimedia);
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
    public function show(TipoMultimedia $tipoMultimedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoMultimedia $tipoMultimedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoMultimedia $tipoMultimedia)
    {
        //
    }
}
