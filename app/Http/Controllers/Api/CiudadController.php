<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CiudadController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:ciudades, nombre'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return Response()->json($data, 400);
        }

        $ciudad = (new Ciudad())->newInstance([
            'nombre' => $request->nombre
        ]);
        if (!$ciudad){
            $data = [
                'message' => 'Error al crear una ciudad',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        return response()->json($ciudad, 201);
    }

    public function index()
    {
        $ciudades = Ciudad::all();
        if ($ciudades->isEmpty()){
            $data = Response()->json(
                ['message' => 'No hay ciudades en la base de datos', 'status' => 200]
            );
            return Response()->json($data, 400);
        }
        return Response()->json($ciudades, 200);
    }

}
