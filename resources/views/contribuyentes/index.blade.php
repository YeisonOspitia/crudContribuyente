<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Contribuyentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Documento</th>
                                <th>Nombres y apellidos</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contribuyentes as $contribuyente)
                                <tr>
                                    <td>{{ $contribuyente->tipo_documento }}</td>
                                    <td>{{ $contribuyente->documento }}</td>
                                    <td>{{ $contribuyente->nombres }} {{ $contribuyente->apellidos }}</td>
                                    <td>{{ $contribuyente->telefono }} </td>
                                    <td>
                                        <a href="{{ route('contribuyentes.show', $contribuyente->id) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('contribuyentes.edit', $contribuyente->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('contribuyentes.destroy', $contribuyente->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('contribuyentes.create') }}" class="btn btn-primary mt-3">Crear Nuevo</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
