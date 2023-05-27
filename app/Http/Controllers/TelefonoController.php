<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TelefonoController extends Controller
{
    private $rules = [
        'numero' => 'required|numeric|regex:/^\+[1-9]\d{1,14}$/',
    ];

    private $messages = [
        'numero.required' => 'El número es requerido',
        'numero.numeric' => 'El número debe ser numérico',
        'numero.regex' => 'El número debe tener el formato E164',
    ];

    public function getNameOfUser(string $id)
    {
        $usuario = Usuario::find($id);
        return $usuario->nombre;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getNameOfUser = Closure::fromCallable([$this, 'getNameOfUser']);
        $telefonos = Telefono::all();
        return view('telefono.index', compact('telefonos', 'getNameOfUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuario::all();
        return view('telefono.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('telefono/create')
                ->withErrors($validator)
                ->withInput();
        }

        $telefono = new Telefono();
        $telefono->numero = $request->numero;
        $telefono->usuario_id = $request->usuario;

        $telefono->save();

        return redirect('telefono')
            ->with('success', 'Teléfono creado correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuarios = Usuario::all();
        $telefono = Telefono::find($id);
        return view('telefono.edit', compact('telefono', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('telefono/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $telefono = Telefono::find($id);
        $telefono->numero = $request->numero;
        $telefono->usuario_id = $request->usuario;

        $telefono->save();

        return redirect('telefono')
            ->with('success', 'Teléfono actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $telefono = Telefono::find($id);
        $telefono->delete();

        return redirect('telefono')
            ->with('success', 'Teléfono eliminado correctamente');
    }
}
