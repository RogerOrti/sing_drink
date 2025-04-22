<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MultimediaMusicResource;
use App\Models\MultimediaMusic;
use Illuminate\Http\Request;

class MultimediaMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $multimediaMusic = MultimediaMusic::all();

        return MultimediaMusicResource::collection($multimediaMusic);
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
    public function show(MultimediaMusic $multimediaMusic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MultimediaMusic $multimediaMusic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MultimediaMusic $multimediaMusic)
    {
        //
    }
}
