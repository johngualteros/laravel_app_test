@extends('layouts.layout')

@section('title', 'Paises')

@section('content')
    <div class="center">
        <h1>Paises</h1>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="create-container-button">
            <a class="btn-create" href="{{ route('pais.create') }}">Crear Pais</a>
        </div>

        <table id="datat">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código ISO 3166-1 Alpha-2</th>
                    <th>Extensión telefónica</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paises as $pais)
                    <tr>
                        <td>{{ $pais->nombre }}</td>
                        <td>{{ $pais->codigo }}</td>
                        <td>{{ $pais->extension }}</td>
                        <td class="actions">
                            <button>
                                <a href="{{ route('pais.edit', $pais->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </button>
                            <form action="{{ route('pais.destroy', $pais->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="bi bi-trash3"></i></button>
                            </form>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>

@endsection