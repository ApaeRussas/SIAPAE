<x-app-layout :context="$context">
 
    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-x-2">
                <h2 class="text-2xl md:text-3xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Lista de Atendimento') }}
                </h2>
            </div>
        </div>
    </x-slot>
 
    <div class="attendance-page">
 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
 
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
 
</x-app-layout>
 
 
<style>
    .attendance-page {
        --bg: transparent;
        --surface: #F7F5EF;
        --surface-soft: #E3EFE7;
        --surface-hover: #F0EEE6;
        --input-bg: #FFFFFF;
        --title: #183C2C;
        --text: #42564A;
        --muted: #78857D;
        --border: #E2E8E2;
        --green: #2F6B4F;
        --green-dark: #1F513A;
        --green-light: #E3EFE7;
        --gold: #C99B4A;
        --gold-light: #F7EFDD;
        --danger: #C98B45;
        --danger-dark: #A96F31;
        --neutral: #B8C7BE;
        --shadow: 0 10px 30px rgba(31, 81, 58, 0.06);
        display: block;
        min-height: calc(100vh - 64px);
        background-color: var(--bg);
        color: var(--text);
        padding-bottom: 2rem;
        transition: background-color 250ms ease, color 250ms ease;
    }
 
    .dark .attendance-page {
        --bg: #0D1B15;
        --surface: #14271E;
        --surface-soft: #1A3025;
        --surface-hover: #20392C;
        --input-bg: #FFFFFF;
        --title: #F5F1E8;
        --text: #D1DBD3;
        --muted: #91A197;
        --border: #294236;
        --green: #76B58F;
        --green-dark: #5D9D78;
        --green-light: rgba(118, 181, 143, 0.14);
        --gold: #D8B56A;
        --gold-light: rgba(216, 181, 106, 0.13);
        --danger: #D8935B;
        --danger-dark: #C77A3E;
        --neutral: #40584B;
        --shadow: 0 14px 35px rgba(0, 0, 0, 0.20);
    }
 
    /* Fundos: tudo que era branco/cinza vira off-white (igual à frequência) */
    .attendance-page .bg-white,
    .attendance-page .dark\:bg-gray-800,
    .attendance-page .dark\:bg-gray-900,
    .attendance-page .dark\:bg-gray-700 {
        background-color: var(--surface) !important;
    }
    .attendance-page .bg-gray-50,
    .attendance-page .bg-gray-100,
    .attendance-page .dark\:bg-gray-600 {
        background-color: var(--surface-soft) !important;
    }
    .attendance-page .shadow,
    .attendance-page .shadow-sm,
    .attendance-page .shadow-md,
    .attendance-page .shadow-lg { box-shadow: none !important; }
    .attendance-page .border-gray-100,
    .attendance-page .border-gray-200,
    .attendance-page .border-gray-300,
    .attendance-page .dark\:border-gray-700,
    .attendance-page .dark\:border-gray-600 { border-color: var(--border) !important; }
 
    /* Tabelas */
    .attendance-page table { background-color: var(--surface) !important; }
    .attendance-page table thead,
    .attendance-page table thead th {
        background-color: var(--surface-soft) !important;
        color: var(--muted) !important;
        border-color: var(--border) !important;
        font-weight: 600;
    }
    .attendance-page table td { color: var(--text) !important; border-color: var(--border) !important; }
    .attendance-page table tbody tr { background-color: var(--surface) !important; transition: background-color 0.18s ease; }
    .attendance-page table tbody tr:hover { background-color: var(--surface-hover) !important; }
 
    /* Campos */
    .attendance-page input,
    .attendance-page select,
    .attendance-page textarea {
        color: var(--title) !important;
        background-color: var(--input-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }
    .attendance-page input::placeholder,
    .attendance-page textarea::placeholder { color: var(--muted) !important; opacity: 1; }
    .attendance-page input:focus,
    .attendance-page select:focus,
    .attendance-page textarea:focus {
        border-color: var(--green) !important;
        box-shadow: 0 0 0 3px var(--green-light) !important;
        outline: none !important;
    }
    .attendance-page #search-container {
        background-color: var(--input-bg) !important;
        border: 1px solid var(--border) !important;
        border-radius: 10px !important;
        box-shadow: none !important;
    }
    .attendance-page #search-container input,
    .attendance-page #search-container select {
        border-color: transparent !important;
    }
    .attendance-page #search-container:focus-within {
        border-color: var(--green) !important;
        box-shadow: 0 0 0 3px var(--green-light) !important;
    }
 
    /* Azul -> verde */
    .attendance-page .bg-blue-500,
    .attendance-page .bg-blue-600,
    .attendance-page .bg-blue-700 {
        background-color: var(--green) !important;
        border-color: var(--green) !important;
        color: #FFFFFF !important;
    }
    .attendance-page .bg-blue-500:hover,
    .attendance-page .bg-blue-600:hover,
    .attendance-page .bg-blue-700:hover,
    .attendance-page .hover\:bg-blue-600:hover,
    .attendance-page .hover\:bg-blue-700:hover {
        background-color: var(--green-dark) !important;
        border-color: var(--green-dark) !important;
    }
    .attendance-page .text-blue-500,
    .attendance-page .text-blue-600,
    .attendance-page .text-blue-700 { color: var(--green) !important; }
 
    /* Paginação */
    .attendance-page nav { color: var(--muted) !important; }
    .attendance-page nav a,
    .attendance-page nav span { color: var(--text) !important; }
 
    .attendance-page button,
    .attendance-page a {
        transition: background-color 0.18s ease, border-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
    }
</style>