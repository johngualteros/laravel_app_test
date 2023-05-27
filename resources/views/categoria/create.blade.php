@extends('layouts.layout')

@section('title', 'Registrar Categoria')

@section('content')
    <div class="center">
        <h1>Registrar categoria</h1>
        <form action="{{ route('categoria.store') }}" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre">
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>

            <div>
                <label for="rango">Rango</label>
                <input type="text" name="rango" id="rango" placeholder="Digite el Rango">
                <p class="error">{{ $errors->first('rango') }}</p>
            </div>

            <button type="submit">Registrar</button>
        </form>
    </div>

@endsection