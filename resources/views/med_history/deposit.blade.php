<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl sm:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                {{ __('Lista das Anamneses Arquivadas') }}
            </h2>

            <x-button
                href="{{ route('anamnesis.index') }}"
                class="justify-center gap-2 h-10 !bg-[#EDF5F0] !text-[#2F684A] !border !border-[#CFE0D6] hover:!bg-[#DCEDE3] hover:!text-[#245E43] shadow-none"
            >
                <x-icons.anamnesis
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />

                <span class="hidden sm:block">
                    {{ __('Voltar') }}
                </span>
            </x-button>
        </div>
    </x-slot>

    <div class="anamnesis-deposit-page min-h-screen py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-table
                title="Aluna p/ Anamnese"
                :headers="['Nome', 'ID do Assistido', 'Data Anamnese', 'Assinatura']"
                :rows="$medHistories"
                :variablesDB="['student.name', 'student.student_id', 'date_of_anamnesis', 'user.name']"
                iteration="false"
                withSearchInput
                searchRoute="anamnesis.deposit"
                :search="$search"
                withShow
                actionRoute="anamnesis"
                notButtonDelete
                notButtonAdd
            >
            </x-table>

        </div>

    </div>

    <style>
        .anamnesis-deposit-page {
            --siapae-green: #3B7D5A;
            --siapae-green-dark: #2F684A;
            --siapae-green-soft: #EDF5F0;
            --siapae-green-hover: #DCEDE3;
            --siapae-text: #102A43;
            --siapae-secondary: #66788A;
            --siapae-border: #D7E2DC;
            --siapae-row-border: #E5ECE8;
        }

        .anamnesis-deposit-page .bg-blue-500,
        .anamnesis-deposit-page .bg-blue-600,
        .anamnesis-deposit-page .bg-blue-700,
        .anamnesis-deposit-page [class~="bg-blue-500"],
        .anamnesis-deposit-page [class~="bg-blue-600"],
        .anamnesis-deposit-page [class~="bg-blue-700"] {
            background-color: var(--siapae-green) !important;
            background-image: none !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .anamnesis-deposit-page [class~="hover:bg-blue-500"]:hover,
        .anamnesis-deposit-page [class~="hover:bg-blue-600"]:hover,
        .anamnesis-deposit-page [class~="hover:bg-blue-700"]:hover {
            background-color: var(--siapae-green-dark) !important;
            border-color: var(--siapae-green-dark) !important;
            color: #FFFFFF !important;
        }

        .anamnesis-deposit-page .text-blue-400,
        .anamnesis-deposit-page .text-blue-500,
        .anamnesis-deposit-page .text-blue-600,
        .anamnesis-deposit-page .text-blue-700,
        .anamnesis-deposit-page [class~="text-blue-400"],
        .anamnesis-deposit-page [class~="text-blue-500"],
        .anamnesis-deposit-page [class~="text-blue-600"],
        .anamnesis-deposit-page [class~="text-blue-700"] {
            color: var(--siapae-green) !important;
        }

        .anamnesis-deposit-page .border-blue-400,
        .anamnesis-deposit-page .border-blue-500,
        .anamnesis-deposit-page .border-blue-600,
        .anamnesis-deposit-page .border-blue-700,
        .anamnesis-deposit-page [class~="border-blue-400"],
        .anamnesis-deposit-page [class~="border-blue-500"],
        .anamnesis-deposit-page [class~="border-blue-600"],
        .anamnesis-deposit-page [class~="border-blue-700"] {
            border-color: var(--siapae-green) !important;
        }

        .anamnesis-deposit-page [class~="hover:text-blue-500"]:hover,
        .anamnesis-deposit-page [class~="hover:text-blue-600"]:hover,
        .anamnesis-deposit-page [class~="hover:text-blue-700"]:hover {
            color: var(--siapae-green-dark) !important;
        }

        .anamnesis-deposit-page [class~="hover:border-blue-500"]:hover,
        .anamnesis-deposit-page [class~="hover:border-blue-600"]:hover,
        .anamnesis-deposit-page [class~="hover:border-blue-700"]:hover {
            border-color: var(--siapae-green) !important;
        }

        .anamnesis-deposit-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .anamnesis-deposit-page table {
            background-color: #FFFFFF !important;
            border-color: var(--siapae-border) !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }

        .anamnesis-deposit-page table thead,
        .anamnesis-deposit-page table thead tr,
        .anamnesis-deposit-page table thead th {
            background-color: var(--siapae-green-soft) !important;
            color: var(--siapae-green-dark) !important;
            border-color: var(--siapae-border) !important;
        }

        .anamnesis-deposit-page table tbody,
        .anamnesis-deposit-page table tbody tr,
        .anamnesis-deposit-page table tbody td {
            background-color: #FFFFFF !important;
            border-color: var(--siapae-row-border) !important;
        }

        .anamnesis-deposit-page table tbody tr {
            transition: background-color .18s ease !important;
        }

        .anamnesis-deposit-page table tbody tr:hover {
            background-color: #F4F8F5 !important;
        }

        .anamnesis-deposit-page table tbody tr:hover td {
            background-color: #F4F8F5 !important;
        }

        .anamnesis-deposit-page table a {
            color: var(--siapae-green-dark) !important;
        }

        .anamnesis-deposit-page table a:hover {
            color: var(--siapae-green) !important;
        }

        .anamnesis-deposit-page input {
            background-color: #FFFFFF !important;
            color: var(--siapae-text) !important;
            border-color: #D7E2DC !important;
        }

        .anamnesis-deposit-page input:focus {
            border-color: var(--siapae-green) !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        .anamnesis-deposit-page input::placeholder {
            color: #8091A5 !important;
        }

        .anamnesis-deposit-page #search-container {
            background-color: #FFFFFF !important;
            border-color: #D7E2DC !important;
            box-shadow: none !important;
        }

        .anamnesis-deposit-page #search-container:focus-within {
            border-color: var(--siapae-green) !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }

        .anamnesis-deposit-page #search-container button {
            background-color: #FFFFFF !important;
            color: var(--siapae-green-dark) !important;
            border-color: #D7E2DC !important;
        }

        .anamnesis-deposit-page #search-container button:hover {
            background-color: var(--siapae-green-soft) !important;
            color: var(--siapae-green-dark) !important;
        }

        .anamnesis-deposit-page .pagination .bg-blue-500,
        .anamnesis-deposit-page .pagination .bg-blue-600,
        .anamnesis-deposit-page .pagination .bg-blue-700 {
            background-color: var(--siapae-green) !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .anamnesis-deposit-page nav [class~="bg-blue-500"],
        .anamnesis-deposit-page nav [class~="bg-blue-600"],
        .anamnesis-deposit-page nav [class~="bg-blue-700"] {
            background-color: var(--siapae-green) !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .anamnesis-deposit-page nav [class~="hover:bg-blue-600"]:hover,
        .anamnesis-deposit-page nav [class~="hover:bg-blue-700"]:hover {
            background-color: var(--siapae-green-dark) !important;
        }

        @media (max-width: 768px) {
            .anamnesis-deposit-page table {
                font-size: 14px !important;
            }

            .anamnesis-deposit-page table th,
            .anamnesis-deposit-page table td {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }
    </style>

</x-app-layout>