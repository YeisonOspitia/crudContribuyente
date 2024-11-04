<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Contribuyentes') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <div class="flex flex-col">
                    <div >
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mb-4">
                            {{ __('Filtros de Búsqueda') }}
                        </h3>
                    </div>
                    <div>
                        <form method="GET" action="{{ route('home') }}">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="nombre" placeholder="Nombre" value="{{ request('nombre') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="tipo_documento" placeholder="Tipo Documento" value="{{ request('tipo_documento') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="documento" placeholder="Documento" value="{{ request('documento') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="text" name="telefono" placeholder="Teléfono" value="{{ request('telefono') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                {{ __('Filtrar') }}
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Nombres y apellidos') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Tipo Documento') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Documento') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Teléfono') }}</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($contribuyentes as $contribuyente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contribuyente->nombres }} {{ $contribuyente->apellidos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contribuyente->tipo_documento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contribuyente->documento }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $contribuyente->telefono }} </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('contribuyentes.show', $contribuyente->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            {{ __('Ver información') }}
                                        </a>
                                        @can('create contribuyente')
                                            <a href="{{ route('contribuyentes.edit', $contribuyente->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                {{ __('Editar') }}
                                            </a>
                                        @endcan
                                        @can('create contribuyente')
                                            <form action="{{ route('contribuyentes.destroy', $contribuyente->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-3">
                        @can('create contribuyente')
                            <a href="{{ route('contribuyentes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Crear Nuevo') }}
                            </a>
                        @endcan
                            <a href="{{ route('home') }}" class="inline-flex items-center mx-10 px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Limpar filtro') }}
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
