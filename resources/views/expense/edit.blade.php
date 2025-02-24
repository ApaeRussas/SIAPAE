<x-app-layout>

    <x-table-edit title="Gasto" :elementEdit="$expense" onlyHead actionRoute="expense">

        <!-- Select para escolher o tipo de gasto -->
        <div class="mb-3">
            <label for="tipo_gasto" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Tipo de Gasto: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.select idSelect="tipo_gasto" valueName="type">
                <option value="Nota Fiscal" {{ old('tipo_gasto', $expense->type) == 'Nota Fiscal' ? 'selected' : '' }}>
                    Nota Fiscal
                </option>

                <option value="Cupom Fiscal" {{ old('tipo_gasto', $expense->type) == 'Cupom Fiscal' ? 'selected' : '' }}>
                    Cupom Fiscal
                </option>

                <option value="Recibo" {{ old('tipo_gasto', $expense->type) == 'Recibo' ? 'selected' : '' }}>
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
            <x-form.input id="dateInput" type="text" name="date_of_emission" x-init="initFlatpickr" autocomplete="off"
                value="{{ old('date_of_emission', $expense->date_of_emission) }}" class="w-full dark:text-gray-400 date dateInput"
                required placeholder="Ex: 01/01/2001" />

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
                <x-form.input id="fiscal" type="text" name="fiscal_number" autocomplete="off"
                    value="{{ old('fiscal_number', $expense->fiscal_number) }}" class="w-full dark:text-gray-400"
                    placeholder="Ex: 392.047.028" />

                @error("fiscal_number")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div id="campo_cupom_fiscal">
            <div class="mb-3">
                <label for="cupom" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                    Número do Cupom Fiscal:
                </label>
                <x-form.input id="cupom" type="text" name="cupom_number" autocomplete="off"
                    value="{{ old('cupom_number', $expense->cupom_number) }}" class="w-full dark:text-gray-400" placeholder="Ex: 999999" />

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
                <x-form.input type="text" id="description" name="description"
                    value="{{ old('description', $expense->description) }}" class="w-full dark:text-gray-400"
                    placeholder="Ex: Descrição do Recibo" />

                @error("description")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="enterprise" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Empresa: (*opcional)
            </label>
            <x-form.input type="text" id="enterprise" name="enterprise"
                value="{{ old('enterprise', $expense->enterprise) }}" class="w-full dark:text-gray-400"
                placeholder="Ex: Nome da Empresa" />

            @error("enterprise")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Valor: <span class="text-red-700 dark:text-red-500">*</span>
            </label>
            <x-form.input type="text" id="price" name="price"
                value="{{ old('price', 'R$ ' . number_format($expense->price, 2, ',', '.')) }}"
                class="w-full dark:text-gray-400" required placeholder="Ex: 49,99" oninput="mascaraMoeda(event)" />

            @error("price")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

    </x-table-edit>

</x-app-layout>