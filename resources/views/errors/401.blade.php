@section('title', __('Unauthorized'))
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight m-bottom">
            ERROR 401
        </h2>
    </x-slot>

    <div class="h-error center">
        <div class="text-center p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 px-8 sm:px-14 py-3 sm:py-4">
            <div class="style-error text-3xl sm:text-6xl">
                {{ __('Unauthorized!') }}
            </div>
        </div>
    </div>

</x-app-layout>