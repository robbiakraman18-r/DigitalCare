<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>DoctorCare</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body
class="bg-gradient-to-br from-[#f4fbff] via-[#f8fdff] to-[#eef8ff] min-h-screen font-[Inter] flex overflow-x-hidden"
x-data="{ openProfile:false, logoutModal:false }">

    <!-- BLUR -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <div class="fixed bottom-0 right-0 w-80 h-80 bg-blue-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- SIDEBAR -->
    @include('components.sidebar-dokter')

    <!-- MAIN -->
    <div class="flex-1 ml-20">

        <!-- TOPBAR -->
        @include('components.topbar-dokter', [
    'title' => View::yieldContent('title'),
    'subtitle' => View::yieldContent('subtitle')
])

        <!-- CONTENT -->
        <main class="px-6 lg:px-10 pb-10">

            @yield('content')

        </main>

    </div>

    <!-- LOGOUT MODAL -->
    <div
    x-show="logoutModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
    style="display:none;">

        <div class="bg-white rounded-3xl p-8 w-full max-w-sm">

            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">

                <i data-lucide="log-out" class="text-red-500"></i>

            </div>

            <h2 class="text-2xl font-bold text-center mt-5">
                Logout?
            </h2>

            <p class="text-center text-slate-500 mt-2">
                Apakah Anda yakin ingin keluar?
            </p>

            <div class="grid grid-cols-2 gap-4 mt-8">

                <button
                @click="logoutModal = false"
                class="py-3 rounded-2xl border hover:bg-slate-50">

                    Batal

                </button>

                <a href="/login"
                class="py-3 rounded-2xl bg-red-500 text-white text-center hover:bg-red-600">

                    Logout

                </a>

            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>