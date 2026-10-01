<x-app-layout :context="$context">

    <x-slot name="header">

        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-x-2">

                <h2 class="text-2xl md:text-3xl font-bold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Reg. de Atendimento') }}
                </h2>

            </div>

        </div>

    </x-slot>

    <div class="attendance-page">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <x-table-attendance
                title="Atendimento"
                :year="$year"
                :faixaSemana="$faixaSemana"
                :diasDaSemana="$diasDaSemana"
                :students="$students"
                :frequencies="$frequencies"
            />

        </div>

    </div>

</x-app-layout>

<style>

    .attendance-page {
        --bg: transparent;
        --surface: #FFFFFF;
        --surface-soft: #FFFFFF;
        --surface-hover: #FFFFFF;
        --input-bg: #FFFFFF;
        --title: #183C2C;
        --text: #42564A;
        --muted: #78857D;
        --border: #D5DED7;
        --green: #2F6B4F;
        --green-dark: #1F513A;
        --green-light: #E3EFE7;
        --gold: #C99B4A;
        --gold-light: #F7EFDD;
        --shadow: 0 8px 24px rgba(31, 81, 58, 0.07);
        display: block;
        min-height: calc(100vh - 64px);
        background-color: var(--bg);
        color: var(--text);
        padding-bottom: 2rem;
        transition: background-color 250ms ease, color 250ms ease;
    }

    .dark .attendance-page {
        --bg: transparent;
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
        --shadow: 0 12px 30px rgba(0, 0, 0, 0.20);
    }

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
    .attendance-page .shadow-lg {
        box-shadow: none !important;
    }

    .attendance-page .border-gray-100,
    .attendance-page .border-gray-200,
    .attendance-page .border-gray-300,
    .attendance-page .dark\:border-gray-700,
    .attendance-page .dark\:border-gray-600 {
        border-color: var(--border) !important;
    }

    .attendance-page table {
        background-color: var(--surface) !important;
        color: var(--text) !important;
    }

    .attendance-page table thead,
    .attendance-page table thead th {
        background-color: var(--surface-soft) !important;
        color: var(--muted) !important;
        border-color: var(--border) !important;
        font-weight: 600;
    }

    .attendance-page table td {
        color: var(--text) !important;
        border-color: var(--border) !important;
    }

    .attendance-page table tbody tr {
        background-color: var(--surface) !important;
        transition: background-color 0.18s ease;
    }

    .attendance-page table tbody tr:hover {
        background-color: var(--surface-hover) !important;
    }

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
    .attendance-page textarea::placeholder {
        color: var(--muted) !important;
        opacity: 1;
    }

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

    .attendance-page .bg-blue-500,
    .attendance-page .bg-blue-600,
    .attendance-page .bg-blue-700 {
        background-color: var(--green) !important;
        border-color: var(--green) !important;
        color: #FFFFFF !important;
    }

    .attendance-page .hover\:bg-blue-600:hover,
    .attendance-page .hover\:bg-blue-700:hover {
        background-color: var(--green-dark) !important;
        border-color: var(--green-dark) !important;
    }

    .attendance-page .text-blue-500,
    .attendance-page .text-blue-600,
    .attendance-page .text-blue-700 {
        color: var(--green) !important;
    }

    .attendance-page nav {
        color: var(--muted) !important;
    }

    .attendance-page nav a,
    .attendance-page nav span {
        color: var(--text) !important;
    }

    .attendance-page button,
    .attendance-page a {
        transition:
            background-color 0.18s ease,
            border-color 0.18s ease,
            color 0.18s ease,
            box-shadow 0.18s ease,
            transform 0.18s ease;
    }

    .attendance-page .max-w-7xl > * {
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        padding: 1.5rem !important;
    }

    .attendance-page .max-w-7xl > * > *:first-child {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
        padding: 0 !important;
        border-radius: 0 !important;
    }

    .attendance-page .max-w-7xl > * > * > *:first-child {
        margin-bottom: 1.5rem !important;
        display: flex;
        align-items: center;
    }

    .attendance-page .max-w-7xl button,
    .attendance-page .max-w-7xl select,
    .attendance-page .max-w-7xl input {
        background-color: var(--green-light) !important;
        color: var(--green-dark) !important;
        border: 1px solid transparent !important;
        border-radius: 12px !important;
        font-weight: 600;
    }

    .dark .attendance-page .max-w-7xl button,
    .dark .attendance-page .max-w-7xl select,
    .dark .attendance-page .max-w-7xl input {
        color: var(--green) !important;
    }

    .attendance-page .max-w-7xl button:hover {
        background-color: var(--surface-soft) !important;
        border-color: rgba(47, 107, 79, 0.20) !important;
        transform: translateY(-1px);
    }

    .attendance-page .max-w-7xl button {
        min-height: 42px;
    }

    .attendance-page .max-w-7xl svg {
        color: var(--green) !important;
    }

    .attendance-page .max-w-7xl .border {
        border: 1px solid rgba(47, 107, 79, 0.18) !important;
        border-radius: 16px !important;
        background-color: var(--surface) !important;
        overflow: hidden;
        box-shadow: 0 5px 16px rgba(31, 81, 58, 0.045) !important;
        transition:
            transform 0.18s ease,
            box-shadow 0.18s ease,
            border-color 0.18s ease;
    }

    .attendance-page .max-w-7xl .border:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 22px rgba(31, 81, 58, 0.08) !important;
        border-color: rgba(47, 107, 79, 0.28) !important;
    }

    .dark .attendance-page .max-w-7xl .border {
        border-color: rgba(118, 181, 143, 0.25) !important;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15) !important;
    }

    .attendance-page .max-w-7xl .border-b {
        background-color: var(--surface-soft) !important;
        border-color: rgba(47, 107, 79, 0.14) !important;
        color: var(--title) !important;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .attendance-page .max-w-7xl .border-b .font-semibold,
    .attendance-page .max-w-7xl .border-b .font-bold {
        color: var(--title) !important;
    }

    .attendance-page .max-w-7xl .border-b span {
        color: var(--green-dark) !important;
    }

    .dark .attendance-page .max-w-7xl .border-b span {
        color: var(--green) !important;
    }

    .attendance-page .max-w-7xl .border > *:not(.border-b) {
        color: var(--text);
    }

    .attendance-page .max-w-7xl .border .font-medium,
    .attendance-page .max-w-7xl .border .font-semibold {
        color: var(--title) !important;
    }

    .attendance-page .max-w-7xl .border p,
    .attendance-page .max-w-7xl .border span {
        color: var(--text);
    }

    .attendance-page .max-w-7xl .border svg {
        color: var(--green) !important;
        transition: transform 0.18s ease, color 0.18s ease;
    }

    .attendance-page .max-w-7xl .border .text-sm {
        line-height: 1.45;
    }

    @media (max-width: 1100px) {
        .attendance-page .max-w-7xl .border {
            border-radius: 14px !important;
        }
    }

    @media (max-width: 900px) {
        .attendance-page .max-w-7xl {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }

    @media (max-width: 640px) {
        .attendance-page .max-w-7xl > * {
            padding: 1rem !important;
        }

        .attendance-page .max-w-7xl .border {
            border-radius: 14px !important;
        }
    }

</style>