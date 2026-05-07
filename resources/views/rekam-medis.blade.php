<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History - DigitalCare</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICON -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
class="bg-gradient-to-br from-[#f0fffd] via-[#f8fffe] to-[#ecfffb] min-h-screen font-[Inter] flex overflow-x-hidden"
x-data="{ openProfile:false, logoutModal:false }">

    <!-- BLUR -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-teal-200/40 blur-3xl rounded-full -z-10"></div>
    <div class="fixed bottom-0 right-0 w-80 h-80 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- SIDEBAR -->
    <aside class="group fixed left-0 top-0 h-screen w-20 hover:w-72 bg-white/90 backdrop-blur-xl border-r border-white shadow-xl transition-all duration-300 z-50 flex flex-col justify-between overflow-hidden">

        <div>

            <!-- LOGO -->
            <div class="flex items-center gap-4 px-5 py-6 border-b border-slate-100">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-200">
                    <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                </div>

                <div class="hidden group-hover:block">

                    <h1 class="text-xl font-bold text-slate-800">
                        Digital<span class="text-teal-500">Care</span>
                    </h1>

                    <p class="text-xs text-slate-400">
                        Smart Healthcare
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <nav class="mt-6 px-3 space-y-2">

                <!-- DASHBOARD -->
                <a href="/dashboard/pasien"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Dashboard
                    </span>

                </a>

                <!-- JANJI TEMU -->
                <a href="/janji-temu"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="calendar-days" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Janji Temu
                    </span>

                </a>

                <!-- REKAM MEDIS -->
                <a href="/riwayat"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl bg-teal-500 text-white shadow-lg shadow-teal-200">

                    <i data-lucide="file-heart" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Rekam Medis
                    </span>

                </a>

                <!-- PAYMENT -->
                <a href="/payment"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="wallet" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Payment
                    </span>

                </a>

                <!-- INFO KLINIK -->
                <a href="/info-klinik"
                class="flex items-center gap-4 px-4 py-3 rounded-2xl hover:bg-teal-50 text-slate-600 transition">

                    <i data-lucide="building-2" class="w-5 h-5"></i>

                    <span class="hidden group-hover:block font-medium">
                        Info Klinik
                    </span>

                </a>

            </nav>

        </div>

        <!-- LOGOUT -->
        <div class="p-4">

            <button
            @click="logoutModal = true"
            class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl text-red-500 hover:bg-red-50 transition">

                <i data-lucide="log-out" class="w-5 h-5"></i>

                <span class="hidden group-hover:block font-medium">
                    Logout
                </span>

            </button>

        </div>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 ml-20">

        <!-- TOPBAR -->
        <header class="flex justify-between items-center px-6 lg:px-10 py-6">

            <!-- TITLE -->
            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Medical History
                </h1>

                <p class="text-slate-500 mt-1">
                    View your past consultations and medical records
                </p>

            </div>

            <!-- PROFILE -->
            <div class="relative">

                <button
                @click="openProfile = !openProfile"
                class="flex items-center gap-3 bg-white px-3 py-2 rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition">

                    <img
                    src="https://i.pravatar.cc/100"
                    class="w-10 h-10 rounded-xl object-cover">

                    <div class="hidden md:block text-left">

                        <h3 class="text-sm font-semibold text-slate-800">
                            Rizki A
                        </h3>

                        <p class="text-xs text-slate-400">
                            Pasien
                        </p>

                    </div>

                </button>

                <!-- DROPDOWN -->
                <div
                x-show="openProfile"
                x-transition
                @click.away="openProfile = false"
                class="absolute right-0 mt-4 w-72 bg-white rounded-3xl shadow-2xl border border-slate-100 p-5"
                style="display:none;">

                    <div class="flex items-center gap-4">

                        <img
                        src="https://i.pravatar.cc/100"
                        class="w-14 h-14 rounded-2xl">

                        <div>

                            <h2 class="font-bold text-slate-800">
                                Rizki A
                            </h2>

                            <p class="text-sm text-slate-400">
                                rizki@email.com
                            </p>

                        </div>

                    </div>

                    <div class="mt-5 space-y-3 text-sm border-t pt-4">

                        <div class="flex justify-between">
                            <span class="text-slate-400">NIM</span>
                            <span class="font-medium">12345678</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-400">Status</span>
                            <span class="font-medium text-teal-500">
                                Pasien
                            </span>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="mt-5 space-y-3">

                        <a href="/profil"
                        class="flex items-center justify-center gap-2 py-3 rounded-2xl bg-teal-500 hover:bg-teal-600 text-white font-medium transition">

                            <i data-lucide="user-cog" class="w-4 h-4"></i>

                            Edit Profil

                        </a>

                    </div>

                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="px-6 lg:px-10 pb-10">

            <!-- MEDICAL HISTORY -->
            <div class="bg-white/90 backdrop-blur-xl rounded-[30px] shadow-xl border border-white p-6">

                <!-- HEADER -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-6">

                    <!-- TITLE -->
                    <div>

                        <h2 class="text-2xl font-bold text-slate-800">
                            Medical History List
                        </h2>

                        <p class="text-slate-400 text-sm mt-1">
                            View your past consultations and medical records
                        </p>

                    </div>

                    <!-- SEARCH -->
                    <div class="flex items-center gap-3">

                        <!-- SEARCH -->
                        <div class="relative">

                            <input
                                type="text"
                                placeholder="Cari riwayat..."
                                class="w-[230px] pl-11 pr-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-400 text-sm">

                            <i
                                data-lucide="search"
                                class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                        </div>

                        <!-- FILTER -->
                        <button
                            class="flex items-center gap-2 px-5 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 transition text-sm font-medium text-slate-700">

                            <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>

                            Filter

                        </button>

                    </div>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto rounded-3xl border border-slate-100">

                    <table class="w-full text-sm">

                        <!-- HEAD -->
                        <thead class="bg-slate-50 text-slate-500">

                            <tr>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Visit Date
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Doctor
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Main Complaint
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Diagnosis
                                </th>

                                <th class="px-6 py-4 text-left font-semibold">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-center font-semibold">
                                    Detail
                                </th>

                            </tr>

                        </thead>

                        <!-- BODY -->
                        <tbody class="divide-y divide-slate-100">

                            <!-- ROW -->
                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5 text-slate-600">
                                    26 Mei 2026
                                </td>

                                <td class="px-6 py-5 font-medium text-slate-700">
                                    dr. Andi Pratama
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    Sakit kepala, demam
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    N/A
                                </td>

                                <td class="px-6 py-5">

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-500 text-xs font-semibold">
                                        On Going
                                    </span>

                                </td>

                                <td class="px-6 py-5 text-center">

                                    <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                </td>

                            </tr>

                            <!-- ROW -->
                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5 text-slate-600">
                                    20 Mar 2026
                                </td>

                                <td class="px-6 py-5 font-medium text-slate-700">
                                    dr. Andi Pratama
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    Batuk, pilek
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    ISPA
                                </td>

                                <td class="px-6 py-5">

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-500 text-xs font-semibold">
                                        Done
                                    </span>

                                </td>

                                <td class="px-6 py-5 text-center">

                                    <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                </td>

                            </tr>

                            <!-- ROW -->
                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-5 text-slate-600">
                                    15 Jan 2026
                                </td>

                                <td class="px-6 py-5 font-medium text-slate-700">
                                    dr. Siti Aisyah
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    Pusing tekanan darah tinggi
                                </td>

                                <td class="px-6 py-5 text-slate-600">
                                    N/A
                                </td>

                                <td class="px-6 py-5">

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-500 text-xs font-semibold">
                                        Cancelled
                                    </span>

                                </td>

                                <td class="px-6 py-5 text-center">

                                    <button class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-teal-100 hover:text-teal-500 transition inline-flex items-center justify-center">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

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

            <h2 class="text-2xl font-bold text-center text-slate-800 mt-5">
                Logout?
            </h2>

            <p class="text-center text-slate-500 mt-2">
                Apakah Anda yakin ingin keluar?
            </p>

            <div class="grid grid-cols-2 gap-4 mt-8">

                <button
                @click="logoutModal = false"
                class="py-3 rounded-2xl border border-slate-300 font-medium hover:bg-slate-50 transition">

                    Batal

                </button>

                <a href="/login"
                class="py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-center font-medium transition">

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