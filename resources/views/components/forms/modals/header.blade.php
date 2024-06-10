@props(['title' => null])

<div class="block-header block-header-default">
    <h3 class="block-title fs-sm mt-1">{{ $title }}</h3>
    <div class="block-options">
        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>
