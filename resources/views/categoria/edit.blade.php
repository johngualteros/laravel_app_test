@extends('layouts.layout')

@section('title', 'Editar Categoria')

@section('content')
    <div class="center">
        <h1>Editar categoria</h1>
        <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre" value="{{$categoria->nombre}}">
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>

            <div>
                <label for="rango">Rango</label>
                <input type="text" name="rango" id="rango" placeholder="Digite el Rango" value="{{$categoria->rango}}">
                <p class="error">{{ $errors->first('rango') }}</p>
            </div>

            <button type="submit">Editar</button>
        </form>
    </div>

@endsection