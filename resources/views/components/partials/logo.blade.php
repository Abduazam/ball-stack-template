@php
    $logoData = explode(' ', config('app.name'));
    $prefix = $logoData[0] ?? '';
    $suffix = $logoData[1] ?? '';
@endphp

<!-- Logo -->
<a class="link-fx fw-semibold fs-5" href="/dashboard">
    <span class="text-dark">{{ $prefix }}</span><span class="text-primary">{{ $suffix }}</span>
</a>
