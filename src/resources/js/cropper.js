import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

document.querySelectorAll('.cropper-field').forEach((field) => {

    const image = field.querySelector('.cropper-image');
    const cropBtn = field.querySelector('.cropper-button');
    const output = field.querySelector('.cropper-output');
    const fileInput = field.querySelector('.cropper-input');

    let cropper = null;
    let croppedBlob = null;

    // Загрузка изображения
    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = (event) => {
            image.src = event.target.result;

            // Удаляем старый cropper
            if (cropper) {
                cropper.destroy();
            }

            // Создаём новый
            cropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 0,
            });
        };

        reader.readAsDataURL(file);
    });

    // Обрезка изображения
    cropBtn.addEventListener('click', () => {

        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 500,
            height: 500,
        });

        // Preview
        output.src = canvas.toDataURL('image/png');

        // Blob для будущей отправки
        canvas.toBlob((blob) => {
            croppedBlob = blob;
        }, 'image/png');
    });

    // Пока просто debug
    console.log('Cropper field initialized', field);

});
