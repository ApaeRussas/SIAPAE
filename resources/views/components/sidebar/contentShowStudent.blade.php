
<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-3 px-3 z-20"
>

    <!-- Dashboard -->
    <x-sidebar.link title="{{__('Back')}}" href="{{ route('student.index') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-heroicon-o-login class="w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <!-- Transition - ALUNOS -->

    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-700 dark:text-gray-300">
        {{__('Student Data' . ($element->state_student == 'archived' ? ' Archived' : '')) }}
    </div>

    <x-sidebar.link title="{{__('Base Informations')}}" href="{{route('student.show', $element->id)}}"
        :isActive="request()->routeIs('student.index', 'student.create', 'student.edit', 'student.show')">
        <x-slot name="icon">
            <x-icons.person class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="{{__('Anamnesis')}}" href="{{route('student.showMedhistory', $element->id)}}"
        :isActive="request()->routeIs('student.showMedhistory', 'anamnesis.edit')">
        <x-slot name="icon">
            <x-icons.anamnesis class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
