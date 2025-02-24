<main class="flex flex-col justify-center items-center flex-1 px-4 pt-6">
    <div style="margin: -5px">
        <a href="/" class="flex flex-col items-center">
            <x-application-logo-light
            x-show="!isDarkMode" 
            class="h-logo-login" /> 
            <x-application-logo-dark 
            x-show="isDarkMode" 
            class="h-logo-login" />

            <h1 class="ml-2 display-1 text-xl">
                <strong class="dark:text-gray-300">{{$title ?? 'Login SIAPAE'}}</strong>
            </h1>
        </a>
    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md sm:max-w-md dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>