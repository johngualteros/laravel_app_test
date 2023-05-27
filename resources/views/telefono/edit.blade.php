@extends('layouts.layout')

@section('title', 'Editar Telefono')

@section('content')
    <div class="center">
        <h1>Editar telefono</h1>
        <form action="{{ route('telefono.update', $telefono->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" placeholder="Digite el Número de Telefono"  value="{{ $telefono->numero }}"
                <p class="error">{{ $errors->first('numero') }}</p>
            </div>

            <div>
                <label for="usuario">Usuario</label>
                <select name="usuario" id="usuario">
                    <option value="{{ $telefono->usuario_id }}">Seleccione el usuario al que pertenece</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Editar</button>
        </form>
    </div>

@endsection