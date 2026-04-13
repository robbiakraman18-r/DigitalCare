<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - DigitalCare</title>
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
            <a href="/info_klinik" class="hover:text-blue-600">Info Klinik</a>
            
            <button @click="openProfile = !openProfile" class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white focus:outline-none hover:bg-gray-400 transition">
                <i class="fas fa-user text-xl"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto p-6 relative">
        
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
                <p><strong>Tgl Lahir :</strong> 12 April 2005</p>
            </div>
            <a href="/edit_profil" class="block w-full text-center py-2 bg-[#5C94B3] text-white rounded-lg font-medium hover:bg-[#4A7D9A] transition">
                Edit Profil
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-white text-3xl font-bold mb-1">Pengaturan Profil</h1>
            <p class="text-white opacity-90">Lengkapi verifikasi sandi lama untuk menyimpan perubahan.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-[#2C5E7E] p-6 flex items-center gap-4">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=Rizki+A&background=random" class="w-20 h-20 rounded-full border-4 border-white/20">
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Rizki A</h2>
                    <p class="text-sm opacity-80 italic">Mahasiswa Informatika</p>
                </div>
            </div>

            <form action="#" method="POST" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" value="Rizki A" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed" readonly>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">NIM</label>
                    <input type="text" value="12345678" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed" readonly>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">Email</label>
                    <input type="email" value="rizki@mahasiswa.ac.id" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed" readonly>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-400 mb-2">Tanggal Lahir</label>
                    <input type="text" value="12 April 2005" class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-500 cursor-not-allowed" readonly>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon Baru</label>
                    <input type="tel" placeholder="Contoh: 081234567890" class="w-full px-4 py-2 bg-white border border-[#5C94B3] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5C94B3] text-gray-800" required>
                </div>

                <div class="col-span-2 border-t pt-4 mt-2">
                    <h3 class="font-bold text-[#2C5E7E]">Keamanan & Kata Sandi</h3>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Lama <span class="text-red-500">*</span></label>
                    <input type="password" placeholder="Masukkan kata sandi saat ini" class="w-full px-4 py-2 bg-white border border-orange-300 rounded-lg focus:outline-none focus:border-[#5C94B3] focus:ring-1 focus:ring-[#5C94B3]" required>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Baru</label>
                    <input type="password" placeholder="Minimal 8 karakter" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-[#5C94B3] focus:ring-1 focus:ring-[#5C94B3]">
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" placeholder="Ulangi kata sandi baru" class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg focus:outline-none focus:border-[#5C94B3] focus:ring-1 focus:ring-[#5C94B3]">
                </div>

                <div class="col-span-2 flex gap-4 mt-4 border-t pt-6">
                    <button type="submit" class="bg-[#5C94B3] text-white px-8 py-2 rounded-lg font-bold hover:bg-[#4A7D9A] transition shadow-md active:scale-95">
                        Simpan Perubahan
                    </button>
                    <a href="/dashboard" class="bg-gray-100 text-gray-600 px-8 py-2 rounded-lg font-bold hover:bg-gray-200 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>