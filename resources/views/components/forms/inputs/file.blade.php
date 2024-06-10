<div
    x-data="{ uploading: false, progress: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-cancel="uploading = false"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <!-- File Input -->
    <input {{ $attributes }}>

    <!-- Progress Bar -->
    <div x-show="uploading" class="progress push mt-2" style="height: 8px;" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar" x-bind:style="`width: ${progress}%;`"></div>
    </div>
</div>
