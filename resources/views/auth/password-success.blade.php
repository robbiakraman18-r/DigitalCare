<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .pop {
            animation: pop 0.4s ease-out forwards;
            transform: scale(0);
        }

        @keyframes pop {
            to { transform: scale(1); }
        }

        .circle {
            stroke-dasharray: 300;
            stroke-dashoffset: 300;
            animation: draw 0.8s ease-out forwards 0.3s;
        }

        @keyframes draw {
            to { stroke-dashoffset: 0; }
        }

        .fade {
            opacity: 0;
            animation: fade 0.5s ease-out forwards 0.8s;
        }

        @keyframes fade {
            to { opacity: 1; }
        }
    </style>
</head>

<body class="bg-white flex items-center justify-center h-screen">

<div class="text-center space-y-6">

    <!-- ANIMATION -->
    <div class="pop flex justify-center">

        <div class="w-28 h-28 rounded-full bg-green-100 flex items-center justify-center shadow-lg">

            <svg width="80" height="80" viewBox="0 0 24 24" fill="none">
                <path
                    class="circle"
                    d="M20 6L9 17l-5-5"
                    stroke="#22c55e"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </div>

    </div>

    <!-- TEXT -->
    <div class="fade">
        <h1 class="text-3xl font-bold text-slate-800">
            Password Berhasil Diubah
        </h1>

        <p class="text-slate-500 mt-2">
            Anda akan diarahkan ke login...
        </p>
    </div>

</div>

<script>
    setTimeout(() => {
        window.location.href = "/login";
    }, 2500);
</script>

</body>
</html>