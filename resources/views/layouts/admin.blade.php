<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>DoctorCare Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body
class="bg-gradient-to-br from-[#f4fbff] via-[#f8fdff] to-[#eef8ff] min-h-screen font-[Inter] overflow-x-hidden"
x-data="{
    openProfile:false,
    logoutModal:false
}">

    <!-- BLUR -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <div class="fixed bottom-0 right-0 w-80 h-80 bg-teal-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- SIDEBAR -->
    @include('components.sidebar-admin')

    <!-- MAIN -->
    <div class="flex-1 ml-20 transition-all duration-500">

        <!-- TOPBAR -->
       <x-topbar-admin
:title="View::yieldContent('title')"
:subtitle="View::yieldContent('subtitle')" />

        <!-- CONTENT -->
        <main class="px-5 lg:px-8 pb-8">

            <!-- WRAPPER -->
            <div class="max-w-7xl mx-auto">

                @yield('content')

            </div>

        </main>

    </div>

    <!-- LOGOUT MODAL -->
    <div
    x-show="logoutModal"
    x-transition
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
    style="display:none;">

        <div class="bg-white rounded-[32px] p-8 w-full max-w-sm shadow-2xl">

            <!-- ICON -->
            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto">

                <i data-lucide="log-out" class="w-7 h-7 text-red-500"></i>

            </div>

            <!-- TITLE -->
            <h2 class="text-2xl font-bold text-center text-slate-800 mt-5">
                Logout Admin?
            </h2>

            <p class="text-center text-slate-400 mt-2 text-sm leading-relaxed">
                Apakah Anda yakin ingin keluar dari dashboard admin?
            </p>

            <!-- BUTTON -->
            <div class="grid grid-cols-2 gap-4 mt-8">

                <button
                @click="logoutModal=false"
                class="py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 font-medium transition">

                    Batal

                </button>

                <a href="/login"
                class="py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-center font-medium transition">

                    Logout

                </a>

            </div>

        </div>

    </div>

    <!-- ICON -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>