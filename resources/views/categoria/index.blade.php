@extends('layouts.layout')

@section('title', 'Categorias')

@section('content')
    <div class="center">
        <h1>Categorias</h1>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="create-container-button">
            <a class="btn-create" href="{{ route('categoria.create') }}">Crear Categoria</a>
        </div>

        <table id="datat">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rango</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->rango }}</td>
                        <td class="actions">
                            <button>
                                <a href="{{ route('categoria.edit', $categoria->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </button>
                            <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST">
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