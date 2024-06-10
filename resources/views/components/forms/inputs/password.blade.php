@props([
    'label' => null,
    'class' => null,
    'modal' => "form.password",
    'placeholder' => null,
])

<div class="mb-4 position-relative" x-data="{ passwordVisible: false, showEyeButton: false, password: '' }">
    <label class="form-label" for="password">{{ $label }}</label>
    <input
        wire:model.blur="{{ $modal }}"
        x-model="password"
        x-bind:type="passwordVisible ? 'text' : 'password'"
        @input="showEyeButton = password.length > 0"
        class="form-control {{ $class }}"
        id="password"
        name="password"
        placeholder="{{ $placeholder }}"
    >
    <button
        x-show="showEyeButton"
        @click="passwordVisible = !passwordVisible"
        type="button"
        class="text-secondary bg-transparent border-0 position-absolute"
        :style="{top: '36px', right: '1.5%'}"
    >
        <i x-bind:class="passwordVisible ? 'fa fa-eye-slash' : 'fa fa-eye'"></i>
    </button>
    <x-forms.errors.input-message :error="$modal" />
</div>
