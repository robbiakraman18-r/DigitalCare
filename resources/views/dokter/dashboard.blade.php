<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalCare - Dashboard Dokter</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ALPINE -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#7BA8BD] min-h-screen font-[Inter] flex"
      x-data="{ openProfile: false, confirmLogout: false }">

<!-- SIDEBAR -->
<div class="group fixed left-0 top-0 h-full w-16 hover:w-64 bg-white shadow-lg transition-all duration-300 overflow-hidden z-50 flex flex-col justify-between">

    <!-- TOP -->
    <div>

        <!-- LOGO -->
        <div class="flex items-center gap-3 p-4 border-b">
            <div class="w-10 h-10 bg-gradient-to-tr from-[#2C5E7E] to-[#5C94B3] rounded-xl flex items-center justify-center text-white">
                <i class="fas fa-user-doctor"></i>
            </div>
            <div class="hidden group-hover:block">
                <p class="text-sm font-semibold text-[#2C5E7E]">DigitalCare</p>
                <p class="text-xs text-gray-400">Doctor Panel</p>
            </div>
        </div>

        <!-- MENU -->
        <nav class="mt-6 space-y-2 text-gray-700 font-medium">

            <a href="/dashboard-dokter" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                <i class="fas fa-home"></i>
                <span class="hidden group-hover:inline">Dashboard</span>
            </a>

            <a href="/pasien" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                <i class="fas fa-users"></i>
                <span class="hidden group-hover:inline">Pasien</span>
            </a>

            <a href="/jadwal-dokter" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                <i class="fas fa-calendar"></i>
                <span class="hidden group-hover:inline">Jadwal</span>
            </a>

            <a href="/rekam-medis" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                <i class="fas fa-file-medical"></i>
                <span class="hidden group-hover:inline">Rekam Medis</span>
            </a>

        </nav>
    </div>

    <!-- LOGOUT -->
    <div class="mb-4 px-2">
        <button @click="confirmLogout = true"
            class="w-full flex items-center gap-3 px-4 py-2 text-red-500 hover:bg-red-100 rounded-lg">
            <i class="fas fa-sign-out-alt"></i>
            <span class="hidden group-hover:inline">Logout</span>
        </button>
    </div>
</div>

<!-- CONTENT -->
<div class="flex-1 ml-16">

    <!-- PROFILE -->
    <div class="flex justify-end items-center p-6 relative">

        <button @click="openProfile = !openProfile"
            class="flex items-center gap-2 bg-white px-3 py-2 rounded-full shadow">

            <!-- ICON DOKTER -->
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#2C5E7E] to-[#5C94B3]
                        flex items-center justify-center text-white">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.8" stroke="currentColor"
                     class="w-4 h-4">

                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.5 7.5a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0z" />

                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 20a8.5 8.5 0 0115 0" />

                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 10v6m-3-3h6" />
                </svg>

            </div>

            <span class="text-sm font-medium hidden md:block">Dr. Andi</span>
        </button>

        <!-- DROPDOWN -->
        <div x-show="openProfile"
             x-transition
             @click.away="openProfile = false"
             class="absolute top-16 right-6 w-72 bg-white rounded-2xl shadow-xl p-5"
             style="display:none;">

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-[#2C5E7E] to-[#5C94B3]
                            flex items-center justify-center text-white">

                    <i class="fas fa-user-doctor"></i>
                </div>

                <div>
                    <p class="font-semibold">Dr. Andi Pratama</p>
                    <p class="text-sm text-gray-500">dr.andi@digitalcare.id</p>
                </div>
            </div>

            <!-- INFO PROFIL -->
            <div class="border-t pt-3 text-sm space-y-2 text-gray-600">

                <div class="flex justify-between">
                    <span>Role</span>
                    <span class="font-medium text-blue-600">Dokter</span>
                </div>

                <div class="flex justify-between">
                    <span>No. STR</span>
                    <span class="font-medium text-gray-800">312345678901</span>
                </div>

                <div class="flex justify-between">
                    <span>No. SIP</span>
                    <span class="font-medium text-gray-800">445/2024/DINKES</span>
                </div>

                <div class="flex justify-between">
                    <span>No. HP</span>
                    <span class="font-medium text-gray-800">+62 812-3456-7890</span>
                </div>

            </div>

        </div>
    </div>

    <!-- MAIN -->
    <main class="px-6 pb-6">

        <h1 class="text-white text-3xl font-bold mb-1">Selamat Datang, Dr. Andi!</h1>
        <p class="text-white opacity-90 mb-6">Kelola pasien dan jadwal hari ini</p>

        <!-- CARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-2xl p-6 flex gap-4">
                <i class="fas fa-user-injured text-4xl text-blue-500"></i>
                <div>
                    <p class="font-semibold">Pasien Hari Ini</p>
                    <p class="text-3xl font-bold">5</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 flex gap-4">
                <i class="fas fa-calendar-check text-4xl text-green-500"></i>
                <div>
                    <p class="font-semibold">Jadwal Konsultasi</p>
                    <p class="text-3xl font-bold">3</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 flex gap-4">
                <i class="fas fa-prescription text-4xl text-orange-500"></i>
                <div>
                    <p class="font-semibold">Resep Dibuat</p>
                    <p class="text-3xl font-bold">2</p>
                </div>
            </div>

        </div>

        <!-- BOTTOM -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

            <!-- ANTRIAN -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6">
                <h2 class="font-semibold mb-4">Antrian Pasien</h2>

                <div class="border-2 border-dashed p-10 text-center text-gray-400">
                    Belum ada pasien dalam antrian
                </div>
            </div>

            <!-- SIDE -->
            <div class="space-y-6">

                <div class="bg-white rounded-2xl p-5">
                    <h2 class="font-semibold mb-2">Rekam Medis</h2>
                    <p class="text-gray-400 text-sm">Belum ada data</p>
                </div>

                <div class="bg-white rounded-2xl p-5">
                    <h2 class="font-semibold mb-2">Tindakan Hari Ini</h2>
                    <p class="text-gray-400 text-sm">Belum ada tindakan</p>
                </div>

            </div>

        </div>

    </main>
</div>

<!-- LOGOUT -->
<div x-show="confirmLogout"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
     style="display:none;">

    <div class="bg-white p-6 rounded-xl w-80 text-center">

        <h2 class="font-semibold mb-2">Logout?</h2>
        <p class="text-gray-600 mb-4">Yakin ingin keluar?</p>

        <div class="flex gap-3">
            <button @click="confirmLogout=false" class="flex-1 bg-gray-200 py-2 rounded-lg">Batal</button>

            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button class="w-full bg-red-500 text-white py-2 rounded-lg">Logout</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>