<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janji Temu - DigitalCare</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#7BA8BD] min-h-screen font-[Inter] flex">

    <!-- SIDEBAR -->
    <div class="group fixed left-0 top-0 h-full w-16 hover:w-64 bg-white shadow-lg flex flex-col justify-between">

        <div>
            <div class="flex items-center gap-3 p-4 border-b">
                <div class="w-10 h-10 bg-gradient-to-tr from-[#2C5E7E] to-[#5C94B3] rounded-xl flex items-center justify-center text-white">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="hidden group-hover:block">
                    <p class="text-sm font-semibold text-[#2C5E7E]">DigitalCare</p>
                </div>
            </div>

            <nav class="mt-6 space-y-2 text-gray-700 font-medium">

                <a href="/dashboard/pasien" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span class="hidden group-hover:inline">Beranda</span>
                </a>

                <!-- ACTIVE -->
                <a href="/janji-temu"
                class="flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-100 text-blue-600 font-semibold border-l-4 border-blue-500">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="hidden group-hover:inline">Janji Temu</span>
                </a>

                <a href="/riwayat" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-file-medical"></i>
                    <span class="hidden group-hover:inline">Riwayat Medis</span>
                </a>

                <a href="/info_klinik" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-100 rounded-lg">
                    <i class="fas fa-info-circle"></i>
                    <span class="hidden group-hover:inline">Info Klinik</span>
                </a>

            </nav>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 ml-16 p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-white text-2xl font-bold">Janji Temu</h1>
                <p class="text-white opacity-90">Kelola jadwal konsultasi kamu</p>
            </div>

            <!-- BUTTON BUAT JANJI -->
            <a href="/buat-janji"
            class="flex items-center gap-2 text-sm font-medium px-4 py-2 
            bg-white text-[#2C5E7E] rounded-xl shadow hover:bg-gray-100 transition">

                <i class="fas fa-plus"></i>
                Buat Janji
            </a>
        </div>

        <!-- LIST JANJI -->
        <div class="space-y-4">

            <!-- ITEM 1 -->
            <div class="bg-white rounded-xl p-5 shadow flex justify-between items-center">

                <div>
                    <p class="font-semibold text-gray-800">Dr. Andi</p>
                    <p class="text-sm text-gray-500">26 Mei 2026 • 09:00</p>
                    <p class="text-xs text-gray-400">Poli Umum</p>
                </div>

                <div class="text-right">
                    <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-600">
                        Menunggu
                    </span>
                    <p class="text-sm mt-2 font-semibold text-blue-600">D01-001</p>
                </div>

            </div>

            <!-- ITEM 2 -->
            <div class="bg-white rounded-xl p-5 shadow flex justify-between items-center">

                <div>
                    <p class="font-semibold text-gray-800">Dr. Budi</p>
                    <p class="text-sm text-gray-500">25 Mei 2026 • 13:00</p>
                    <p class="text-xs text-gray-400">Poli Umum</p>
                </div>

                <div class="text-right">
                    <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-600">
                        Selesai
                    </span>
                    <p class="text-sm mt-2 font-semibold text-gray-500">D01-002</p>
                </div>

            </div>

        </div>

        <!-- EMPTY STATE -->
        <!--
        <div class="bg-white rounded-xl p-10 text-center text-gray-400 mt-6">
            Belum ada janji temu
        </div>
        -->

    </div>

</body>
</html>