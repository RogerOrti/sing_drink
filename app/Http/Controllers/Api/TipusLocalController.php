<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipoLocalResource;
use App\Models\TipoLocal;
use Illuminate\Http\Request;

class TipusLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipusLocal = TipoLocal::all();

        return TipoLocalResource::collection($tipusLocal);

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
    public function show(TipoLocal $tipoLocal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoLocal $tipoLocal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoLocal $tipoLocal)
    {
        //
    }
}
