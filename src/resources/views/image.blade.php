<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cropper Image</title>
    @vite('resources/js/app.js')
    <style>
        /* Размер контейнера */
        #image {
            display: block;
            width: 500px;
            height: 600px;
            max-width: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            justify-items: center;
        }
        #output {
            margin: 0 5px;
            display: block;
            width: 500px;
            height: 600px;
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <div>
        <img src="{{ asset('images/image.png') }}" id="image">
        <button id="cropImageBtn">Crop Image</button>
    </div>

    <img src="" id="output">

</div>

</body>
</html>
