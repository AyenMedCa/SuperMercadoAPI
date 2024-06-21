<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supermercado;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuperMercadoController extends Controller
{
    public function index()
    {
        $supermercado = Supermercado::all();
        if ($supermercado->isEmpty()){
            $data = Response()->json(
                ['message' => 'No hay supermercados en la base de datos', 'status' => 200]
            );
            return Response()->json($data, 400);
        }
        return Response()->json($supermercado, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'NIT' => 'required|unique:supermercado,NIT',
            'direccion' => 'required',
            'logo' => 'required',
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
        $supermercado = Supermercado::create([
           'nombre' => $request->nombre,
           'NIT' => $request->NIT,
           'direccion' => $request->direccion,
           'logo' => $request->logo,
           'latitud' => $request->latitud,
           'longitud' => $request->longitud,
           'ciudad_id' => $request->ciudad_id
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
        $data = [
            'supermercado' => $supermercado,
            'status' => 200
        ];
        return response()->json($data, 200);
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
