<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* background fade */
        .fade-bg {
            animation: fadeBg 0.4s ease-out forwards;
        }

        @keyframes fadeBg {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* circle pop */
        .pop {
            transform: scale(0);
            animation: pop 0.5s ease-out forwards;
        }

        @keyframes pop {
            to { transform: scale(1); }
        }

        /* check draw */
        .check {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: draw 0.8s ease-out forwards 0.4s;
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* text fade */
        .fade {
            opacity: 0;
            transform: translateY(10px);
            animation: fade 0.5s ease-out forwards 0.8s;
        }

        @keyframes fade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center h-screen fade-bg">

<div class="text-center space-y-6">

    <!-- ICON -->
    <div class="flex justify-center">

        <div class="w-28 h-28 rounded-full bg-green-100 flex items-center justify-center pop shadow-lg">

            <svg class="w-16 h-16 text-green-500"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="3"
                 viewBox="0 0 24 24">

                <path class="check"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7" />

            </svg>

        </div>

    </div>

    <!-- TEXT -->
    <div class="fade">
        <h1 class="text-2xl font-bold text-slate-800">
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