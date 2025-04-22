<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MultimediaLocalResource;
use App\Models\MultimediaLocal;
use Illuminate\Http\Request;

class MultimediaLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $multimediaLocal = MultimediaLocal::all();

        return MultimediaLocalResource::collection($multimediaLocal);
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
    public function show(MultimediaLocal $multimediaLocal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MultimediaLocal $multimediaLocal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MultimediaLocal $multimediaLocal)
    {
        //
    }
}
