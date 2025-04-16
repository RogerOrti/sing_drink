<?php

namespace App\Http\Controllers\Api;

use App\Models\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Auth::user();
        
        $mensaje = Chat::where('id_propietari', $usuario->id_user)
                            ->orWhere('id_music', $usuario->id_user)
                            ->with(['propietario.usuario', 'musico.usuario'])
                            ->latest()
                            ->get()
                            ->groupBy(function($item) use ($usuario) {
                                return $item->id_propietari == $usuario->id_user 
                                    ? $item->id_music 
                                    : $item->id_propietari;
                            });
        
        return response()->json($mensaje);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id_propietario, $id_musico)
    {
                $mensajes = Chat::where(function($query) use ($id_propietario, $id_musico) {
                    $query->where('id_propietari', $id_propietario)
                        ->where('id_music', $id_musico);
                })
                ->orWhere(function($query) use ($id_propietario, $id_musico) {
                    $query->where('id_propietari', $id_musico)
                        ->where('id_music', $id_propietario);
                })
                ->with(['remitente', 'destinatario'])
                ->orderBy('created_at', 'asc')
                ->get();

        return response()->json($mensajes);
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'id_destinatario' => 'required|integer',
            'mensaje' => 'required|string|max:255',
            'es_propietario' => 'required|boolean'
        ]);
        
        $remitente = Auth::user();
        
        $chat = new Chat();
        
        if($request->es_propietario) {
            $chat->id_propietari = $remitente->id_user;
            $chat->id_music = $request->id_destinatario;
        } else {
            $chat->id_propietari = $request->id_destinatario;
            $chat->id_music = $remitente->id_user;
        }
        
        $chat->missatge = $request->mensaje;
        $chat->enviat = true;
        $chat->save();
        
        return response()->json([
            'mensaje' => 'Mensaje enviado correctamente',
            'chat' => $chat->load(['remitente', 'destinatario'])
        ], 201);
    }

    public function marcarComoLeidos($id_propietario, $id_musico)
    {
        $usuario = Auth::user();
        
        Chat::where('id_propietari', $id_propietario)
            ->where('id_music', $id_musico)
            ->where('enviat', true)
            ->update(['enviat' => false]);
            
        return response()->json(['mensaje' => 'Mensajes marcados como leídos']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mensaje = Chat::findOrFail($id);
        
        if(Auth::id() != $mensaje->id_propietari && Auth::id() != $mensaje->id_music) {
            return response()->json(['mensaje' => 'No tienes permiso para eliminar este mensaje'], 403);
        }
        
        $mensaje->delete();
        
        return response()->json(['mensaje' => 'Mensaje eliminado correctamente']);
    
    }
}
