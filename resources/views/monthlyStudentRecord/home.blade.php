<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-semibold leading-tight text-[#243129] dark:text-[#F1F5F0] md:text-3xl">
                Ficha mensal
            </h2>

            <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                Histórico de acompanhamento dos estudantes
            </p>

        </div>

    </x-slot>

    <div class="bg-[#F8F7F2] py-8 dark:bg-[#101713]">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm dark:border-[#2A382F] dark:bg-[#151D18]">

                <div class="mb-6">

                    <h3 class="text-xl font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        Estudantes
                    </h3>

                    <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Selecione um estudante para consultar seu histórico de acompanhamento.
                    </p>

                </div>

                <form
                    method="GET"
                    action="{{ route('monthlyStudentRecord.index') }}"
                    class="flex flex-col gap-4 md:flex-row md:items-end"
                >

                    <div class="flex-1">

                        <label
                            for="search"
                            class="mb-2 block text-sm font-medium text-[#243129] dark:text-[#F1F5F0]"
                        >
                            Pesquisar estudante
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Digite o nome do estudante"
                            class="w-full rounded-xl border border-[#D7DED8] bg-white px-4 py-3 text-sm text-[#243129] outline-none transition placeholder:text-[#9AA59E] focus:border-[#2F6B4F] focus:ring-2 focus:ring-[#2F6B4F]/20 dark:border-[#365342] dark:bg-[#1A241E] dark:text-[#F1F5F0] dark:placeholder:text-[#7F8C83] dark:focus:border-[#7EAF91] dark:focus:ring-[#7EAF91]/20"
                        >

                    </div>

                    <button
                        type="submit"
                        class="rounded-xl bg-[#2F6B4F] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#23543E] dark:bg-[#7EAF91] dark:text-[#101713] dark:hover:bg-[#A9C9B2]"
                    >
                        Pesquisar
                    </button>

                </form>

            </div>

            @php
                $studentsWithAttendance = $students->filter(function ($student) {
                    return $student->attendances->isNotEmpty();
                });
            @endphp

            @if ($studentsWithAttendance->isNotEmpty())

                <div class="space-y-4">

                    @foreach ($studentsWithAttendance as $student)

                        @php
                            $attendanceCount = $student->attendances->count();

                            $professorCount = $student->attendances
                                ->pluck('signature_id')
                                ->filter()
                                ->unique()
                                ->count();

                            $lastAttendance = $student->attendances->first();
                        @endphp

                        <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-[#2A382F] dark:bg-[#151D18] dark:hover:bg-[#1A241E]">

                            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                                <div>

                                    <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                                        {{ $student->name }}
                                    </h3>

                                    <div class="mt-2 flex flex-wrap gap-x-5 gap-y-2 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">

                                        <span>
                                            {{ $attendanceCount }}
                                            {{ $attendanceCount === 1 ? 'atendimento' : 'atendimentos' }}
                                        </span>

                                        <span>
                                            {{ $professorCount }}
                                            {{ $professorCount === 1 ? 'professor' : 'professores' }}
                                        </span>

                                        @if ($lastAttendance?->date)

                                            <span>
                                                Último atendimento:
                                                {{ \Carbon\Carbon::parse($lastAttendance->date)->format('d/m/Y') }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <a
                                    href="{{ route('monthlyStudentRecord.show', ['student' => $student->id]) }}"
                                    class="inline-flex items-center justify-center rounded-xl bg-[#2F6B4F] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#23543E] dark:bg-[#7EAF91] dark:text-[#101713] dark:hover:bg-[#A9C9B2]"
                                >
                                    Ver ficha
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="rounded-3xl border border-[#E4E8E2] bg-[#FFFDF9] px-6 py-12 text-center dark:border-[#2A382F] dark:bg-[#151D18]">

                    <h3 class="text-lg font-semibold text-[#243129] dark:text-[#F1F5F0]">
                        Nenhum estudante encontrado
                    </h3>

                    <p class="mt-1 text-sm text-[#6E7A72] dark:text-[#A9B5AC]">
                        Não encontramos estudantes com registros de atendimento.
                    </p>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>