@extends('layouts.layout')

@section('title', 'Registrar Pais')

@section('content')
    <div class="center">
        <h1>Registrar pais</h1>
        <form action="{{ route('pais.store') }}" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Digite el Nombre">
                <p class="error">{{ $errors->first('nombre') }}</p>
            </div>
            <div>
                <label for="codigo">Código ISO 3166-1 Alpha-2</label>
                <input type="text" name="codigo" id="codigo" placeholder="Digite el Código ISO 3166-1 Alpha-2">
                <p class="error">{{ $errors->first('codigo') }}</p>
            </div>
            <div>
                <label for="extension">Extensión telefónica</label>
                <input type="text" name="extension" id="extension" placeholder="Digite la Extensión telefónica">
                <p class="error">{{ $errors->first('extension') }}</p>
            </div>

            <button type="submit">Registrar</button>
        </form>
    </div>

@endsection