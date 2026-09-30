<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-xl sm:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                {{ __('Lista dos Estudantes Arquivados') }}
            </h2>

            <x-button
                href="{{ route('student.index') }}"
                class="justify-center gap-2 h-10 !bg-white !text-[#2F684A] !border !border-[#D7E2DC] hover:!bg-[#EDF5F0] hover:!border-[#3B7D5A] shadow-none"
            >
                <x-icons.person
                    class="w-6 h-6 -ml-1 !text-[#3B7D5A]"
                    aria-hidden="true"
                />

                <span class="hidden sm:block">
                    {{ __('Voltar') }}
                </span>
            </x-button>
        </div>
    </x-slot>

    <div class="student-deposit-page min-h-screen py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-table
                title="Aluno Arquivado"
                :headers="['Nome', 'Data Nasc.', 'ID do Aluno', 'Escola', 'Diagnóstico', 'Foto']"
                :rows="$students"
                :variablesDB="['name', 'date_of_birth', 'student_id', 'school', 'diagnostic', 'image']"
                iteration="false"
                withSearchInput
                searchRoute="student.deposit"
                :search="$search"
                withShow
                actionRoute="student"
                actionsDeposit
                depositWithEdit
            >
            </x-table>

        </div>

    </div>

    <style>
        .student-deposit-page {
            --siapae-green: #3B7D5A;
            --siapae-green-dark: #2F684A;
            --siapae-green-soft: #EDF5F0;
            --siapae-green-hover: #DCEDE3;
            --siapae-text: #102A43;
            --siapae-secondary: #66788A;
            --siapae-border: #D7E2DC;
            --siapae-row-border: #E5ECE8;
        }

        .student-deposit-page .bg-blue-400,
        .student-deposit-page .bg-blue-500,
        .student-deposit-page .bg-blue-600,
        .student-deposit-page .bg-blue-700 {
            background-color: var(--siapae-green) !important;
            background-image: none !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .student-deposit-page .hover\:bg-blue-500:hover,
        .student-deposit-page .hover\:bg-blue-600:hover,
        .student-deposit-page .hover\:bg-blue-700:hover {
            background-color: var(--siapae-green-dark) !important;
            border-color: var(--siapae-green-dark) !important;
            color: #FFFFFF !important;
        }

        .student-deposit-page .text-blue-400,
        .student-deposit-page .text-blue-500,
        .student-deposit-page .text-blue-600,
        .student-deposit-page .text-blue-700 {
            color: var(--siapae-green) !important;
        }

        .student-deposit-page .border-blue-400,
        .student-deposit-page .border-blue-500,
        .student-deposit-page .border-blue-600,
        .student-deposit-page .border-blue-700 {
            border-color: var(--siapae-green) !important;
        }

        .student-deposit-page .hover\:text-blue-500:hover,
        .student-deposit-page .hover\:text-blue-600:hover,
        .student-deposit-page .hover\:text-blue-700:hover {
            color: var(--siapae-green-dark) !important;
        }

        .student-deposit-page .hover\:border-blue-500:hover,
        .student-deposit-page .hover\:border-blue-600:hover,
        .student-deposit-page .hover\:border-blue-700:hover {
            border-color: var(--siapae-green) !important;
        }

        .student-deposit-page .bg-indigo-500,
        .student-deposit-page .bg-indigo-600,
        .student-deposit-page .bg-indigo-700 {
            background-color: var(--siapae-green) !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .student-deposit-page .text-indigo-500,
        .student-deposit-page .text-indigo-600,
        .student-deposit-page .text-indigo-700 {
            color: var(--siapae-green) !important;
        }

        .student-deposit-page .border-indigo-500,
        .student-deposit-page .border-indigo-600,
        .student-deposit-page .border-indigo-700 {
            border-color: var(--siapae-green) !important;
        }

        .student-deposit-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .student-deposit-page table {
            width: 100% !important;
            background-color: #FFFFFF !important;
            border: 1px solid var(--siapae-border) !important;
            border-radius: 12px !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            overflow: hidden !important;
        }

        .student-deposit-page table thead,
        .student-deposit-page table thead tr,
        .student-deposit-page table thead th {
            background-color: var(--siapae-green-soft) !important;
            color: var(--siapae-green-dark) !important;
            border-color: var(--siapae-border) !important;
        }

        .student-deposit-page table thead th {
            font-weight: 700 !important;
            padding-top: 16px !important;
            padding-bottom: 16px !important;
        }

        .student-deposit-page table tbody {
            background-color: #FFFFFF !important;
        }

        .student-deposit-page table tbody tr {
            background-color: #FFFFFF !important;
            border-color: var(--siapae-row-border) !important;
            transition: background-color .18s ease !important;
        }

        .student-deposit-page table tbody tr:hover {
            background-color: #F4F8F5 !important;
        }

        .student-deposit-page table tbody tr:hover td {
            background-color: #F4F8F5 !important;
        }

        .student-deposit-page table tbody td {
            color: var(--siapae-secondary) !important;
            border-color: var(--siapae-row-border) !important;
        }

        .student-deposit-page table tbody td a {
            color: var(--siapae-green-dark) !important;
            font-weight: 600 !important;
            transition: color .18s ease !important;
        }

        .student-deposit-page table tbody td a:hover {
            color: var(--siapae-green) !important;
        }

        .student-deposit-page #search-container {
            background-color: #FFFFFF !important;
            border: 1px solid var(--siapae-border) !important;
            border-radius: 10px !important;
            box-shadow: none !important;
            overflow: hidden !important;
        }

        .student-deposit-page #search-container:focus-within {
            border-color: var(--siapae-green) !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        }

        .student-deposit-page #search-container input {
            background-color: #FFFFFF !important;
            color: var(--siapae-text) !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .student-deposit-page #search-container input::placeholder {
            color: #8091A5 !important;
            opacity: 1 !important;
        }

        .student-deposit-page #search-container button {
            background-color: #FFFFFF !important;
            color: var(--siapae-green-dark) !important;
            border-color: var(--siapae-border) !important;
        }

        .student-deposit-page #search-container button:hover {
            background-color: var(--siapae-green-soft) !important;
            color: var(--siapae-green-dark) !important;
        }

        .student-deposit-page input,
        .student-deposit-page select {
            background-color: #FFFFFF !important;
            color: var(--siapae-text) !important;
            border-color: var(--siapae-border) !important;
        }

        .student-deposit-page input:focus,
        .student-deposit-page select:focus {
            border-color: var(--siapae-green) !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        .student-deposit-page .pagination .bg-blue-500,
        .student-deposit-page .pagination .bg-blue-600,
        .student-deposit-page .pagination .bg-blue-700 {
            background-color: var(--siapae-green) !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .student-deposit-page nav .bg-blue-500,
        .student-deposit-page nav .bg-blue-600,
        .student-deposit-page nav .bg-blue-700 {
            background-color: var(--siapae-green) !important;
            border-color: var(--siapae-green) !important;
            color: #FFFFFF !important;
        }

        .student-deposit-page nav .hover\:bg-blue-600:hover,
        .student-deposit-page nav .hover\:bg-blue-700:hover {
            background-color: var(--siapae-green-dark) !important;
        }

        .student-deposit-page .text-gray-500,
        .student-deposit-page .text-gray-600,
        .student-deposit-page .text-gray-700 {
            color: var(--siapae-secondary) !important;
        }

        .student-deposit-page .border-gray-200,
        .student-deposit-page .border-gray-300,
        .student-deposit-page .border-gray-400 {
            border-color: var(--siapae-border) !important;
        }

        @media (max-width: 768px) {
            .student-deposit-page table {
                font-size: 14px !important;
            }

            .student-deposit-page table thead th,
            .student-deposit-page table tbody td {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }
    </style>

</x-app-layout>