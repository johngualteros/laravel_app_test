<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pais;
use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    private $rules = [
        'nombre' => 'required|string|max:100',
        'identificacion' => 'required|string|max:18|unique:usuarios',
        'correo' => 'required|string|max:150|email|unique:usuarios',
        'direccion' => 'required|max:180',
    ];

    private $messages = [
        'nombre.required' => 'El nombre es requerido',
        'nombre.string' => 'El nombre debe ser una cadena de caracteres',
        'nombre.max' => 'El nombre no debe superar los 100 caracteres',
        'identificacion.required' => 'La identificación es requerida',
        'identificacion.string' => 'La identificación debe ser una cadena de caracteres',
        'identificacion.max' => 'La identificación no debe superar los 18 caracteres',
        'identificacion.unique' => 'La identificación ya se encuentra registrada',
        'correo.required' => 'El correo es requerido',
        'correo.string' => 'El correo debe ser una cadena de caracteres',
        'correo.max' => 'El correo no debe superar los 150 caracteres',
        'correo.email' => 'El correo debe ser una dirección de correo válida',
        'correo.unique' => 'El correo ya se encuentra registrado',
        'direccion.required' => 'La dirección es requerida',
        'direccion.max' => 'La dirección no debe superar los 180 caracteres',
    ];

    public function getNameOfCategory($id) {
        $categoria = Categoria::find($id);
        return $categoria->nombre;
    }

    public function getNameOfCountry($id) {
        $pais = Pais::find($id);
        return $pais->nombre;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getNameOfCountry = Closure::fromCallable([$this, 'getNameOfCountry']);
        $getNameOfCategory = Closure::fromCallable([$this, 'getNameOfCategory']);
        $usuarios = Usuario::all();
        return view('usuario.index', [
            'usuarios' => $usuarios,
            'getNameOfCountry' => $getNameOfCountry,
            'getNameOfCategory' => $getNameOfCategory,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $paises = Pais::all();
        return view('usuario.create', compact('categorias', 'paises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect('usuario/create')
                ->withErrors($validator)
                ->withInput();
        }

        $usuario = new Usuario();
        $usuario->nombre = strtolower($request->nombre);
        $usuario->identificacion = $request->identificacion;
        $usuario->correo = strtolower($request->correo);
        $usuario->direccion = strtolower($request->direccion);
        $usuario->categoria_id = $request->categoria;
        $usuario->pais_id = $request->pais;        

        $usuario->save();

        // send email to new user registered
        $sendEmailController = new SendEmailController();
        $sendEmailController->index($usuario->correo);

        // send email for all user with the big range category
        $this->sendEmailToUsers();
        return redirect('usuario')->with('success', 'Usuario creada correctamente');
    }

    //  method for get report of users per country
    public function getReportOfUsersPerCountry() {
        $users = Usuario::all();
        $usersPerCountry = [];
        foreach ($users as $user) {
            $usersPerCountry[$this->getNameOfCountry($user->pais_id)] = Usuario::where('pais_id', $user->pais_id)->count();
        }
        return $usersPerCountry;
    }

    // method for send email in laravel
    public function sendEmailToUsers() {
        $maxCategorie = Categoria::max('rango');
        $idCategory = Categoria::where('rango', $maxCategorie)->first()->id;
        $users = Usuario::where('categoria_id', $idCategory)->get();
        foreach ($users as $user) {
            $sendEmailController = new SendEmailController();
            $sendEmailController->sendMultipleEmailsWithReport($user->correo);
        }
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
        $usuario = Usuario::find($id);
        $categorias = Categoria::all();
        $paises = Pais::all();
        return view('usuario.edit', compact('usuario', 'categorias', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $usuario = Usuario::find($id);

        if ($request->identificacion == $usuario->identificacion) {
            $this->rules['identificacion'] = 'required|string|max:18';
        }

        if ($request->correo == $usuario->correo) {
            $this->rules['correo'] = 'required|string|max:150|email';
        }

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect("usuario/$id/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $usuario->nombre = strtolower($request->nombre);
        $usuario->identificacion = $request->identificacion;
        $usuario->correo = strtolower($request->correo);
        $usuario->direccion = strtolower($request->direccion);
        $usuario->categoria_id = $request->categoria;
        $usuario->pais_id = $request->pais;

        $usuario->save();

        return redirect('usuario')->with('success', 'Usuario actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();
        return redirect('usuario')->with('success', 'Usuario eliminada correctamente');
    }
}
