<style>
 
    /* =========================================================
       SIAPAE - TEMA DO MENU (verde APAE + creme + dourado)
       Para mudar as cores do menu, mexa só nas variáveis abaixo.
       ========================================================= */
 
    :root {
        --sp-sidebar: #FFFDF9;
        --sp-border: #E4E8E2;
        --sp-section: #7A867E;
 
        --sp-nav-text: #3E4C43;
        --sp-nav-icon: #7B887F;
 
        --sp-hover-bg: #E9F0EA;
        --sp-hover-text: #23543E;
 
        --sp-active-bg: #DCEBDF;
        --sp-active-text: #1B4632;
        --sp-active-icon: #2F6B4F;
        --sp-active-bar: #2F6B4F;
    }
 
    .dark {
        --sp-sidebar: #12231B;
        --sp-border: #22392D;
        --sp-section: #7F9A88;
 
        --sp-nav-text: #C9D8CE;
        --sp-nav-icon: #8FA898;
 
        --sp-hover-bg: rgba(255, 255, 255, 0.09);
        --sp-hover-text: #FFFFFF;
 
        --sp-active-bg: rgba(47, 107, 79, 0.55);
        --sp-active-text: #FFFFFF;
        --sp-active-icon: #D5A85A;
        --sp-active-bar: #D5A85A;
    }
 
    .sp-link {
        color: var(--sp-nav-text);
        font-weight: 500;
        transition: background-color 150ms ease, color 150ms ease;
    }
 
    .sp-link svg {
        color: var(--sp-nav-icon);
        transition: color 150ms ease;
    }
 
    .sp-link:hover {
        background-color: var(--sp-hover-bg);
        color: var(--sp-hover-text);
    }
 
    .sp-link:hover svg {
        color: var(--sp-active-icon);
    }
 
    .sp-link.is-active,
    .sp-link.is-active:hover {
        background-color: var(--sp-active-bg);
        color: var(--sp-active-text);
        font-weight: 600;
    }
 
    .sp-link.is-active svg {
        color: var(--sp-active-icon);
    }
 
    .sp-link.is-active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        width: 3px;
        height: 20px;
        border-radius: 0 4px 4px 0;
        background-color: var(--sp-active-bar);
        transform: translateY(-50%);
    }
 
</style>
 
<x-sidebar.overlay />
 
<aside
    class="fixed inset-y-0 z-40 flex flex-col py-4 space-y-6 shadow-sm border-r"
    style="background-color: var(--sp-sidebar); border-color: var(--sp-border); transition-property: width, transform; transition-duration: 150ms;"
    :class="{
        'translate-x-0 w-64': isSidebarOpen || isSidebarHovered,
        '-translate-x-full w-64 md:w-16 md:translate-x-0': !isSidebarOpen && !isSidebarHovered,
    }"
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
 
