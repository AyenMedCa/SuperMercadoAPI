<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supermercado;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SuperMercadoController extends Controller
{
    public function index()
    {
        $supermercados = Supermercado::all();
        if ($supermercados->isEmpty()){
            $data = Response()->json(
                ['message' => 'No hay supermercados en la base de datos', 'status' => 200]
            );
            return Response()->json($data, 400);
        }
        foreach ($supermercados as $supermercado) {
            $supermercado->logo_url = asset('storage/public/images/' . $supermercado->logo);
        }
        return Response()->json($supermercados, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'NIT' => 'required|unique:supermercado,NIT',
            'direccion' => 'required',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'latitud' => 'required',
            'longitud' => 'required',
            'ciudad_id' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return Response()->json($data, 400);
        }
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/images');
        }

        $supermercado = Supermercado::create([
            'nombre' => $request->nombre,
            'NIT' => $request->NIT,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'ciudad_id' => $request->ciudad_id,
            'logo' => $logoPath ? Storage::url($logoPath) : null,
        ]);

        if (!$supermercado){
            $data = [
                'message' => 'Error al crear un supermercado',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'supermercado' => $supermercado,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function show($id)
    {
        $supermercado = Supermercado::find($id);

        if (!$supermercado){
            $data = [
                'message' => 'Supermercado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($supermercado, 200);
    }

    public function destroy($id)
    {
        $supermercado = Supermercado::find($id);

        if (!$supermercado){
            $data = [
                'message' => 'Supermercado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $supermercado->delete();

        $data = [
            'message' => 'Supermercado eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update($id, Request $request)
    {
        $supermercado = Supermercado::find($id);

        if (!$supermercado){
            $data = [
                'message' => 'Supermercado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'NIT' => 'required',
            'direccion' => 'required',
            'logo' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'ciudad_id' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'datos' => $request,
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return Response()->json($data, 400);
        }

        $supermercado->nombre = $request->nombre;
        $supermercado->NIT = $request->NIT;
        $supermercado->direccion = $request->direccion;
        $supermercado->logo = $request->logo;
        $supermercado->latitud = $request->latitud;
        $supermercado->longitud = $request->longitud;
        $supermercado->ciudad_id = $request->ciudad_id;

        $supermercado->save();

        $data = [
            'message' => 'Supermercado actualizado',
            'supermercado' => $supermercado,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
