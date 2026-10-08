@php
    $context = $context ?? 'coordinator';
@endphp

<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 rounded-2xl border border-[#DCE7DF] bg-[#FFFDF9] px-5 py-4 shadow-sm dark:border-[#294236] dark:bg-[#14271E] sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <p class="text-sm font-medium text-[#2F6B4F] dark:text-[#8CC9A3]">
                        Administração
                    </p>

                    <h2 class="text-2xl font-semibold leading-tight text-[#243129] dark:text-[#F5F1E8] md:text-3xl">
                        {{ __('Tabela de Usuários') }}
                    </h2>

                    <p class="mt-1 text-sm text-[#66788A] dark:text-[#91A197]">
                        Gerencie os usuários cadastrados no SIAPAE.
                    </p>
                </div>

                <x-button
                    href="{{ route('coordinator.deposit') }}"
                    class="coordinator-green-button !justify-center !gap-2 !rounded-xl !border-[#2F6B4F] !bg-[#2F6B4F] !text-white hover:!border-[#1F513A] hover:!bg-[#1F513A] hover:!text-white focus:!bg-[#2F6B4F] active:!bg-[#1F513A] dark:!border-[#3A8060] dark:!bg-[#3A8060] dark:!text-white dark:hover:!bg-[#4A9A75]"
                >
                    <x-icons.archive
                        class="h-5 w-5 !text-white"
                        aria-hidden="true"
                    />

                    <span>
                        {{ __('Armazém') }}
                    </span>
                </x-button>

            </div>
        </div>
    </x-slot>

    @php
        $isNotAdmin = 1;

        if (Auth::user()->can('admin-view')) {
            $isNotAdmin = null;
        }
    @endphp

    <div class="coordinator-green-page max-w-7xl mx-auto px-4 pb-8 sm:px-6 lg:px-8">

        <div class="rounded-2xl border border-[#DCE7DF] bg-[#FFFDF9] p-3 shadow-sm dark:border-[#294236] dark:bg-[#14271E]">

            <x-table
                title="Usuário"
                :headers="['Nome', 'Email', 'Profissão', 'Acesso']"
                :rows="$users"
                :variablesDB="['name', 'email', 'position', 'access_level']"
                iteration="false"
                withSearchInput
                searchRoute="coordinator.index"
                :search="$search"
                withShow
                archiveInsteadDestroy
                :isNotAdmin="$isNotAdmin"
                notArchiveAdmin
                strLimit="22"
                actionRoute="coordinator">
            </x-table>

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

        .coordinator-green-page table thead {
            background: #E3EFE7 !important;
        }

        .coordinator-green-page table thead tr {
            background: #E3EFE7 !important;
            border-color: #CFE0D5 !important;
        }

        .coordinator-green-page table thead th {
            background: #E3EFE7 !important;
            color: #1F513A !important;
            border-color: #CFE0D5 !important;
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

        .coordinator-green-page table button,
        .coordinator-green-page table a.inline-flex,
        .coordinator-green-page table a.inline-block {
            border-color: #2F6B4F !important;
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

        .dark .coordinator-green-page table {
            border-color: #294236 !important;
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

</x-app-layout>