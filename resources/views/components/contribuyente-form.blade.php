<form action="{{ $action }}" method="{{ $method === 'POST' ? 'POST' : 'POST' }}" id="contribuyenteForm">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label for="tipo_documento" class="block text-sm font-medium text-gray-700">{{ __('Tipo de Documento') }}</label>
            <select name="tipo_documento" id="tipo_documento" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                <option value="CC" {{ optional($contribuyente)->tipo_documento == 'CC' ? 'selected' : '' }}>CC</option>
                <option value="NIT" {{ optional($contribuyente)->tipo_documento == 'NIT' ? 'selected' : '' }}>NIT</option>
            </select>
        </div>
        <div class="mb-4" id="documento-container">
            <label for="documento" class="block text-sm font-medium text-gray-700">{{ __('Documento') }}</label>
            <input type="text" name="documento" id="documento" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->documento }}" required>
        </div>
        <div class="mb-4" id="nombres-container">
            <label for="nombres" class="block text-sm font-medium text-gray-700">{{ __('Nombres') }}</label>
            <input type="text" name="nombres" id="nombres" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->nombres }}" required>
        </div>
        <div class="mb-4" id="apellidos-container">
            <label for="apellidos" class="block text-sm font-medium text-gray-700">{{ __('Apellidos') }}</label>
            <input type="text" name="apellidos" id="apellidos" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->apellidos }}" required>
        </div>
        <div class="mb-4 hidden" id="razon-social-container">
            <label for="razon_social" class="block text-sm font-medium text-gray-700">{{ __('NIT') }}</label>
            <input type="text" name="razon_social" id="razon_social" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->nombres.' '.optional($contribuyente)->apellidos }}">
        </div>
        <div class="mb-4">
            <label for="direccion" class="block text-sm font-medium text-gray-700">{{ __('Dirección') }}</label>
            <input type="text" name="direccion" id="direccion" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->direccion }}" required>
        </div>
        <div class="mb-4">
            <label for="telefono" class="block text-sm font-medium text-gray-700">{{ __('Teléfono') }}</label>
            <input type="text" name="telefono" id="telefono" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->telefono }}">
        </div>
        <div class="mb-4">
            <label for="celular" class="block text-sm font-medium text-gray-700">{{ __('Celular') }}</label>
            <input type="text" name="celular" id="celular" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->celular }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ optional($contribuyente)->email }}" required>
        </div>
    </div>
    <input type="hidden" name="usuario" value="{{ $usuario }}">
    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cancelar') }}</a>
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Guardar') }}</button>
</form>

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

        $('#contribuyenteForm').on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            $('input[required]').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('border-red-500');
                } else {
                    $(this).removeClass('border-red-500');
                }
            });
            if (!isValid) {
                $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text('{{ __('Por favor, completa todos los campos requeridos.') }}');
                return;
            }
            let Data = $('#contribuyenteForm').serializeArray();
            $('#contribuyenteForm :input').prop('disabled', true);

            $.ajax({
                url: "{{ $action }}",
                method: "{{ $method }}",
                data: $.param(Data),
                success: function(response) {
                    if (response.success) {
                        let successMessage = response.message ? response.message : '{{ __('Contribuyente creado con éxito.') }}';
                        $('#responseMessage').removeClass('hidden bg-red-500').addClass('bg-green-500').text(successMessage);
                        setTimeout(function() {
                            window.location.href = "{{ route('home') }}";
                        }, 2000);
                    } else {
                        let errorMessage = response.errors ? response.errors.join(', ') : (response.message ? response.message : '{{ __('Hubo un error al editar el contibuyente.') }}');
                        $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text(errorMessage);
                        $('#contribuyenteForm :input').prop('disabled', false);
                    }
                },
                error: function(response) {
                    $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text('{{ __('Hubo un error al crear el contibuyente.') }}');
                    $('#contribuyenteForm :input').prop('disabled', false);
                }
            });
        });
    });
</script>
