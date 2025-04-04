<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Local;

class ConcertController extends Controller
{
    public function index()
{
    $concerts = Concert::all();

    $locals = Local::all();

    return view('index', compact('concerts', 'locals'));
}

    public function getConcerts()
{
    $concerts = Concert::with('local')->get();

    $events = $concerts->map(function($concert) {
        $local = $concert->local;

        return [
            'title' => $concert->estil_musica,
            'start' => $concert->data,
            'description' => 'Evento musical',
            'color' => '#'.substr(md5($concert->estil_musica), 0, 6),
            'extendedProps' => [
                'date' => $concert->data,
                'style' => $concert->estil_musica,
                'location' => $local ? $local->nom_local . ' - ' . $local->direccio : 'Local no disponible',
            ],
        ];
    });


    return response()->json($events);
}
}
