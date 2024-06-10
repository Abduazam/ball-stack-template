<x-layouts.components.head />

    <x-partials.flashes.success />
    <x-partials.flashes.error />

    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-modern main-content-boxed side-trans-enabled"><div id="page-overlay"></div>
        <x-layouts.components.nav />

        <x-layouts.components.header />

        <main id="main-container">
            {{ $slot }}
        </main>

        <x-layouts.components.footer />
    </div>

<x-layouts.components.foot />
