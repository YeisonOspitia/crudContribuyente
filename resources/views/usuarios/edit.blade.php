<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form  id="userForm" method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $usuario->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $usuario->email }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">{{ __('Rol') }}</label>
                            <select name="role_id" id="role_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $usuario->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('usuarios') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cancelar') }}</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Guardar') }}</button>
                    </form>
                    <div id="responseMessage" class="hidden p-4 mb-4 mt-4 text-sm text-white rounded-lg" role="alert"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#userForm').on('submit', function(e) {
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
                $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text('Por favor, completa todos los campos requeridos.');
                return;
            }
            let Data = $('#userForm').serializeArray();
            $('#userForm :input').prop('disabled', true);

            $.ajax({
                url: "{{ route('usuarios.update', $usuario->id) }}",
                method: "PUT", 
                data: $.param(Data),
                success: function(response) {
                    if (response.success) {
                        let successMessage = response.message ? response.message : 'Usuario editado con éxito.';
                        $('#responseMessage').removeClass('hidden bg-red-500').addClass('bg-green-500').text(successMessage);
                        setTimeout(function() {
                            window.location.href = "{{ route('usuarios') }}";
                        }, 2000);
                    } else {
                        let errorMessage = response.errors ? response.errors.join(', ') : (response.message ? response.message : 'Hubo un error al editar el Usuario.');
                        $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text(errorMessage);
                        $('#userForm :input').prop('disabled', false);
                    }
                },
                error: function(response) {
                    $('#responseMessage').removeClass('hidden bg-green-500').addClass('bg-red-500').text('Hubo un error al editar el Usuario.');
                    $('#userForm :input').prop('disabled', false);
                }
            });
        });
    });
</script>
