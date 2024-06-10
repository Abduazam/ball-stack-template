@php
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Pagination\LengthAwarePaginator;
@endphp

@props([
    'currentPage' => 0,
    'perPage' => 0,
    'total' => 0,
    'from' => 0,
    'to' => 0,
    'data',
])

@php
    if ($data instanceof LengthAwarePaginator) {
        $currentPage = $data->currentPage();
        $perPage = $data->perPage();
        $total = $data->total();
    }

    if ($data instanceof Collection) {
        $total = $data->count();
    }

    $from = $total > 0 ? ($currentPage - 1) * $perPage + 1 : 0;
    $to = min($currentPage * $perPage, $total);
@endphp

<div class="row justify-content-sm-between align-items-center mb-3 w-100 mx-0 px-0">
    <div class="col-sm-6 col-12 ps-sm-0 mb-sm-0 mb-3 text-sm-start text-center">
        <small>{{ trans('fields.filters.showing') }} {{ $from }}-{{ $to }} {{ trans('fields.filters.from') }} {{ $total }} {{ trans('fields.filters.data') }}</small>
    </div>
    @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="col-sm-6 col-12 d-flex justify-content-sm-end justify-content-center pe-sm-0">
            {{ $data->links('components/partials/paginations/bootstrap') }}
        </div>
    @endif
</div>
