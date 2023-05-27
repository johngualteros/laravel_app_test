@extends('layouts.layout')

@section('title', 'Registrar Usuario')

@section('content')
    <div class="center space">
        <h1>Registrar Usuario</h1>
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre">
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>
            <div>
                <label for="identificacion">Identificacion</label>
                <input type="text" name="identificacion" id="identificacion" placeholder="Digite la Identificacion">
                <p class="error">{{ $errors->first('identificacion') }}</p>
            </div>
            <div>
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" placeholder="Digite el Correo">
                <p class="error">{{ $errors->first('correo') }}</p>
            </div>
            <div>
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" placeholder="Digite la Direccion">
                <p class="error">{{ $errors->first('direccion') }}</p>
            </div>
            <div>
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria">
                    <option value="">Seleccione una Categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <p class="error">{{ $errors->first('categoria') }}</p>
            </div>
            <div>
                <label for="pais">Pais</label>
                <select name="pais" id="pais">
                    <option value="">Seleccione un Pais</option>
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                    @endforeach
                </select>
                <p class="error">{{ $errors->first('pais') }}</p>
            </div>
            <button type="submit">Registrar</button>
        </form>
    </div>

@endsection