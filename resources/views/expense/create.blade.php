<x-app-layout>

    <x-table-create title="Gasto" onlyHead actionRoute="expense">

        <!-- Select para escolher o tipo de gasto -->
        <div class="mb-3">
            <label for="tipo_gasto" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Tipo de Gasto: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.select idSelect="tipo_gasto" valueName="type">
                <option value="Nota Fiscal" {{ old('tipo_gasto', 'Nota Fiscal') == 'Nota Fiscal' ? 'selected' : '' }}>
                    Nota Fiscal
                </option>

                <option value="Cupom Fiscal" {{ old('tipo_gasto') == 'Cupom Fiscal' ? 'selected' : '' }}>
                    Cupom Fiscal
                </option>

                <option value="Recibo" {{ old('tipo_gasto') == 'Recibo' ? 'selected' : '' }}>
                    Recibo
                </option>
            </x-form.select>

            @error("type")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dateInput" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Data de emissão: <span class="text-red-700 dark:text-red-500">*</span>
            </label>
            <x-form.input id="dateInput" type="text" name="date_of_emission" value="{{ old('date_of_emission') }}" autocomplete="off"
                class="w-full dark:text-gray-400 date dateInput" required placeholder="Ex: 01/01/2001" x-init="initFlatpickr" />

            <span id="errorMessage" style="color: red; display: none;">Data inválida. Insira uma data entre
                1960 e 2200.</span>
            @error("date_of_emission")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div id="campo_nota_fiscal">
            <div class="mb-3">
                <label for="fiscal" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                    Número da Nota:
                </label>
                <x-form.input id="fiscal" type="text" name="fiscal_number" value="{{ old('fiscal_number') }}" autocomplete="off"
                    class="w-full dark:text-gray-400" placeholder="Ex: 392.047.028" />

                @error("fiscal_number")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div id="campo_cupom_fiscal">
            <div class="mb-3">
                <label for="cupom" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                    Número do Cupom:
                </label>
                <x-form.input id="cupom" type="text" name="cupom_number" value="{{ old('cupom_number') }}" autocomplete="off"
                    class="w-full dark:text-gray-400" placeholder="Ex: 999999" />

                @error("cupom_number")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        
        <div id="campo_recibo">
            <div class="mb-3">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                    Descrição:
                </label>
                <x-form.input type="text" id="description" name="description" value="{{ old('description') }}"
                class="w-full dark:text-gray-400" placeholder="Ex: Descrição do Recibo" />
                
                @error("description")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <label for="enterprise" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Empresa: (*opcional)
            </label>
            <x-form.input type="text" id="enterprise" name="enterprise" value="{{ old('enterprise') }}"
                class="w-full dark:text-gray-400" placeholder="Ex: Nome da Empresa" />

            @error("enterprise")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Valor: <span class="text-red-700 dark:text-red-500">*</span>
            </label>
            <x-form.input type="text" id="price" name="price" value="{{ old('price') }}"
                class="w-full dark:text-gray-400" required oninput="mascaraMoeda(event)" placeholder="Ex: 49,99" />

            @error("price")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>
    </x-table-create>

</x-app-layout>