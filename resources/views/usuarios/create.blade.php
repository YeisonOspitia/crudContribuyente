<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="userForm" method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" id="password" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">{{ __('Rol') }}</label>
                            <select name="role_id" id="role_id" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('usuarios') }}" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cancelar') }}</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Guardar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#userForm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                name: "{{ __('Por favor, ingrese su nombre') }}",
                email: "{{ __('Por favor, ingrese un correo electrónico válido') }}",
                password: {
                    required: "{{ __('Por favor, ingrese una contraseña') }}",
                    minlength: "{{ __('La contraseña debe tener al menos 6 caracteres') }}"
                },
                password_confirmation: {
                    required: "{{ __('Por favor, confirme su contraseña') }}",
                    equalTo: "{{ __('Las contraseñas no coinciden') }}"
                }
            },
            submitHandler: function(form) {
                let Data = $(form).serializeArray();
                $(form).find(':input').prop('disabled', true);

                $.ajax({
                    url: "{{ route('usuarios.create') }}",
                    method: "POST",
                    data: $.param(Data),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "{{ __('Éxito') }}",
                                text: response.message ? response.message : "{{ __('Usuario creado con éxito.') }}",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "{{ route('usuarios') }}";
                            });
                        } else {
                            let errorMessage = response.errors ? response.errors.join(', ') : (response.message ? response.message : "{{ __('Hubo un error al crear el Usuario.') }}");
                            Swal.fire({
                                icon: 'error',
                                title: "{{ __('Error') }}",
                                text: errorMessage
                            });
                            $(form).find(':input').prop('disabled', false);
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: "{{ __('Error') }}",
                            text: "{{ __('Hubo un error al crear el Usuario.') }}"
                        });
                        $(form).find(':input').prop('disabled', false);
                    }
                });
            }
        });
    });
</script>
