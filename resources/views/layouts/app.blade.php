@props([
    'context',
    'notRegularSidebar' => null,
    'element' => null
])

@php
    /*
    |--------------------------------------------------------------------------
    | PERFIL DO ESTUDANTE
    |--------------------------------------------------------------------------
    |
    | No perfil individual do estudante queremos uma experiência própria,
    | sem sidebar lateral e sem deixar o espaço reservado para ela.
    |
    */
    $isStudentProfile = request()->routeIs('student.show');
@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name', 'Laravel'))
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet"
    >


    <!-- Fonts -->

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet"
    />


    <!-- Styles -->

    <style>

        [x-cloak] {
            display: none;
        }


        /* =========================================================
           FUNDO GERAL DO SISTEMA
           ========================================================= */

        .siapae-system-bg {
            background-color: #E8F0EA;
        }


        .dark .siapae-system-bg {
            background-color: #0B1712;
        }


        /* =========================================================
           PERFIL DO ESTUDANTE
           
           O perfil individual ocupa toda a largura da janela,
           sem o espaço lateral reservado para a sidebar.
           ========================================================= */

        .student-profile-page-wrapper {
            margin-left: 0 !important;
            width: 100% !important;
        }

    </style>


    <link
        rel="stylesheet"
        href="{{ asset('css/etc.css') }}"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"
    >

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
        id="flatpickr-light"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css"
        id="flatpickr-dark"
        disabled
    >


    <!-- Scripts -->

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"
        defer
    ></script>


    <script
        src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"
        defer
    ></script>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script
        src="{{ asset('js/script.js') }}"
        defer
    ></script>


    <script
        src="{{ asset('js/tom-select.js') }}"
        defer
    ></script>


    <script
        src="{{ asset('js/alerts.js') }}"
        defer
    ></script>

</head>


<body
    class="font-sans antialiased"
    :class="{ 'sidebar-open': isSidebarOpen }"
>


    <!-- Carregar jQuery antes de qualquer outro script -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div
        x-data="mainState"
        :class="{ dark: isDarkMode }"
        x-on:resize.window="handleWindowResize"
        x-cloak
    >

        <div
            class="min-h-screen siapae-system-bg text-gray-900 dark:text-gray-200 transition duration-200 ease-in-out"
        >


            <!-- =====================================================
                 OVERLAY PARA MOBILE
                 ===================================================== -->

            @if (!$isStudentProfile)

                <div
                    x-show="isSidebarOpen && window.innerWidth < 1024"
                    class="fixed inset-0 bg-black bg-opacity-50 z-30"
                    x-on:click="toggleSidebar"
                ></div>

            @endif


            <!-- =====================================================
                 SIDEBAR
                 
                 No perfil individual ela não é exibida.
                 ===================================================== -->

            <x-sidebar.sidebar
                class="overflow-auto"
                :notRegularSidebar="(
                    isset($notRegularSidebar) &&
                    isset($element)
                ) ? true : null"
                :element="(
                    isset($notRegularSidebar) &&
                    isset($element)
                ) ? $element : null"
            />


            <!-- =====================================================
                 PAGE WRAPPER
                 
                 Páginas normais:
                    mantém a margem da sidebar.
                 
                 Perfil do estudante:
                    ocupa toda a largura.
                 ===================================================== -->

            <div
                @if ($isStudentProfile)
                    class="flex flex-col min-h-screen student-profile-page-wrapper"
                @else
                    class="flex flex-col min-h-screen"
                    :class="{
                        'lg:ml-64': isSidebarOpen,
                        'md:ml-16': !isSidebarOpen
                    }"
                @endif
                style="transition-property: margin; transition-duration: 150ms;"
            >


                <!-- =================================================
                     NAVBAR
                     ================================================= -->

                <x-navbar />


                <!-- =================================================
                     PAGE HEADING
                     ================================================= -->

                <header>

                    <div class="p-3 sm:p-6">

                        {{ $header ?? '' }}

                    </div>

                </header>


                <!-- =================================================
                     PAGE CONTENT
                     ================================================= -->

                <main class="px-4 sm:px-6 flex-1">

                    {{ $slot }}

                </main>


                <!-- =================================================
                     PAGE FOOTER
                     ================================================= -->

                <x-footer />

            </div>

        </div>

    </div>


    <!-- =============================================================
         POP-UP PARA AVISAR O USUÁRIO NA TABELA
         ============================================================= -->

    <div
        x-data="{
            type: '',
            context: '{{ $context ?? '' }}'
        }"
        x-init="
            Echo.channel('crud-channel')
                .listen('.crud-event', (e) => {

                    // Só processa se for da tabela atual
                    if (e.context === context) {

                        showBroadcastToastr(
                            'info',
                            'Dados foram atualizados nessa tabela.'
                        );

                    };

                });
        "
    >
    </div>


    <!-- =============================================================
         POP-UP COM O TOASTR
         ============================================================= -->

    <script
        src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"
        defer
    ></script>


    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    ></script>


    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        rel="stylesheet"
    >


    <script>

        // =========================================================
        // CONFIGURAÇÃO DO TOASTR
        // =========================================================

        toastr.options = {

            "closeButton": true,

            "progressBar": true,

            "positionClass": "toast-bottom-left",

            "showDuration": "300",

            "hideDuration": "1000",

            "timeOut": "5000",

            "extendedTimeOut": "1000",

            "showEasing": "swing",

            "hideEasing": "linear",

            "showMethod": "fadeIn",

            "hideMethod": "fadeOut",

            "tapToDismiss": false

        };


        @if (session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if (session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if (session('warning'))
            toastr.warning(@json(session('warning')));
        @endif

        @if (session('info'))
            toastr.info(@json(session('info')));
        @endif


        @if(Session::has('pdf_error'))

            window.close();

        @endif


        const BROADCAST_TOAST_DELAY = 50000;


        if (!window.lastToastrTimestamp) {

            window.lastToastrTimestamp = 0;

        }


        function showBroadcastToastr(
            type,
            message
        ) {

            const now = Date.now();


            const timeSinceLast =
                now - window.lastToastrTimestamp;


            if (
                timeSinceLast >=
                BROADCAST_TOAST_DELAY
            ) {

                window.lastToastrTimestamp = now;


                // Time out para evitar de aparecer na tela do usuário

                setTimeout(() => {

                    if (type === 'success') {

                        toastr.success(
                            message
                        );

                    } else if (type === 'error') {

                        toastr.error(
                            message
                        );

                    } else if (type === 'info') {

                        toastr.info(
                            message
                        );

                    } else if (type === 'warning') {

                        toastr.warning(
                            message
                        );

                    }

                }, 500);

            }

        }

    </script>

</body>

</html>
