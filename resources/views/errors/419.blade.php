@section('title', __('Page Expired'))
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl padding leading-tight m-bottom">
            ERROR 419
        </h2>
    </x-slot>

    <div class="h-error center">
        <div class="text-center padding p-error overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="style-error">
                {{ __('Page Expired!') }}
            </div>
        </div>
    </div>

</x-app-layout>