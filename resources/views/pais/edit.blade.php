@extends('layouts.layout')

@section('title', 'Editar Pais')

@section('content')
    <div class="center">
        <h1>Editar pais</h1>
        <form action="{{ route('pais.update', $pais->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre" value="{{ $pais->nombre }}"
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>
            <div>
                <label for="codigo">Código ISO 3166-1 Alpha-2</label>
                <input type="text" name="codigo" id="codigo" placeholder="Digite el Código ISO 3166-1 Alpha-2" value="{{ $pais->codigo }}">
                <p class="error">{{ $errors->first('codigo') }}</p>
            </div>
            <div>
                <label for="extension">Extensión telefónica</label>
                <input type="text" name="extension" id="extension" placeholder="Digite la Extensión telefónica" value="{{ $pais->extension }}">
                <p class="error">{{ $errors->first('extension') }}</p>
            </div>

            <button type="submit">Editar</button>
        </form>
    </div>

@endsection