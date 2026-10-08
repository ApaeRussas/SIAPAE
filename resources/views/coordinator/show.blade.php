@php
    $context = $context ?? 'coordinator';
    $isArchived = $isArchived ?? null;
    $attendances = $attendances ?? collect();
    $date_range = $date_range ?? null;

    $state_user = '';

    if (isset($isArchived)) {
        $state_user = ' (Arquivado)';
    }
@endphp

<x-app-layout :context="$context">

    <div class="coordinator-green-page max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">

        <div class="mb-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-[#2F6B4F] dark:text-[#8CC9A3]">
                    Usuários
                </p>

                <h2 class="text-2xl md:text-3xl font-semibold leading-tight text-[#243129] dark:text-[#F5F1E8]">
                    {{ 'Informações do Usuário' . $state_user }}
                </h2>
            </div>

            <x-button
                href="{{ route('coordinator.index') }}"
                class="coordinator-green-button !justify-center !gap-2 !rounded-xl !border-[#2F6B4F] !bg-[#2F6B4F] !text-white hover:!border-[#1F513A] hover:!bg-[#1F513A] hover:!text-white dark:!border-[#3A8060] dark:!bg-[#3A8060] dark:!text-white dark:hover:!bg-[#4A9A75]"
            >
                <x-heroicon-o-arrow-left class="w-5 h-5 !text-white" aria-hidden="true" />

                <span class="hidden sm:block">
                    {{ __('Voltar') }}
                </span>
            </x-button>
        </div>

        <div class="rounded-2xl border border-[#DCE7DF] bg-[#FFFDF9] p-5 shadow-sm dark:border-[#294236] dark:bg-[#14271E]">

            <x-table-show
                :title="'Informações do Usuário'. $state_user"
                :elementShow="$user"
                :labelsVariables="[
                    ['Nome do Usuário', 'name', 'text'],
                    ['Email', 'email', 'text'],
                    ['Profissão', 'position', 'select'],
                ]"
                additional
                notEditDelete
                actionRoute="coordinator"
                :isArchived="$isArchived"
            >

                @if ($user->position == 'Professor(a)')

                    <div class="my-6 border-t border-[#DCE7DF] dark:border-[#294236]"></div>

                    <div class="mb-5">
                        <p class="text-sm font-medium text-[#2F6B4F] dark:text-[#8CC9A3]">
                            Histórico profissional
                        </p>

                        <h3 class="mt-1 text-xl font-semibold text-[#243129] dark:text-[#F5F1E8]">
                            Registros de Atendimento
                        </h3>

                        <p class="mt-1 text-sm text-[#66788A] dark:text-[#91A197]">
                            Atendimentos realizados por {{ \Illuminate\Support\Str::words($user->name, 2, ' ...') }}.
                        </p>
                    </div>

                    <div class="coordinator-green-table rounded-2xl border border-[#DCE7DF] bg-[#F8F7F2] p-3 dark:border-[#294236] dark:bg-[#101713]">

                        <x-table
                            title="Atendimento"
                            :rows="$attendances"
                            :headers="['Nome do Aluno', 'Date', 'Advances', 'Difficulties']"
                            :variables_DB="['student.name', 'date', 'advances', 'difficulties']"
                            iteration="false"
                            withSearchDateRange
                            :element="$user"
                            searchRoute="coordinator.show"
                            notButtonAdd
                            :range="$date_range"
                            withShow
                            actionRoute="attendance"
                        >
                        </x-table>

                    </div>

                    @if (isset($scrollBack))
                        <div class="scroll-target"></div>
                    @endif

                @else

                    <div class="h-4"></div>

                @endif

                <div class="mt-7 flex flex-col gap-3 border-t border-[#DCE7DF] pt-5 sm:flex-row sm:items-center sm:justify-between dark:border-[#294236]">

                    @if (Auth::user()->can('admin-view'))

                        <x-button
                            href="{{ route('coordinator.edit', $user->id) }}"
                            title="Editar {{ $user->name }}"
                            class="coordinator-green-button !justify-center !rounded-xl !border-[#2F6B4F] !bg-[#2F6B4F] !text-white hover:!border-[#1F513A] hover:!bg-[#1F513A] hover:!text-white dark:!border-[#3A8060] dark:!bg-[#3A8060] dark:!text-white dark:hover:!bg-[#4A9A75]"
                        >
                            <span class="px-2">
                                {{ __('Editar') }}
                            </span>
                        </x-button>

                    @else

                        <div></div>

                    @endif

                    @if (!isset($isArchived))

                        <form
                            method="POST"
                            action="{{ route('coordinator.archive', $user->id) }}"
                            accept-charset="UTF-8"
                            class="sm:ml-auto"
                        >
                            {{ csrf_field() }}

                            <x-button
                                type="submit"
                                title="Arquivar {{ $user->name }}"
                                class="coordinator-green-button !justify-center !rounded-xl !border-[#2F6B4F] !bg-[#2F6B4F] !text-white hover:!border-[#1F513A] hover:!bg-[#1F513A] hover:!text-white dark:!border-[#3A8060] dark:!bg-[#3A8060] dark:!text-white dark:hover:!bg-[#4A9A75]"
                                onclick="warningConfirm(event, 'Essa ação irá arquivar o usuário selecionado!', 'warning', 'Arquivar')"
                            >
                                <span class="px-2">
                                    {{ __('Arquivar') }}
                                </span>
                            </x-button>

                        </form>

                    @else

                        <form
                            action="{{ route('coordinator.restore', $user->id) }}"
                            method="POST"
                            class="sm:ml-auto"
                            onclick="warningConfirm(event, 'Quer restaurar o Usuário?', 'question', 'Restaurar')"
                        >
                            {{ csrf_field() }}

                            <x-button
                                type="submit"
                                title="Restaurar o Usuário"
                                class="coordinator-green-button !justify-center !rounded-xl !border-[#2F6B4F] !bg-[#2F6B4F] !text-white hover:!border-[#1F513A] hover:!bg-[#1F513A] hover:!text-white dark:!border-[#3A8060] dark:!bg-[#3A8060] dark:!text-white dark:hover:!bg-[#4A9A75]"
                            >
                                <span class="px-2">
                                    {{ __('Restaurar') }}
                                </span>
                            </x-button>

                        </form>

                    @endif

                </div>

            </x-table-show>

        </div>

    </div>

    <style>
        .coordinator-green-button {
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        .coordinator-green-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(47, 107, 79, 0.18);
        }

        .coordinator-green-page table {
            border-color: #DCE7DF !important;
        }

        .coordinator-green-page table thead,
        .coordinator-green-page table thead tr,
        .coordinator-green-page table thead th {
            background: #E3EFE7 !important;
            color: #1F513A !important;
            border-color: #CFE0D5 !important;
        }

        .coordinator-green-page table thead th {
            font-weight: 700 !important;
        }

        .coordinator-green-page table tbody {
            background: #FFFDF9 !important;
        }

        .coordinator-green-page table tbody tr {
            background: #FFFDF9 !important;
            border-color: #E5ECE7 !important;
            transition: background-color 0.18s ease;
        }

        .coordinator-green-page table tbody tr:hover {
            background: #F1F6F2 !important;
        }

        .coordinator-green-page table tbody td {
            border-color: #E5ECE7 !important;
        }

        .coordinator-green-page table tbody a {
            color: #2F6B4F !important;
        }

        .coordinator-green-page table tbody a:hover {
            color: #1F513A !important;
        }

        .coordinator-green-page input:focus,
        .coordinator-green-page select:focus {
            border-color: #2F6B4F !important;
            box-shadow: 0 0 0 3px rgba(47, 107, 79, 0.12) !important;
            outline: none !important;
        }

        .coordinator-green-page .text-blue-500,
        .coordinator-green-page .text-blue-600,
        .coordinator-green-page .text-blue-700,
        .coordinator-green-page .text-indigo-500,
        .coordinator-green-page .text-indigo-600,
        .coordinator-green-page .text-indigo-700 {
            color: #2F6B4F !important;
        }

        .coordinator-green-page .bg-blue-50,
        .coordinator-green-page .bg-blue-100,
        .coordinator-green-page .bg-blue-500,
        .coordinator-green-page .bg-blue-600,
        .coordinator-green-page .bg-indigo-50,
        .coordinator-green-page .bg-indigo-100,
        .coordinator-green-page .bg-indigo-500,
        .coordinator-green-page .bg-indigo-600 {
            background-color: #2F6B4F !important;
        }

        .coordinator-green-page .hover\:bg-blue-600:hover,
        .coordinator-green-page .hover\:bg-blue-700:hover,
        .coordinator-green-page .hover\:bg-indigo-600:hover,
        .coordinator-green-page .hover\:bg-indigo-700:hover {
            background-color: #1F513A !important;
        }

        .dark .coordinator-green-page table thead,
        .dark .coordinator-green-page table thead tr,
        .dark .coordinator-green-page table thead th {
            background: #1A3025 !important;
            color: #D1DBD3 !important;
            border-color: #294236 !important;
        }

        .dark .coordinator-green-page table tbody {
            background: #14271E !important;
        }

        .dark .coordinator-green-page table tbody tr {
            background: #14271E !important;
            border-color: #294236 !important;
        }

        .dark .coordinator-green-page table tbody tr:hover {
            background: #20392C !important;
        }

        .dark .coordinator-green-page table tbody td {
            border-color: #294236 !important;
        }

        .dark .coordinator-green-page table tbody a {
            color: #8CC9A3 !important;
        }

        .dark .coordinator-green-page table tbody a:hover {
            color: #A8D5B8 !important;
        }

        .dark .coordinator-green-page input:focus,
        .dark .coordinator-green-page select:focus {
            border-color: #76B58F !important;
            box-shadow: 0 0 0 3px rgba(118, 181, 143, 0.18) !important;
        }
    </style>

    <script>
        function scrollToSelector() {
            const element = document.querySelector(".scroll-target");

            if (element) {
                element.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }

        @if (isset($scrollBack))
            document.addEventListener("DOMContentLoaded", function () {
                scrollToSelector();
            });
        @endif
    </script>

</x-app-layout>