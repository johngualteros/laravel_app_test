@extends('layouts.layout')

@section('title', 'Usuarios')

@section('content')
    <div class="center widthable">
        <h1>Usuarios</h1>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="create-container-button">
            <a class="btn-create" href="{{ route('usuario.create') }}">Crear Usuario</a>
        </div>

        <table id="datat" class="table_users">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Identificacion</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Categoria</th>
                    <th>Pais</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->identificacion }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ $usuario->direccion }}</td>
                        @php
                            $nombreCategoria = $getNameOfCategory($usuario->categoria_id);
                            $nombrePais = $getNameOfCountry($usuario->pais_id);
                        @endphp
                        <td>{{ $nombreCategoria }}</td>
                        <td>{{ $nombrePais }}</td>
                        <td class="actions">
                            <button>
                                <a href="{{ route('usuario.edit', $usuario->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </button>
                            <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
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