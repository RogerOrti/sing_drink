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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {

        return response()->json(['id_local' => $local]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        //
    }
}
