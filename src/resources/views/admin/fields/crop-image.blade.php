<div x-data="cropField({
    ratio: {{ $aspectRatio }}
})">
    <!-- Скрытый инпут для передачи данных в Laravel -->
    <input
        type="file"
        name="{{ $column }}"
        id="input_{{ $column }}"
        @change="handleFile"
        accept="image/*"
    >

    <div class="mt-4" x-show="showCropper" style="max-width: 500px;">
        <img id="cropper_img_{{ $column }}" style="display: block; max-width: 100%;">
        <button
            type="button"
            class="btn btn-primary mt-2"
            @click.prevent="crop"
        >
            Обрезать
        </button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cropField', (config) => ({
            showCropper: false,
            cropper: null,

            handleFile(e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (event) => {
                    const img = document.getElementById('cropper_img_{{ $column }}');
                    img.src = event.target.result;
                    this.showCropper = true;

                    if (this.cropper) this.cropper.destroy();

                    // Ждем пока картинка загрузится и инициализируем Cropper
                    setTimeout(() => {
                        this.cropper = new Cropper(img, {
                            aspectRatio: config.ratio,
                            viewMode: 1,
                        });
                    }, 100);
                };
                reader.readAsDataURL(file);
            },

            crop() {
                const canvas = this.cropper.getCroppedCanvas();
                canvas.toBlob((blob) => {
                    const file = new File([blob], 'cropped.png', { type: 'image/png' });
                    const container = new DataTransfer();
                    container.items.add(file);

                    // Заменяем файл в инпуте на обрезанный
                    document.getElementById('input_{{ $column }}').files = container.files;
                    alert('Готово! Теперь можно сохранять форму.');
                });
            }
        }));
    });

</script>
