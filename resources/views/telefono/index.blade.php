@extends('layouts.layout')

@section('title', 'Telefonos')

@section('content')
    <div class="center">
        <h1>Telefonos</h1>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif


        <div class="create-container-button">
            <a class="btn-create" href="{{ route('telefono.create') }}">Crear Telefono</a>
        </div>

        <table id="datat">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($telefonos as $telefono)
                    <tr>
                        <td>{{ $telefono->numero }}</td>

                        @php
                            $nombreUsuario = $getNameOfUser($telefono->usuario_id);    
                        @endphp

                        <td>{{ $nombreUsuario }}</td>
                        <td class="actions">
                            <button>
                                <a href="{{ route('telefono.edit', $telefono->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </button>
                            <form action="{{ route('telefono.destroy', $telefono->id) }}" method="POST">
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