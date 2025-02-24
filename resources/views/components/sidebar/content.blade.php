<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-3 px-3 z-20">
    <!-- Dashboard -->
    <x-sidebar.link title="Home" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <!-- Transition - ALUNOS -->
     
    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-700 dark:text-gray-300">
        {{__('Students')}}
    </div>

    <x-sidebar.link title="{{__('Anamnesis')}}" href="{{route('anamnesis.index')}}"
        :isActive="request()->routeIs('anamnesis.index', 'anamnesis.create', 'anamnesis.edit', 'anamnesis.show')">
        <x-slot name="icon">
            <x-icons.anamnesis class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="{{__('Student File')}}" href="{{route('student.index')}}"
        :isActive="request()->routeIs('student.index', 'student.create', 'student.edit', 'student.show')">
        <x-slot name="icon">
            <x-icons.person class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="{{__('Frequency List')}}" href="{{route('frequency.index')}}"
        :isActive="request()->routeIs('frequency.index')">
        <x-slot name="icon">
            <x-icons.frequency class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link title="{{__('Attendance Register')}}" href="{{route('attendance.index')}}"
        :isActive="request()->routeIs('attendance.index', 'attendance.create', 'attendance.edit', 'attendance.show')">
        <x-slot name="icon">
            <x-icons.register class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="{{ __('Reports') }}" :active="Str::startsWith(request()->route()->uri(), ['educational', 'regional'])">
        <x-slot name="icon">
            <x-icons.report class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="{{__('Pedagogic')}}" href="{{route('educational.index')}}"
            :active="request()->routeIs('educational.index', 'educational.create', 'educational.edit', 'educational.show')" />

        <x-sidebar.sublink title="{{__('Regional')}}" href="{{route('regional.index')}}"
            :active="request()->routeIs('regional.index', 'regional.create', 'regional.edit', 'regional.show')" />
    </x-sidebar.dropdown>

    <x-sidebar.link title="{{__('SCFV')}}" href="{{route('scfv.index')}}" 
        :isActive="request()->routeIs('scfv.index', 'scfv.create', 'scfv.edit', 'scfv.show')">
        <x-slot name="icon">
            <x-icons.scfv class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <!-- Transition - REUNIÕES -->

    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-700 dark:text-gray-300">
        {{__('Events')}}
    </div>

    <x-sidebar.link title="{{__('Reunions Records')}}" href="{{route('record.index')}}"
        :isActive="request()->routeIs('record.index', 'record.create', 'record.edit')">
        <x-slot name="icon">
            <x-icons.meeting class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>


    <!-- Transition - ADMIN -->

    @can('admin-view')

        <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-700 dark:text-gray-300">
            {{__('Admin')}}
        </div>

        <x-sidebar.link title="{{ __('Donation Control')}}" href="{{route('donation.index')}}"
            :isActive="request()->routeIs('donation.index')">
            <x-slot name="icon">
                <x-icons.partner class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>

        <x-sidebar.link title="{{__('Expense Control')}}" href="{{route('expense.index')}}"
            :isActive="request()->routeIs('expense.index', 'expense.create', 'expense.edit', 'expense.show')">
            <x-slot name="icon">
                <x-icons.expense class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>

    @endcan

</x-perfect-scrollbar>