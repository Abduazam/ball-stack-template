@props(['name', 'label' => null, 'inline' => false])

<div class="form-check @if($inline) form-check-inline @endif">
    <input {{ $attributes->merge(['class' => "form-check-input"]) }} type="checkbox" value="{{ true }}" id="{{ $name }}" name="{{ $name }}">
    @if($label)
        <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    @endif
</div>
