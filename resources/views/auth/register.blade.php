<x-guest-layout>
    <x-auth-card title="Register SIAPAE">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!-- route('register')  -->
        <form method="POST" action="{{route('coordinator.store')}}" id="form">
            @csrf

            <div class="grid gap-3">
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label for="name" :value="__('Name')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="name" class="block w-full text-gray-800 dark:text-gray-300"
                            type="text" name="name" :value="old('name')" required autofocus
                            placeholder="{{ __('Name') }}" />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label for="email" :value="__('Email')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="email" class="block w-full text-gray-800 dark:text-gray-300"
                            type="email" name="email" :value="old('email')" required placeholder="{{ __('Email') }}" />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2 password-container">
                    <x-form.label for="password" :value="__('Password')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="password" class="block w-full text-gray-800 dark:text-gray-300"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="{{ __('Password') }}" />
                        <i class="icon fas fa-eye -mt-3" onclick="togglePassword()" style="cursor: pointer;"></i>
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="space-y-1 mb-1">
                    <x-form.label for="position" :value="__('Profissão na Apae')" />

                    <x-form.select idSelect="position" valueName="position" full>
                        <option value="">Profissões:</option>
                        <option value="Cordenador(a)" {{old('position') == 'Cordenador(a)' ? 'selected' : ''}}>
                            Cordenador(a)</option>
                        <option value="Professor(a)" {{old('position') == 'Professor(a)' ? 'selected' : ''}}>Professor(a)
                        </option>
                    </x-form.select>
                </div>

                <div>
                    <x-button id="registerButton" class="justify-center w-full gap-2" onclick="handleClick(event)">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <p>{{ __('Registrar') }}</p>
                        <i id="loadingSpinner" class="fa fa-spinner fa-spin hidden ml-2"></i> 
                    </x-button>
                </div>

                <div class="flex justify-between">
                    <div></div>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <a href="{{ route('coordinator.index') }}" class="text-blue-500 hover:underline">
                            {{ __('Back') }}
                        </a>
                    </p>
                </div>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>

<style>
    .password-container {
        position: relative;
        width: 100%;
    }

    .password-container input {
        padding-right: 2.5rem;
        /* Espaço para o ícone */
    }

    .password-container i {
        position: absolute;
        top: 50%;
        right: 0.75rem;
        transform: translateY(30%);
        cursor: pointer;
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash')
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function handleClick(event) {
        const form = document.getElementById('form');
        var button = document.getElementById('registerButton');
        const textoButton = button.querySelector('p'); // Seleciona o texto dentro do botão
        const loadingSpinner = document.getElementById('loadingSpinner'); // Seleciona o ícone de carregamento
        
        if (form && form.checkValidity()) 
        {
            // Desabilita botão    
            button.disabled = true;
            textoButton.textContent = 'Registrando...';
            loadingSpinner.classList.remove('hidden'); // Mostra o spinner

            form.submit();
            ativarBotao(4000);
        }
    }
    function ativarBotao(tempo) {
        var button = document.getElementById('registerButton');
        setTimeout(function () {
            button.disabled = false;
            button.querySelector('p').textContent = 'Adicionar'; // Restaura o texto do botão
            button.querySelector('#loadingSpinner').classList.add('hidden'); // Esconde o spinner
        }, tempo);
    }
</script>