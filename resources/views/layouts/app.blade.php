@props(['context', 'notRegularSidebar' => null, 'element' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title> @yield('title', config('app.name', 'Laravel')) </title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    
    <link rel="stylesheet" href=" {{ asset('css/etc.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" id="flatpickr-light">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css" id="flatpickr-dark" disabled>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/tom-select.js') }}" defer></script>
    <script src="{{ asset('js/alerts.js') }}" defer></script>
</head>
<body 
    class="font-sans antialiased" 
    :class="{ 'sidebar-open': isSidebarOpen }">

    <!-- Carregar jQuery antes de qualquer outro script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <div
        x-data="mainState"
        :class="{ dark: isDarkMode }"
        x-on:resize.window="handleWindowResize"
        x-cloak
    >
        <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200 transition duration-200 ease-in-out">
            <!-- Overlay para mobile -->
            <div
                x-show="isSidebarOpen && window.innerWidth < 1024"
                class="fixed inset-0 bg-black bg-opacity-50 z-30"
                x-on:click="toggleSidebar"
            ></div>
            
            <!-- Sidebar -->
            <x-sidebar.sidebar class="overflow-auto" :notRegularSidebar="(isset($notRegularSidebar) && isset($element)) ? true : null" :element="(isset($notRegularSidebar) && isset($element)) ? $element : null" />
            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen"
                 :class="{ 'lg:ml-64': isSidebarOpen, 'md:ml-16': !isSidebarOpen}"
                 style="transition-property: margin; transition-duration: 150ms;"
                 >

                <!-- Navbar -->
                <x-navbar />

                <!-- Page Heading -->
                <header>
                    <div class="p-3 sm:p-6">
                        {{ $header ?? ''}}
                    </div>
                </header>

                <!-- Page Content -->
                <main class="px-4 sm:px-6 flex-1">
                    {{ $slot }}
                </main>

                <!-- Page Footer -->
                <x-footer />
            </div>
        </div>
    </div>

    <!-- Pop-up para avisar o usuário na tabela se tem dados novos -->

    <div 
        x-data="{
            type: '',
            context: '{{ $context ?? ''}}'
        }"
        x-init="
            Echo.channel('crud-channel')
                .listen('.crud-event', (e) => {

                    // Só processa se for da tabela atual
                    if (e.context === context) {

                    showBroadcastToastr('info', 'Dados foram atualizados nessa tabela.');

                    /* Alerts separados, mas comentados por coveniência de ter apenas um único
                    type = e.type;
                    switch (e.type) {
                        case 'created':
                            showBroadcastToastr('success', 'Novo registro adicionado!');
                            break;
                        case 'updated':
                            showBroadcastToastr('info', 'Um registro foi atualizado!');
                            break;
                        case 'archived':
                            showBroadcastToastr('warning', 'Um Registro foi arquivado!');
                            break;
                        case 'deleted':
                            showBroadcastToastr('warning', 'Um Registro foi deletado!');
                            break;
                        case 'restored':
                            showBroadcastToastr('info', 'Um registro foi restaurado!');
                            break;
                    }
                    */
                    };
                });
        "
    >
    </div>

    <!-- Pop-up com o toastr -->
     
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script>
        // Configuração do Toastr (deve vir DEPOIS da aplicação do tema)
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

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('pdf_error'))
            window.close();
        @endif

        const BROADCAST_TOAST_DELAY = 50000; 
        if (!window.lastToastrTimestamp) {
            window.lastToastrTimestamp = 0;
        }

        function showBroadcastToastr(type, message) {
            const now = Date.now();
            const timeSinceLast = now - window.lastToastrTimestamp;

            if (timeSinceLast >= BROADCAST_TOAST_DELAY) {
                window.lastToastrTimestamp = now;

                // Time out para evitar de aparecer na tela do usuário 
                setTimeout(() => {
                    if (type === 'success') toastr.success(message);
                    else if (type === 'error') toastr.error(message);
                    else if (type === 'info') toastr.info(message);
                    else if (type === 'warning') toastr.warning(message);
                }, 500);
            }
        }
    </script>
</body>
</html>