<x-app-layout>
    <div class="expense-create-page">
        <x-table-create title="Gasto" onlyHead actionRoute="expense">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="date_of_emission" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Data de Emissão
                    </label>

                    <input
                        type="date"
                        name="date_of_emission"
                        id="date_of_emission"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    >
                </div>

                <div>
                    <label for="type" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Tipo
                    </label>

                    <input
                        type="text"
                        name="type"
                        id="type"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    >
                </div>

                <div>
                    <label for="number" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Número
                    </label>

                    <input
                        type="text"
                        name="number"
                        id="number"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    >
                </div>

                <div>
                    <label for="enterprise" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Empresa
                    </label>

                    <input
                        type="text"
                        name="enterprise"
                        id="enterprise"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    >
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Descrição
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    ></textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-[#334E68] mb-2">
                        Valor
                    </label>

                    <input
                        type="number"
                        name="price"
                        id="price"
                        step="0.01"
                        min="0"
                        required
                        class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                    >
                </div>

            </div>

        </x-table-create>
    </div>

    <style>
        .expense-create-page {
            background-color: #EAF3ED;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }

        .expense-create-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .expense-create-page input,
        .expense-create-page select,
        .expense-create-page textarea {
            background-color: #FFFFFF !important;
            color: #334E68 !important;
            border-color: #D7DEE5 !important;
        }

        .expense-create-page input:focus,
        .expense-create-page select:focus,
        .expense-create-page textarea:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        .expense-create-page button[type="submit"] {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .expense-create-page button[type="submit"]:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }

        .expense-create-page label {
            color: #334E68;
        }
    </style>
</x-app-layout>