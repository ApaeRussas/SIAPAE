```blade
<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">

            <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2 text-[#102A43]">
                {{ __('Reg. de Atendimento') }}
            </h2>

        </div>
    </x-slot>


    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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