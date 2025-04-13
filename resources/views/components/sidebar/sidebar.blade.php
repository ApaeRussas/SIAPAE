<x-sidebar.overlay />

<aside
    class="fixed inset-y-0 z-40 flex flex-col py-4 space-y-6 bg-white shadow-lg dark:bg-dark-eval-1"
    :class="{
        'translate-x-0 w-64': isSidebarOpen || isSidebarHovered,
        '-translate-x-full w-64 md:w-16 md:translate-x-0': !isSidebarOpen && !isSidebarHovered,
    }"
    style="transition-property: width, transform; transition-duration: 150ms;"
    x-on:mouseenter="handleSidebarHover(true)"
    x-on:mouseleave="handleSidebarHover(false)"
>
    <x-sidebar.header />

    @if (!isset($notRegularSidebar))
        <x-sidebar.content />
    @else
        <x-sidebar.contentShowStudent :element="$element"/>
    @endif

    <x-sidebar.footer />
</aside>
