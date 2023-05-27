<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    
    private $rules = [
        'nombre' => 'required|unique:categorias',
        'rango' => 'required|numeric|gt:0',
    ];

    private $messages = [
        'nombre.required' => 'El nombre es requerido',
        'nombre.unique' => 'El nombre ya existe',
        'rango.required' => 'El rango es requerido',
        'rango.numeric' => 'El rango debe ser numérico',
        'rango.gt' => 'El rango debe ser mayor a 0',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('categoria/create')
                ->withErrors($validator)
                ->withInput();
        }

        $categoria = new Categoria();
        $categoria->nombre = strtolower($request->nombre);
        $categoria->rango = $request->rango;

        $categoria->save();

        return redirect('categoria')->with('success', 'Categoría creada correctamente');
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
        $categoria = Categoria::find($id);
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $categoria = Categoria::find($id);

        if ($categoria->nombre == strtolower($request->nombre)) {
            $this->rules['nombre'] = 'required';
        }
        
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('categoria/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $categoria->nombre = strtolower($request->nombre);
        $categoria->rango = $request->rango;

        $categoria->save();

        return redirect('categoria')->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect('categoria')->with('success', 'Categoría eliminada correctamente');
    }
}
