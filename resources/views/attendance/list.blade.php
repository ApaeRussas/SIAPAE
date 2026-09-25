<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">

            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                {{ __('Lista de Atendimento') }}
            </h2>

        </div>
    </x-slot>


    <div class="attendance-list-page py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-table
                title="Atendimento"
                :headers="[
                    'Data',
                    'Aluno',
                    'Eixo Educacional',
                    'Assinatura'
                ]"
                :rows="$attendances"
                :variablesDB="[
                    'date',
                    'student.name',
                    'educational_axis',
                    'professor.name'
                ]"
                iteration="false"
                withShow
                withSearchDateRange
                :range="$date_range"
                actionRoute="attendance"
            />

        </div>

    </div>


    <style>
        .attendance-list-page {
            min-height: calc(100vh - 120px);
            background: #F4F6F8;
        }

        .attendance-list-page .max-w-7xl {
            position: relative;
        }

        .attendance-list-page table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .attendance-list-page table thead th {
            background: #EDF5F0 !important;
            color: #102A43 !important;
            font-weight: 600;
        }

        .attendance-list-page table tbody tr {
            transition: background-color 0.2s ease;
        }

        .attendance-list-page table tbody tr:hover {
            background-color: #F7FAF8 !important;
        }

        .attendance-list-page table td,
        .attendance-list-page table th {
            border-color: #E1E7EC !important;
        }

        .attendance-list-page input,
        .attendance-list-page select {
            border-color: #D7DEE5;
            border-radius: 8px;
        }

        .attendance-list-page input:focus,
        .attendance-list-page select:focus {
            border-color: #3B7D5A;
            box-shadow: 0 0 0 2px rgba(59, 125, 90, 0.12);
            outline: none;
        }

        .attendance-list-page a {
            transition: all 0.2s ease;
        }
    </style>

</x-app-layout>