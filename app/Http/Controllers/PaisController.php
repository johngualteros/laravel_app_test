<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaisController extends Controller
{
    private $rules = [
        'nombre' => 'required|unique:pais',
        'codigo' => 'required|max:2|alpha|unique:pais',
        'extension' => 'required|max:10',
    ];

    private $messages = [
        'nombre.required' => 'El nombre es requerido',
        'nombre.unique' => 'El nombre ya existe',
        'codigo.required' => 'El código es requerido',
        'codigo.max' => 'El código debe tener máximo 2 caracteres',
        'codigo.alpha' => 'El código debe ser alfabético',
        'codigo.unique' => 'El código ya existe',
        'extension.required' => 'La extensión es requerida',
        'extension.max' => 'La extensión debe tener máximo 10 caracteres',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();
        return view('pais.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('pais/create')
                ->withErrors($validator)
                ->withInput();
        }

        $pais = new Pais();
        $pais->nombre = strtolower($request->nombre);
        $pais->codigo = strtolower($request->codigo);
        $pais->extension = strtolower($request->extension);

        $pais->save();

        return redirect('pais');
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
        $pais = Pais::find($id);
        return view('pais.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pais = Pais::find($id);

        if($pais->nombre == strtolower($request->nombre)) {
            $this->rules['nombre'] = 'required';
        }

        if($pais->codigo == strtoupper($request->codigo)) {
            $this->rules['codigo'] = 'required|max:2';
        }

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('pais/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $pais->nombre = strtolower($request->nombre);
        $pais->codigo = strtoupper($request->codigo);
        $pais->extension = strtolower($request->extension);

        $pais->save();

        return redirect('pais')->with('success', 'Pais actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pais = Pais::find($id);
        $pais->delete();

        return redirect('pais')->with('success', 'Pais eliminado correctamente');
    }
}
