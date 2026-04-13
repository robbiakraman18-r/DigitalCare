<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalCare Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#7BA8BD] min-h-screen font-sans" x-data="{ openProfile: false }">

    <nav class="bg-white px-8 py-4 flex justify-between items-center shadow-sm relative z-50">
        <div class="flex items-center gap-2 text-[#2C5E7E] font-bold text-xl">
            <div class="w-8 h-8 bg-[#2C5E7E] rounded-full flex items-center justify-center text-white">
                <i class="fas fa-stethoscope"></i>
            </div>
            DigitalCare
        </div>
        <div class="flex items-center gap-8 text-gray-700 font-medium">
            <a href="/dashboard" class="hover:text-blue-600 border-b-2 border-blue-600">Beranda</a>
            <a href="#" class="hover:text-blue-600">Janji Temu</a>
            <a href="#" class="hover:text-blue-600">Riwayat Medis</a>
            <a href="/info_klinik" class="hover:text-blue-600">Info Klinik</a>
            
            <button @click="openProfile = !openProfile" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white focus:outline-none hover:bg-gray-400 transition">
                <i class="fas fa-user text-xl"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6 grid grid-cols-12 gap-6 relative">
        
        <div 
            x-show="openProfile" 
            x-transition
            @click.away="openProfile = false"
            class="absolute top-0 right-6 w-64 bg-white rounded-xl shadow-2xl p-6 z-[100]"
            style="display: none;"
        >
            <div class="text-center mb-4">
                <h3 class="font-bold text-lg text-gray-800">Rizki A</h3>
            </div>
            <div class="space-y-2 text-sm text-gray-700 mb-4 border-t pt-4">
                <p><strong>NIM :</strong> 12345678</p>
                <p><strong>Jurusan :</strong> Informatika</p>
                <p><strong>Umur :</strong> 21 Tahun</p>
            </div>
            <a href="/edit_profil" class="block w-full text-center py-2 bg-[#5C94B3] text-white rounded-lg font-medium hover:bg-[#4A7D9A] transition active:scale-95">
                Edit Profil
            </a>
        </div>

        <div class="col-span-12">
            <h1 class="text-white text-3xl font-bold mb-1">Selamat Datang, Rizki A!</h1>
            <p class="text-white opacity-90 mb-6">Yuk buat janji temu!</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl p-4 shadow-md border-l-8 border-blue-400">
                    <div class="flex items-center gap-4">
                        <i class="far fa-calendar-alt text-4xl text-blue-400"></i>
                        <div>
                            <p class="font-bold text-gray-700">Janji Temu Aktif</p>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-md border-l-8 border-green-400">
                    <div class="flex items-center gap-4">
                        <i class="far fa-file-alt text-4xl text-green-400"></i>
                        <div>
                            <p class="font-bold text-gray-700">Rekam Medis Baru</p>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 shadow-md border-l-8 border-orange-400">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-bullhorn text-4xl text-orange-400"></i>
                        <div>
                            <p class="font-bold text-gray-700">Pengumuman</p>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-bold text-xl text-gray-800">Janji Temu Mendatang</h2>
                    <a href="#" class="text-blue-500 text-sm italic underline">Lihat Semua</a>
                </div>

                <div class="py-10 text-center border-2 border-dashed border-gray-100 rounded-xl">
                    <p class="text-gray-400 italic">Belum ada jadwal janji temu aktif.</p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-white rounded-xl p-5 shadow-md">
                <h2 class="font-bold text-gray-800 mb-4 border-b pb-2">Rekam Medis Terbaru</h2>
                <div class="py-4 text-center">
                    <p class="text-xs text-gray-400 italic">Belum ada riwayat medis.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-md">
                <h2 class="font-bold text-gray-800 mb-4 border-b pb-2">Pengumuman</h2>
                <p class="text-xs text-gray-600 leading-relaxed italic">
                    Belum ada pengumuman terbaru.
                </p>
                <a href="/info-klinik" class="inline-block mt-3 text-blue-500 text-xs font-bold hover:underline">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

    </main>

</body>
</html>