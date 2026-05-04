import './bootstrap';

import Alpine from 'alpinejs'

// Обрезка изображения -------------------------------
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

const image = document.getElementById('image');
const cropBtn = document.getElementById('cropImageBtn');
const output = document.getElementById('output');

if (image) {
    const cropper = new Cropper(image, {
        aspectRatio: 0,
        viewMode: 0,
    });

    cropBtn.addEventListener('click', () => {
        // Получаем Canvas с обрезанным фото
        const canvas = cropper.getCroppedCanvas();
        // Превращаем в Base64 и выводим в наш пустой img
        output.src = canvas.toDataURL('image/png');
    });
}
// Обрезка изображения ---------------------------------


window.Alpine = Alpine

Alpine.start()
