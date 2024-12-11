<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200',
            'correo' => 'required|string|correo|max:200|unique:usuarios',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        $Usuario = Usuario::create([
            'nombre' => $request->name,
            'correo' => $request->correo,
            'contrasena' => bcrypt($request->contrasena),
        ]);

        return response()->json($Usuario, 200);
    }

    public function update(Request $request, Usuario $Usuario)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:200',
            'correo' => 'sometimes|required|string|correo|max:200|unique:usuarios,correo,' . $Usuario->id,
            'contrasena' => 'sometimes|required|string|min:6|confirmed',
        ]);

        if ($request->has('contrasena')) {
            $Usuario->contrasena = bcrypt($request->contrasena);
        }

        $Usuario->update($request->only(['nombre', 'correo', 'contrasena']));

        return response()->json($Usuario, 200);
    }

    public function destroy(Usuario $Usuario)
    {
        $Usuario->delete();
        return response()->json(null, 200);
    }
}

