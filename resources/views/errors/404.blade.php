@section('title', __('Not Found')) 
<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight m-bottom">
            ERROR 404
        </h2>
    </x-slot>

    <div class="h-error center">
        <div class="text-center padding p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="style-error">
                {{ __('Not Found!') }}
            </div>
        </div>
    </div>

</x-app-layout>