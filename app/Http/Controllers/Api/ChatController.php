<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Obtener todas las conversaciones del usuario autenticado
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            // Obtener conversaciones donde el usuario es propietario o músico
            $conversations = Chat::with(['propietario', 'musico'])
                ->select('*')
                ->selectRaw('
                    CASE 
                        WHEN id_propietari = ? THEN id_music
                        ELSE id_propietari
                    END as id_interlocutor
                ', [$user->id_user])
                ->where('id_propietari', $user->id_user)
                ->orWhere('id_music', $user->id_user)
                ->groupBy('id_interlocutor')
                ->orderByDesc(
                    Chat::select('enviat')
                        ->whereColumn('id_propietari', 'chat.id_propietari')
                        ->whereColumn('id_music', 'chat.id_music')
                        ->orderByDesc('enviat')
                        ->limit(1)
                )
                ->get();

            return response()->json([
                'success' => true,
                'data' => $conversations
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener conversaciones',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener mensajes entre dos usuarios
     */
    public function show($id_interlocutor)
    {
        try {
            $user = Auth::user();
            
            $messages = Chat::with(['propietario', 'musico'])
                ->where(function($query) use ($user, $id_interlocutor) {
                    $query->where('id_propietari', $user->id_user)
                          ->where('id_music', $id_interlocutor);
                })
                ->orWhere(function($query) use ($user, $id_interlocutor) {
                    $query->where('id_propietari', $id_interlocutor)
                          ->where('id_music', $user->id_user);
                })
                ->orderBy('enviat', 'asc')
                ->get();

            // Marcar mensajes como leídos
            Chat::where('id_propietari', $id_interlocutor)
                ->where('id_music', $user->id_user)
                ->where('enviat', 0)
                ->update(['enviat' => 1]);

            return response()->json([
                'success' => true,
                'data' => $messages
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener mensajes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Enviar un nuevo mensaje
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_music' => 'required|integer|exists:usuaris,id_user',
            'missatge' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            
            $chat = Chat::create([
                'id_propietari' => $user->id_user,
                'id_music' => $request->id_music,
                'missatge' => $request->missatge,
                'enviat' => 0 // 0 = no leído, 1 = leído
            ]);

            return response()->json([
                'success' => true,
                'data' => $chat->load(['propietario', 'musico'])
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar mensaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un mensaje
     */
    public function destroy($id_chat)
    {
        try {
            $user = Auth::user();
            $chat = Chat::findOrFail($id_chat);

            // Verificar que el usuario es el propietario del mensaje
            if ($chat->id_propietari != $user->id_user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado para eliminar este mensaje'
                ], 403);
            }

            $chat->delete();

            return response()->json([
                'success' => true,
                'message' => 'Mensaje eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar mensaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener usuarios disponibles para chatear
     */
    public function getUsuariosDisponibles()
    {
        try {
            $user = Auth::user();
            
            // Si es propietario, obtener músicos y viceversa
            if ($user->id_rol == 1) { // 1 = propietario
                $usuarios = Usuari::where('id_rol', 2) // 2 = músico
                    ->where('id_user', '!=', $user->id_user)
                    ->get();
            } else {
                $usuarios = Usuari::where('id_rol', 1)
                    ->where('id_user', '!=', $user->id_user)
                    ->get();
            }

            return response()->json([
                'success' => true,
                'data' => $usuarios
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener usuarios disponibles',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Marcar mensajes como leídos
     */
    public function marcarComoLeidos($id_propietario, $id_music)
    {
        try {
            $user = Auth::user();
            
            // Verificar que el usuario es el destinatario
            if ($user->id_user != $id_music) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado'
                ], 403);
            }

            Chat::where('id_propietari', $id_propietario)
                ->where('id_music', $id_music)
                ->where('enviat', 0)
                ->update(['enviat' => 1]);

            return response()->json([
                'success' => true,
                'message' => 'Mensajes marcados como leídos'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al marcar mensajes como leídos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}