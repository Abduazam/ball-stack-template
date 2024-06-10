@php
    $user = auth()->user();
@endphp

<nav id="sidebar">
    <div class="sidebar-content">
        <div class="content-header justify-content-lg-center">
            <div>
                <x-partials.logo />
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout" data-action="sidebar_close">
                    <i class="si si-close"></i>
                </button>
            </div>
        </div>

        <div class="js-sidebar-scroll simplebar-scrollable-y" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="content-side content-side-user px-0 py-0">
                                    <div class="smini-visible-block animated fadeIn px-2">
                                        <x-partials.avatar-image class="img-avatar32" />
                                    </div>
                                    <div class="smini-hidden text-center mx-auto">
                                        <a class="img-link" href="/dashboard">
                                            @if($user->image)
                                                <img class="img-avatar" src="/{{ $user->image->path }}" alt="{{ $user->name }} image">
                                            @else
                                                <x-partials.avatar-image />
                                            @endif
                                        </a>
                                        <ul class="list-inline mt-3 mb-0">
                                            <li class="list-inline-item">
                                                <a class="link-fx text-dual fs-sm fw-semibold text-uppercase" href="/dashboard">{{ $user->name }}</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="link-fx text-dual" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="si si-logout"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content-side content-side-full">
                                    <x-layouts.components.nav-list />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
