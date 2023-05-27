@extends('layouts.layout')

@section('title', 'Registrar Telefono')

@section('content')
    <div class="center">
        <h1>Registrar telefono</h1>
        <form action="{{ route('telefono.store') }}" method="POST">
            @csrf
            <div>
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" placeholder="Digite el Número de Telefono">
                <p class="error">{{ $errors->first('numero') }}</p>
            </div>

            <div>
                <label for="usuario">Usuario</label>
                <select name="usuario" id="usuario">
                    <option value="">Seleccione el usuario al que pertenece</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Registrar</button>
        </form>
    </div>

@endsection