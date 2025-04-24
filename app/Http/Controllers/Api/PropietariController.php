<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PropietariResource;
use App\Models\MultimediaLocal;
use App\Models\Propietari;
use App\Models\Local;
use App\Models\Usuari;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PropietariController extends Controller
{
    /**
     * Display a listing of propietaris with their related data
     */
    public function index()
    {
        // try {
        //     $propietaris = Propietari::with([
        //         'usuari', 
        //         'local.tipoLocal',
        //         'local.multimedia'
        //     ])->get();

        //     return response()->json([
        //         'success' => true,
        //         'data' => $propietaris
        //     ], 200);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Error al recuperar los propietarios',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

        $propietaris = propietari::all();

        return PropietariResource::collection($propietaris);

    }

    /**
     * Store a newly created propietari in storage
     */
    public function store(Request $request)
    {
       

        DB::beginTransaction();

        try {
            // Crear el propietario
            $propietari = Propietari::create([
                'id_user' => $request->id_user,
                'id_local' => $request->id_local
            ]);

            // Agregar multimedia si existe
            if ($request->has('multimedia')) {
                foreach ($request->multimedia as $media) {
                    MultimediaLocal::create([
                        'ruta' => $media['ruta'],
                        'data' => $media['data'],
                        'id_tipo_multimedia' => $media['id_tipo_multimedia'],
                        'id_local' => $propietari->id_local
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $propietari->load(['usuari', 'local.tipoLocal', 'local.multimedia'])
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el propietario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified propietari
     */
    public function show($id_user, $id_local)
    {
        try {
            $propietari = Propietari::with(['usuari', 'local.tipoLocal', 'local.multimedia'])
                ->where('id_user', $id_user)
                ->where('id_local', $id_local)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $propietari
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Propietario no encontrado',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified propietari in storage
     */
    public function update(Request $request, $id_user, $id_local)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'sometimes|integer|exists:usuaris,id_user',
            'id_local' => 'sometimes|integer|exists:locals,id_local',
            'multimedia' => 'sometimes|array',
            'multimedia.*.id_multimedia' => 'sometimes|integer',
            'multimedia.*.ruta' => 'sometimes|string',
            'multimedia.*.data' => 'sometimes|date',
            'multimedia.*.id_tipo_multimedia' => 'sometimes|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $propietari = Propietari::where('id_user', $id_user)
                ->where('id_local', $id_local)
                ->firstOrFail();

            // Actualizar campos básicos
            $propietari->update($request->only(['id_user', 'id_local']));

            // Sincronizar multimedia
            if ($request->has('multimedia')) {
                $currentMediaIds = $propietari->local->multimedia->pluck('id_multimedia')->toArray();
                $newMediaIds = [];

                foreach ($request->multimedia as $media) {
                    if (isset($media['id_multimedia'])) {
                        // Actualizar multimedia existente
                        $multimedia = MultimediaLocal::find($media['id_multimedia']);
                        if ($multimedia) {
                            $multimedia->update([
                                'ruta' => $media['ruta'],
                                'data' => $media['data'],
                                'id_tipo_multimedia' => $media['id_tipo_multimedia']
                            ]);
                            $newMediaIds[] = $multimedia->id_multimedia;
                        }
                    } else {
                        // Crear nueva multimedia
                        $newMultimedia = MultimediaLocal::create([
                            'ruta' => $media['ruta'],
                            'data' => $media['data'],
                            'id_tipo_multimedia' => $media['id_tipo_multimedia'],
                            'id_local' => $propietari->id_local
                        ]);
                        $newMediaIds[] = $newMultimedia->id_multimedia;
                    }
                }

                // Eliminar multimedia que ya no está en la lista
                $toDelete = array_diff($currentMediaIds, $newMediaIds);
                MultimediaLocal::whereIn('id_multimedia', $toDelete)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $propietari->fresh(['usuari', 'local.tipoLocal', 'local.multimedia'])
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el propietario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified propietari from storage
     */
    public function destroy($id_user, $id_local)
    {
        DB::beginTransaction();

        try {
            $propietari = Propietari::where('id_user', $id_user)
                ->where('id_local', $id_local)
                ->firstOrFail();

            // Eliminar multimedia asociada al local
            MultimediaLocal::where('id_local', $id_local)->delete();

            // Luego eliminar el propietario
            $propietari->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Propietario eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el propietario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get propietaris by local
     */
    public function byLocal($id_local)
    {
        try {
            $propietaris = Propietari::with(['usuari', 'local.multimedia'])
                ->where('id_local', $id_local)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $propietaris
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al recuperar propietarios del local',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get propietaris by user
     */
    public function byUser($id_user)
    {
        try {
            $propietaris = Propietari::with(['local.tipoLocal', 'local.multimedia'])
                ->where('id_user', $id_user)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $propietaris
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al recuperar locales del propietario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}