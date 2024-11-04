<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ver Contribuyente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="tipo_documento" class="block text-sm font-medium text-gray-700">{{ __('Tipo de Documento') }}</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-select rounded-md shadow-sm mt-1 block w-full" disabled>
                                <option value="CC" {{ $contribuyente->tipo_documento == 'CC' ? 'selected' : '' }}>CC</option>
                                <option value="NIT" {{ $contribuyente->tipo_documento == 'NIT' ? 'selected' : '' }}>NIT</option>
                            </select>
                        </div>
                        <div class="mb-4" id="documento-container">
                            <label for="documento" class="block text-sm font-medium text-gray-700">{{ __('Documento') }}</label>
                            <input type="text" name="documento" id="documento" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->documento }}" disabled>
                        </div>
                        <div class="mb-4" id="nombres-container">
                            <label for="nombres" class="block text-sm font-medium text-gray-700">{{ __('Nombres') }}</label>
                            <input type="text" name="nombres" id="nombres" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->nombres }}" disabled>
                        </div>
                        <div class="mb-4" id="apellidos-container">
                            <label for="apellidos" class="block text-sm font-medium text-gray-700">{{ __('Apellidos') }}</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->apellidos }}" disabled>
                        </div>
                        <div class="mb-4 hidden" id="razon-social-container">
                            <label for="razon_social" class="block text-sm font-medium text-gray-700">{{ __('NIT') }}</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->nombres.' '.optional($contribuyente)->apellidos }}">
                        </div>
                        <div class="mb-4">
                            <label for="direccion" class="block text-sm font-medium text-gray-700">{{ __('Dirección') }}</label>
                            <input type="text" name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->direccion }}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">{{ __('Teléfono') }}</label>
                            <input type="text" name="telefono" id="telefono" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->telefono }}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="celular" class="block text-sm font-medium text-gray-700">{{ __('Celular') }}</label>
                            <input type="text" name="celular" id="celular" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->celular }}" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $contribuyente->email }}" disabled>
                        </div>
                    </div>
                    <div class=" mb-6">
                        <h3 class="mt-6 mb-4 text-xl">{{ __('Conteo de Letras') }}</h3>
                        <ul>
                            @foreach ($letterCounts as $letter => $count)
                                <li>{{ $letter }}: {{ $count }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Volver') }}
                    </a>
                    @can('create contribuyente')
                        <a href="{{ route('contribuyentes.edit', $contribuyente->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Editar') }}
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#tipo_documento').on('change', function() {
            if ($(this).val() === 'NIT') {
                $('#nombres-container, #apellidos-container').hide();
                $('#nombres, #apellidos').prop('required', false);
                $('#razon-social-container').show();
                $('#razon_social').prop('required', true);
            } else {
                $('#nombres-container, #apellidos-container').show();
                $('#nombres, #apellidos').prop('required', true);
                $('#razon-social-container').hide();
                $('#razon_social').prop('required', false);
            }
        });

        $('#tipo_documento').trigger('change');
       
    });
</script>