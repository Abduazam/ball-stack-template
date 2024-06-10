@props(['error' => null])

@error($error)
<span class="invalid-feedback d-block">{!! $message !!}</span>
@enderror
