<html>
<head>
    <title>Test Page</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('styles/test.css') }}">
</head>

<body>

    <h1>INI HALAMAN TEST</h1>

    <img src="{{ asset('images/Image 1.jpg') }}" width="200">
    <img src="{{ asset('images/Image 2.jpg') }}" width="200">


    <div class="bg-blue-500 p-4 m-4 rounded-lg text-blue">
        Ini pakai Tailwind
    </div>
</body>
</html>