<x-app-layout :context="$context">

    {{-- CABEÇALHO DA PÁGINA --}}
    <x-slot name="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#102A43]">
                {{ __('Lista de Anamneses') }}
            </h2>

            {{-- BOTÃO ARMAZÉM --}}
            <x-button
                href="{{ route('anamnesis.deposit') }}"
                class="!bg-white !text-[#102A43] !border !border-gray-200 hover:!bg-[#F4F7F5] shadow-none"
            >
                <x-icons.archive
                    class="w-5 h-5 mr-2"
                    aria-hidden="true"
                />

                <span>{{ __('Armazém') }}</span>
            </x-button>

        </div>
    </x-slot>


    {{-- CONTEÚDO --}}
    <div class="py-6 bg-[#F4F6F8] min-h-screen overflow-x-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- CARD PRINCIPAL --}}
            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">

                {{-- CABEÇALHO DO CARD --}}
                <div class="px-8 pt-8 pb-6">

                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

                        {{-- TÍTULO --}}
                        <div>
                            <p class="text-sm font-semibold tracking-wide text-[#2F7658] mb-2">
                                SIAPAE
                            </p>

                            <h1 class="text-2xl md:text-3xl font-bold text-[#102A43]">
                                Fichas de anamnese
                            </h1>

                            <p class="mt-2 text-base md:text-lg text-[#66788A]">
                                Consulte e gerencie as fichas de anamnese dos alunos.
                            </p>
                        </div>


                        {{-- BOTÃO ADICIONAR --}}
                        <div class="flex-shrink-0">

                            <x-button
                                href="{{ route('anamnesis.create') }}"
                                class="!bg-[#3B7D5A] hover:!bg-[#2F684A] !text-white !border-0 shadow-sm"
                            >
                                <span class="px-1">
                                    {{ __('Adicionar anamnese') }}
                                </span>
                            </x-button>

                        </div>

                    </div>


                    {{-- PESQUISA --}}
                    <div class="mt-8">

                        <form
                            method="GET"
                            action="{{ route('anamnesis.index') }}"
                            class="w-full"
                        >

                            <div class="flex w-full">

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    placeholder="Nome do Aluno p/ Anamnese"
                                    class="w-full h-14 rounded-l-xl border border-[#D7DEE5] border-r-0 bg-white px-5 text-base text-[#102A43] placeholder-[#8091A5] focus:border-[#3B7D5A] focus:ring-1 focus:ring-[#3B7D5A] outline-none"
                                >

                                <button
                                    type="submit"
                                    class="w-16 h-14 flex items-center justify-center rounded-r-xl border border-[#D7DEE5] bg-white text-[#102A43] hover:bg-[#F4F7F5] transition"
                                    aria-label="Pesquisar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z"
                                        />
                                    </svg>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- LINHA DIVISÓRIA --}}
                <div class="mx-8 border-t border-[#E1E7EC]"></div>


                {{-- TABELA --}}
                <div class="px-8 py-8">

                    <div class="overflow-hidden rounded-xl border border-[#E1E7EC]">

                        <div class="overflow-x-auto">

                            <table class="w-full min-w-[800px]">

                                {{-- CABEÇALHO --}}
                                <thead>

                                    <tr class="bg-[#F4F6F8] border-b border-[#E1E7EC]">

                                        <th class="px-6 py-4 text-left text-sm font-bold text-[#102A43]">
                                            Nome
                                        </th>

                                        <th class="px-6 py-4 text-left text-sm font-bold text-[#102A43]">
                                            ID do Assistido
                                        </th>

                                        <th class="px-6 py-4 text-left text-sm font-bold text-[#102A43]">
                                            Data Anamnese
                                        </th>

                                        <th class="px-6 py-4 text-left text-sm font-bold text-[#102A43]">
                                            Assinatura
                                        </th>

                                        <th class="px-6 py-4 text-center text-sm font-bold text-[#102A43]">
                                            Ações
                                        </th>

                                    </tr>

                                </thead>


                                {{-- CORPO --}}
                                <tbody class="bg-white">

                                    @forelse ($medHistories as $medHistory)

                                        <tr
                                            class="border-b border-[#E8EDF1] last:border-b-0 hover:bg-[#F8FAF9] transition"
                                        >

                                            {{-- NOME --}}
                                            <td class="px-6 py-5">

                                                <a
                                                    href="{{ route('anamnesis.show', $medHistory->id) }}"
                                                    class="font-semibold text-[#102A43] hover:text-[#2F7658] transition"
                                                >
                                                    {{ $medHistory->student->name ?? 'Não informado' }}
                                                </a>

                                            </td>


                                            {{-- ID --}}
                                            <td class="px-6 py-5 text-sm text-[#66788A]">
                                                {{ $medHistory->student_id }}
                                            </td>


                                            {{-- DATA --}}
                                            <td class="px-6 py-5 text-sm text-[#66788A]">
                                                {{ $medHistory->date_of_anamnesis }}
                                            </td>


                                            {{-- ASSINATURA --}}
                                            <td class="px-6 py-5 text-sm text-[#66788A]">
                                                {{ $medHistory->user->name ?? 'Não informado' }}
                                            </td>


                                            {{-- AÇÕES --}}
                                            <td class="px-6 py-5">

                                                <div class="flex justify-center">

                                                    <x-button
                                                        href="{{ route('anamnesis.show', $medHistory->id) }}"
                                                        class="!bg-transparent !border-0 !text-[#2F7658] hover:!bg-[#EDF5F0] shadow-none"
                                                    >
                                                        <span class="font-semibold">
                                                            Ver detalhes
                                                        </span>

                                                        <span class="ml-1">
                                                            →
                                                        </span>
                                                    </x-button>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        {{-- SEM RESULTADOS --}}
                                        <tr>

                                            <td
                                                colspan="5"
                                                class="px-6 py-16 text-center"
                                            >

                                                <div class="flex flex-col items-center justify-center">

                                                    {{-- ÍCONE DOCUMENTO --}}
                                                    <div class="mb-4 text-[#2F7658]">

                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="w-8 h-8"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M9 4.5V3h6v1.5M9 4.5H6.75A2.25 2.25 0 0 0 4.5 6.75v12A2.25 2.25 0 0 0 6.75 21h10.5a2.25 2.25 0 0 0 2.25-2.25v-12a2.25 2.25 0 0 0-2.25-2.25H15M9 4.5h6M8.25 10.5h7.5M8.25 14h7.5M8.25 17.5h4.5"
                                                            />
                                                        </svg>

                                                    </div>


                                                    <p class="text-base text-[#66788A]">
                                                        Nenhum registro encontrado.
                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>


                    {{-- PAGINAÇÃO --}}
                    @if ($medHistories->hasPages())

                        <div class="mt-6">
                            {{ $medHistories->appends(request()->query())->links() }}
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>