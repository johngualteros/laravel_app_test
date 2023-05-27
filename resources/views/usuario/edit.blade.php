@extends('layouts.layout')

@section('title', 'Editar Usuario')

@section('content')
    <div class="center space">
        <h1>Editar Usuario</h1>
        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre" value="{{ $usuario->nombre }}">
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>
            <div>
                <label for="identificacion">Identificacion</label>
                <input type="text" name="identificacion" id="identificacion" placeholder="Digite la Identificacion" value="{{ $usuario->identificacion }}">
                <p class="error">{{ $errors->first('identificacion') }}</p>
            </div>
            <div>
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" placeholder="Digite el Correo" value="{{ $usuario->correo }}">
                <p class="error">{{ $errors->first('correo') }}</p>
            </div>
            <div>
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Digite la Direccion" value="{{ $usuario->direccion }}">
                <p class="error">{{ $errors->first('direccion') }}</p>
            </div>
            <div>
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria">
                    <option value="{{ $usuario->categoria_id }}">Seleccione una Categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <p class="error">{{ $errors->first('categoria') }}</p>
            </div>
            <div>
                <label for="pais">Pais</label>
                <select name="pais" id="pais">
                    <option value="{{ $usuario->pais_id }}">Seleccione un Pais</option>
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                    @endforeach
                </select>
                <p class="error">{{ $errors->first('pais') }}</p>
            </div>
            <button type="submit">Editar</button>
        </form>
    </div>

@endsection