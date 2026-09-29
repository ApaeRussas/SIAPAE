<x-app-layout>

    {{-- ==========================================================
         CABEÇALHO
         ========================================================== --}}
    <x-slot name="header">

        <div
            class="
                flex
                flex-col
                sm:flex-row
                sm:items-center
                sm:justify-between
                gap-3
                max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8
            "
        >

            <div>

                <h2
                    class="
                        text-xl
                        md:text-2xl
                        font-bold
                        leading-tight
                        text-[#1F513A]
                        dark:text-[#F5F1E8]
                    "
                >
                    Atendimentos do dia {{ $date }}
                </h2>

                <p
                    class="
                        text-sm
                        text-[#78857D]
                        dark:text-[#91A197]
                        mt-1
                    "
                >
                    Selecione um atendimento para visualizar todos os detalhes.
                </p>

            </div>


            {{-- ==================================================
                 BOTÕES
                 ================================================== --}}
            <div class="flex gap-2">

                {{-- Voltar --}}
                <x-button
                    href="{{ route('attendance.index') }}"
                    variant="gray"
                    class="
                        !rounded-xl
                        !border-[#DCE5DE]
                        !text-[#3E4C43]
                        hover:!bg-[#EAF0EB]
                        dark:!border-[#294236]
                        dark:!bg-[#172C22]
                        dark:!text-[#D1DBD3]
                        dark:hover:!bg-[#1E3A2C]
                    "
                >
                    Voltar
                </x-button>


                {{-- Adicionar atendimento --}}
                <x-button
                    href="{{ route('attendance.create') }}"
                    variant="gray"
                    class="
                        !rounded-xl
                        !border-0
                        !bg-[#2F6B4F]
                        !text-white
                        hover:!bg-[#1F513A]
                        dark:!bg-[#2F6B4F]
                        dark:!text-[#F5F1E8]
                        dark:hover:!bg-[#3A795A]
                    "
                >
                    Adicionar novo atendimento
                </x-button>

            </div>

        </div>

    </x-slot>


    {{-- ==========================================================
         CONTEÚDO
         ========================================================== --}}
    <div
        class="
            py-6
            bg-[#F7F5EF]
            dark:bg-[#0D1B15]
            min-h-full
        "
    >

        <div
            class="
                max-w-7xl
                mx-auto
                px-4
                sm:px-6
                lg:px-8
            "
        >

            @if($attendances->isEmpty())

                {{-- ==================================================
                     NENHUM ATENDIMENTO
                     ================================================== --}}
                <div
                    class="
                        bg-[#FFFDF9]
                        dark:bg-[#14271E]
                        rounded-2xl
                        shadow-sm
                        p-6
                        text-center
                        border
                        border-[#E2E8E2]
                        dark:border-[#294236]
                    "
                >

                    <p
                        class="
                            text-[#78857D]
                            dark:text-[#91A197]
                        "
                    >
                        Nenhum atendimento foi registrado nesta data.
                    </p>


                    <div class="mt-4">

                        <x-button
                            href="{{ route('attendance.create') }}"
                            variant="gray"
                            class="
                                !rounded-xl
                                !border-0
                                !bg-[#2F6B4F]
                                !text-white
                                hover:!bg-[#1F513A]
                                dark:!bg-[#2F6B4F]
                                dark:!text-[#F5F1E8]
                                dark:hover:!bg-[#3A795A]
                            "
                        >
                            Adicionar novo atendimento
                        </x-button>

                    </div>

                </div>

            @else

                {{-- ==================================================
                     LISTA DE ATENDIMENTOS
                     ================================================== --}}
                <div class="space-y-3">

                    @foreach($attendances as $attendance)

                        <a
                            href="{{ route('attendance.show', $attendance->id) }}"
                            class="
                                block
                                bg-[#FFFDF9]
                                dark:bg-[#14271E]
                                rounded-2xl
                                shadow-sm
                                hover:shadow-md
                                transition-all
                                duration-200
                                p-5
                                border
                                border-[#E2E8E2]
                                dark:border-[#294236]
                                hover:border-[#76B58F]
                                dark:hover:border-[#D8B56A]
                            "
                        >

                            <div
                                class="
                                    flex
                                    flex-col
                                    md:flex-row
                                    md:items-center
                                    md:justify-between
                                    gap-4
                                "
                            >

                                {{-- ==================================================
                                     INFORMAÇÕES
                                     ================================================== --}}
                                <div class="flex-1">

                                    <div
                                        class="
                                            flex
                                            items-center
                                            gap-2
                                            mb-2
                                        "
                                    >

                                        <h3
                                            class="
                                                text-lg
                                                font-semibold
                                                text-[#1F513A]
                                                dark:text-[#F5F1E8]
                                            "
                                        >
                                            {{ $attendance->student->name }}
                                        </h3>


                                        {{-- Badge --}}
                                        <span
                                            class="
                                                text-xs
                                                px-2
                                                py-1
                                                rounded-full
                                                bg-[#E3EFE7]
                                                text-[#2F6B4F]
                                                dark:bg-[#1E3A2C]
                                                dark:text-[#D8B56A]
                                            "
                                        >
                                            Atendimento
                                        </span>

                                    </div>


                                    {{-- ==================================================
                                         PROFESSOR / EIXO
                                         ================================================== --}}
                                    <div
                                        class="
                                            grid
                                            grid-cols-1
                                            md:grid-cols-2
                                            gap-2
                                            text-sm
                                        "
                                    >

                                        <p
                                            class="
                                                text-[#5F6F65]
                                                dark:text-[#B7C6BC]
                                            "
                                        >
                                            <strong>Professor:</strong>
                                            {{ $attendance->professor->name ?? 'Não informado' }}
                                        </p>


                                        <p
                                            class="
                                                text-[#5F6F65]
                                                dark:text-[#B7C6BC]
                                            "
                                        >
                                            <strong>Eixo educacional:</strong>
                                            {{ $attendance->educational_axis ?? 'Não informado' }}
                                        </p>

                                    </div>


                                    {{-- ==================================================
                                         AVANÇOS
                                         ================================================== --}}
                                    @if($attendance->advances)

                                        <p
                                            class="
                                                text-sm
                                                text-[#78857D]
                                                dark:text-[#91A197]
                                                mt-3
                                            "
                                        >

                                            <strong>Avanços:</strong>

                                            {{ \Illuminate\Support\Str::limit($attendance->advances, 120) }}

                                        </p>

                                    @endif

                                </div>


                                {{-- ==================================================
                                     AÇÃO
                                     ================================================== --}}
                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-end
                                    "
                                >

                                    <span
                                        class="
                                            text-[#2F6B4F]
                                            dark:text-[#76B58F]
                                            font-medium
                                            text-sm
                                            transition-colors
                                            duration-200
                                        "
                                    >
                                        Ver atendimento →
                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @endif

        </div>

    </div>

</x-app-layout>