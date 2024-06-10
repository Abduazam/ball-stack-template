@props([
    'active' => false,
    'icon' => null,
    'url' => null,
])

@can($url)
<li class="nav-main-item">
    <a class="nav-main-link @if($active) active @endif" href="{{ route($url) }}">
        <i class="nav-main-link-icon {{ $icon }}"></i>
        <span class="nav-main-link-name">{{ $slot }}</span>
    </a>
</li>
@endcan
