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
        max-width: 100%;
        display: block;
    }

    .cropper-output {
        width: auto;
        border: 1px solid #ccc;
    }
</style>

<div class="cropper-field">

    <input
        type="file"
        class="cropper-input bgc-success"
        accept="image/*"
    >

    <div class="cropper-workspace">

        <div class="cropper-container-box">
            <img class="cropper-image">
        </div>

        <img class="cropper-output">

    </div>

    <button
        type="button"
        class="cropper-button bgc-success"
    >
        Обрезать изображение
    </button>

</div>

@vite('resources/js/cropper.js')
