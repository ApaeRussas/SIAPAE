@section('title', __('Service Unavailable'))
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight m-bottom">
            ERROR 503
        </h2>
    </x-slot>

    <div class="h-error center">
        <div class="text-center padding p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="style-error">
                {{ __('Service Unavailable!') }}
            </div>
        </div>
    </div>

</x-app-layout>
