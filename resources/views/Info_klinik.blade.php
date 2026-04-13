<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Klinik - DigitalCare</title>
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
            <a href="/dashboard" class="hover:text-blue-600">Beranda</a>
            <a href="#" class="hover:text-blue-600">Janji Temu</a>
            <a href="#" class="hover:text-blue-600">Riwayat Medis</a>
            <a href="/info_klinik" class="hover:text-blue-600 border-b-2 border-blue-600">Info Klinik</a>
            
            <button @click="openProfile = !openProfile" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white focus:outline-none hover:bg-gray-400 transition">
                <i class="fas fa-user text-xl"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6 relative">
        
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

        <div class="mb-8">
            <h1 class="text-white text-3xl font-bold mb-1">Informasi Klinik</h1>
            <p class="text-white opacity-90">Detail operasional dan layanan DigitalCare.</p>
        </div>

        <div class="grid grid-cols-12 gap-6">
            
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-[#5C94B3] px-6 py-4">
                        <h2 class="text-white font-bold text-lg flex items-center gap-2">
                            <i class="fas fa-info-circle"></i> Tentang Kami
                        </h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 leading-relaxed mb-6">
                            DigitalCare adalah klinik kesehatan modern yang terintegrasi secara digital untuk memudahkan mahasiswa dan staf dalam mendapatkan pelayanan medis berkualitas tinggi. Kami berkomitmen memberikan kenyamanan dan kecepatan dalam setiap layanan.
                        </p>
                        
                        <h3 class="font-bold text-[#2C5E7E] mb-4">Layanan Unggulan Kami:</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 p-3 border rounded-lg hover:bg-blue-50 transition">
                                <i class="fas fa-user-md text-blue-500"></i>
                                <span class="text-sm font-medium">Pelayanan Umum</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 border rounded-lg hover:bg-green-50 transition">
                                <i class="fas fa-tooth text-green-500"></i>
                                <span class="text-sm font-medium">Poli Gigi</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 border rounded-lg hover:bg-orange-50 transition">
                                <i class="fas fa-brain text-orange-500"></i>
                                <span class="text-sm font-medium">Konsultasi Mental</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 border rounded-lg hover:bg-purple-50 transition">
                                <i class="fas fa-flask text-purple-500"></i>
                                <span class="text-sm font-medium">Cek Darah & Lab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white rounded-xl p-5 shadow-md">
                    <h2 class="font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-clock text-blue-400"></i> Jam Operasional
                    </h2>
                    <ul class="space-y-3 text-sm">
                        <li class="flex justify-between">
                            <span class="text-gray-500">Senin - Jumat</span>
                            <span class="font-bold text-gray-700">08:00 - 20:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-500">Sabtu</span>
                            <span class="font-bold text-gray-700">08:00 - 15:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-500">Minggu</span>
                            <span class="font-bold text-red-500 uppercase">Tutup</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-5 shadow-md">
                    <h2 class="font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-phone-alt text-green-400"></i> Kontak Darurat
                    </h2>
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Telepon</p>
                            <p class="text-sm font-bold text-gray-700">(021) 1234 5678</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Email</p>
                            <p class="text-sm font-bold text-gray-700">help@digitalcare.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-map-marked-alt text-red-400"></i> Lokasi Klinik
                    </h2>
                    <div class="bg-gray-200 w-full h-48 rounded-lg flex items-center justify-center text-gray-500">
                        <div class="text-center">
                            <i class="fas fa-map-pin text-3xl mb-2"></i>
                            <p class="text-sm italic">Jl. Teknologi Medis No. 42, Batam Center.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>