<style>
    .cropper-field {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 900px;
    }

    .cropper-workspace {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .cropper-container-box {
        width: 500px;
    }

    .cropper-image {
        width: 500px;
        height: 500px;
        display: block;
    }

    .cropper-output {
        width: 500px;
        height: 500px;
        border: 1px solid #ccc;
    }
</style>

<div class="cropper-field">

    <input
        type="file"
        name="{{ $column }}"
        class="cropper-input bgc-success"
        accept="image/*"
    >

    <div class="cropper-workspace">

        <div class="cropper-container-box">
            <img class="cropper-image">
        </div>

        @if($value)
            <img
                src="{{ Storage::url($value) }}"
                class="cropper-output"
            >
        @endif

    </div>

    <button
        type="button"
        class="cropper-button bgc-success"
    >
        Обрезать изображение
    </button>

</div>

@vite('resources/js/cropper.js')
