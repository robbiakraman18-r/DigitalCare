<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalCare Dashboard</title>

    <!-- FONT MODERN -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#7BA8BD] min-h-screen font-[Inter] flex"
      x-data="{ openProfile: false, confirmLogout: false }">

    <!-- SIDEBAR -->
    <div class="group fixed left-0 top-0 h-full w-16 hover:w-64 bg-white shadow-lg 
                transition-all duration-300 overflow-hidden z-50 
                flex flex-col justify-between">

        <!-- ATAS -->
        <div>

            <!-- LOGO BARU -->
            <div class="flex items-center gap-3 p-4 border-b">
                <div class="w-10 h-10 bg-gradient-to-tr from-[#2C5E7E] to-[#5C94B3] 
                    rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fas fa-heartbeat"></i>
                </div>

                <div class="hidden group-hover:block leading-tight">
                    <p class="text-sm font-semibold text-[#2C5E7E]">DigitalCare</p>
                    <p class="text-xs text-gray-400">Smart Clinic</p>
                </div>
            </div>

            <!-- MENU -->
            <nav class="mt-6 space-y-2 text-gray-700 font-medium">
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span class="hidden group-hover:inline">Beranda</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="hidden group-hover:inline">Janji Temu</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-file-medical"></i>
                    <span class="hidden group-hover:inline">Riwayat Medis</span>
                </a>

                <a href="/info_klinik" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-info-circle"></i>
                    <span class="hidden group-hover:inline">Info Klinik</span>
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
    <div class="flex-1 ml-16 transition-all duration-300 w-full">

        <!-- PROFILE -->
        <div class="flex justify-end items-center p-6 relative">
            <button @click="openProfile = !openProfile"
                class="flex items-center gap-2 bg-white px-3 py-2 rounded-full shadow">

                <!-- AVATAR -->
                <img src="https://i.pravatar.cc/40" 
                     class="w-8 h-8 rounded-full object-cover border">

                <span class="text-sm font-medium text-gray-700 hidden md:block">Rizki</span>
            </button>

            <div 
    x-show="openProfile"
    x-transition
    @click.away="openProfile = false"
    class="absolute top-16 right-6 w-72 bg-white rounded-2xl shadow-xl p-5"
    style="display: none;"
>

    <!-- PROFILE -->
    <div class="flex items-center gap-3 mb-4">
        <img src="https://i.pravatar.cc/50"
             class="w-12 h-12 rounded-full object-cover">

        <div>
            <p class="font-semibold text-gray-800">Rizki A</p>
            <p class="text-sm text-gray-500">rizki@email.com</p>
        </div>
    </div>

    <!-- DETAIL -->
    <div class="text-sm text-gray-600 border-t pt-3 space-y-2">

        <div class="flex justify-between">
            <span class="text-gray-400">NIM</span>
            <span class="font-medium text-gray-700">12345678</span>
        </div>

        <!-- 🔥 TAMBAHAN -->
        <div class="flex justify-between">
            <span class="text-gray-400">Tanggal Lahir</span>
            <span class="font-medium text-gray-700">12 Mei 2003</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Status</span>
            <span class="font-medium text-blue-600">Pasien</span>
        </div>

    </div>

    <!-- BUTTON MODERN -->
    <div class="mt-4 pt-4 border-t">

        <a href="/edit_profil"
   class="flex items-center justify-center gap-2 w-full 
   text-sm font-medium px-4 py-2.5 
   bg-[#2C5E7E] text-white rounded-xl 
   hover:bg-[#244b66] transition shadow-sm hover:shadow-md group">

    <!-- ICON EDIT (PENCIL MODERN) -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-4 h-4 transform group-hover:scale-110 transition"
         fill="none" 
         viewBox="0 0 24 24" 
         stroke="currentColor" 
         stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M15.232 5.232l3.536 3.536M9 11l6.768-6.768a2.5 2.5 0 113.536 3.536L12.536 14.536A4 4 0 0111 15H9v-2a4 4 0 011.232-2.768z"/>
    </svg>

    Edit Profil
</a>

    </div>

</div>
        </div>

        <!-- MAIN -->
        <main class="w-full px-6 pb-6">

            <h1 class="text-white text-3xl font-bold mb-1">Selamat Datang, Rizki A!</h1>
            <p class="text-white opacity-90 mb-6">Yuk buat janji temu!</p>

            <!-- CARD ATAS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition flex items-center gap-4">
                    <i class="fas fa-calendar-alt text-4xl text-blue-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Janji Temu Aktif</p>
                        <p class="text-3xl font-bold">0</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition flex items-center gap-4">
                    <i class="fas fa-file-medical text-4xl text-green-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Rekam Medis Baru</p>
                        <p class="text-3xl font-bold">0</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition flex items-center gap-4">
                    <i class="fas fa-bullhorn text-4xl text-orange-500"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Pengumuman</p>
                        <p class="text-3xl font-bold">0</p>
                    </div>
                </div>

            </div>

            <!-- SECTION BAWAH -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

                <!-- JANJI TEMU -->
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm">
                    
                    <!-- HEADER -->
                    <div class="flex justify-between items-center mb-4">
                        
                        <h2 class="font-semibold text-gray-800">
                            Janji Temu Mendatang
                        </h2>
                        
                        <a href="/buat-janji"
                        class="flex items-center gap-2 text-xs font-medium px-3 py-1.5 
                        bg-[#2C5E7E]/10 text-[#2C5E7E] rounded-full 
                        hover:bg-[#2C5E7E]/20 transition group">
                        
                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-4 h-4 transform group-hover:rotate-90 transition"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Janji
                </a>
            </div>
            <!-- ISI -->
            <div class="py-10 text-center border-2 border-dashed border-gray-200 rounded-xl">
                <p class="text-gray-400 italic">Belum ada jadwal janji temu.</p>
            </div>
        </div>
                <!-- KANAN -->
                <div class="space-y-6">

                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                        <h2 class="font-semibold text-gray-800 mb-3 border-b pb-2">
                            Rekam Medis Terbaru
                        </h2>
                        <p class="text-gray-400 text-sm italic">
                            Belum ada riwayat medis.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl p-5 shadow-sm">
                        <h2 class="font-semibold text-gray-800 mb-3 border-b pb-2">
                            Pengumuman
                        </h2>
                        <p class="text-gray-400 text-sm italic">
                            Belum ada pengumuman terbaru.
                        </p>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- POPUP LOGOUT -->
    <div 
        x-show="confirmLogout"
        x-transition.opacity
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;"
    >
        <div class="bg-white p-6 rounded-xl text-center w-80">
            <h2 class="font-semibold mb-2">Konfirmasi Logout</h2>
            <p class="mb-4 text-gray-600">Yakin mau logout?</p>

            <div class="flex gap-3">
                <button @click="confirmLogout = false"
                    class="flex-1 bg-gray-200 py-2 rounded-lg">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-500 text-white py-2 rounded-lg">
                        Ya
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>