import './bootstrap';

import Alpine from 'alpinejs'

import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

const image = document.getElementById('image');
const cropBtn = document.getElementById('cropImageBtn');
const sendBtn = document.getElementById('sendImageBtn');
const output = document.getElementById('output');
const fileInput = document.getElementById('fileInput');

let cropper = null;
let croppedBlob = null;

// Загрузка изображения
fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = (event) => {
        image.src = event.target.result;

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(image, {
            aspectRatio: 0,
            viewMode: 1,
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

    // Показываем preview справа
    output.src = canvas.toDataURL('image/png');

    // Сохраняем blob для будущей отправки
    canvas.toBlob((blob) => {
        croppedBlob = blob;
    }, 'image/png');
});

// Отправка на сервер
sendBtn.addEventListener('click', async () => {
    if (!croppedBlob) {
        alert('Сначала обрежьте изображение');
        return;
    }

    const formData = new FormData();

    formData.append('image', croppedBlob, 'cropped.png');

    try {
        const response = await fetch('/image-upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            }
        });

        // Проверяем статус ответа
        if (!response.ok) {
            throw new Error(`Ошибка сервера: ${response.status}`);
        }

        const data = await response.json();

        console.log(data);

        alert('Изображение загружено');

    } catch (error) {
        console.error(error);

        alert(error.message);
    }
});

window.Alpine = Alpine
Alpine.start()
