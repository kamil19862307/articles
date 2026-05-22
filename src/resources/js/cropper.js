import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.querySelectorAll('.cropper-field').forEach((field) => {

    const image = field.querySelector('.cropper-image');
    const cropBtn = field.querySelector('.cropper-button');
    const output = field.querySelector('.cropper-output');
    const fileInput = field.querySelector('.cropper-input');

    let cropper = null;

    // Загрузка изображения
    fileInput.addEventListener('change', (e) => {

        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = (event) => {

            image.src = event.target.result;

            // Уничтожаем старый cropper
            if (cropper) {
                cropper.destroy();
            }

            // Создаём новый cropper
            cropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 0,
            });
        };

        reader.readAsDataURL(file);
    });

    // Crop button
    cropBtn.addEventListener('click', () => {

        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500,
        });

        // Показываем preview
        output.src = canvas.toDataURL('image/png');

        // Создаём Blob
        canvas.toBlob((blob) => {

            // Создаём новый File
            const croppedFile = new File(
                [blob],
                'cropped-image.png',
                {
                    type: 'image/png',
                    lastModified: Date.now(),
                }
            );

            // Создаём DataTransfer
            const dataTransfer = new DataTransfer();

            // Добавляем новый файл
            dataTransfer.items.add(croppedFile);

            // Подменяем files у input
            fileInput.files = dataTransfer.files;

            console.log('Cropped file inserted into input');

        }, 'image/png');
    });

});
