<!DOCTYPE html>
<html lang="id">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Janji - DigitalCare</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#7BA8BD] min-h-screen font-[Inter] flex"
      x-data="{ openProfile: false }">

    <!-- SIDEBAR (SAMA PERSIS) -->
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
    </div>

    <!-- CONTENT -->
    <div class="flex-1 ml-16 p-6">

        <h1 class="text-white text-2xl font-bold mb-6">Make Appointment</h1>

        <div class="bg-white rounded-2xl p-6 shadow-md max-w-4xl">

            <!-- PERSONAL -->
            <h2 class="font-semibold text-gray-800 mb-4">1 Personal Information</h2>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <input placeholder="Name" class="border p-2 rounded-lg">
                <input placeholder="No. ID" class="border p-2 rounded-lg">
                <input placeholder="Date of Birth" class="border p-2 rounded-lg">
                <input placeholder="Gender" class="border p-2 rounded-lg">
            </div>

            <input placeholder="Email" class="border p-2 rounded-lg w-full mb-6">

            <!-- APPOINTMENT -->
            <h2 class="font-semibold text-gray-800 mb-4">2 Appointment Details</h2>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <input type="date" class="border p-2 rounded-lg">
                <select class="border p-2 rounded-lg">
                    <option>Select Doctor</option>
                    <option>Dr. Andi</option>
                    <option>Dr. Budi</option>
                </select>
            </div>

            <!-- VISIT -->
            <h2 class="font-semibold text-gray-800 mb-4">3 Visit Details</h2>

            <textarea placeholder="Reason for visit"
                class="border p-2 rounded-lg w-full h-24 mb-6"></textarea>

            <!-- BUTTON -->
            <button onclick="window.location.href='/booking-success'"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                Book Appointment
            </button>

        </div>

    </div>

</body>
</html>