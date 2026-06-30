<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $clinic->clinic_name ?? 'DigitalCare' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-[#f0fffd] via-[#f7fffe] to-[#ecfffb] font-[Poppins] overflow-x-hidden">

    <!-- Blur Background -->
    <div class="fixed top-0 left-0 w-72 h-72 bg-teal-200/40 blur-3xl rounded-full -z-10"></div>
    <div class="fixed bottom-0 right-0 w-72 h-72 bg-cyan-200/40 blur-3xl rounded-full -z-10"></div>

    <!-- MAIN -->
    <section class="max-w-7xl mx-auto min-h-screen px-6 lg:px-10 py-6">

        <!-- NAVBAR -->
        <nav class="flex items-center justify-between">

            <!-- LOGO -->
            <div class="flex items-center gap-3">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-teal-500 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-200">
                    🩺
                </div>

                <div>

                    <h1 class="text-xl font-bold text-slate-800">
                        {{ $clinic->clinic_name ?? 'DigitalCare' }}
                    </h1>

                    <p class="text-xs text-slate-500">
                        {{ $clinic->clinic_tagline ?? 'Better Healthcare, Digitally' }}
                    </p>

                </div>

            </div>

            <!-- MENU -->
            <ul class="hidden lg:flex items-center gap-10 text-sm font-medium">

                <li>
                    <a href="#" class="text-teal-500 relative">

                        Beranda

                        <span class="absolute -bottom-2 left-0 w-full h-[3px] bg-teal-500 rounded-full"></span>

                    </a>
                </li>

                <li>
                    <a href="#layanan" class="hover:text-teal-500 transition">
                        Layanan
                    </a>
                </li>

                <li>
                    <a href="#dokter" class="hover:text-teal-500 transition">
                        Dokter
                    </a>
                </li>

                <li>
                    <a href="#kontak" class="hover:text-teal-500 transition">
                        Hubungi Kami
                    </a>
                </li>

            </ul>

            <!-- BUTTON -->
            <div class="flex items-center gap-3">

                <a
                    href="/login"
                    class="px-5 py-2 rounded-xl border border-teal-500 text-teal-500 text-sm font-medium hover:bg-teal-50 transition"
                >
                    Masuk
                </a>

                <a
                    href="/register"
                    class="px-5 py-2 rounded-xl bg-teal-500 text-white text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 hover:scale-105 transition duration-300"
>
                    Daftar
                </a>

            </div>

        </nav>

        <!-- HERO -->
        <div class="grid lg:grid-cols-2 gap-10 items-center mt-14">

            <!-- LEFT -->
            <div>

                <!-- BADGE -->
                <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full border border-teal-100 shadow-sm mb-6 hover:shadow-md transition">

                    <div class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></div>

                    <span class="text-xs font-medium text-teal-500">
                        Platform kesehatan terpercaya
                    </span>

                </div>

                <!-- TITLE -->
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight text-slate-900">

                    Kesehatan Anda,

                    <span class="text-teal-500 block relative w-fit">

                        Prioritas kami

                        <span class="absolute left-0 bottom-1 w-full h-3 bg-teal-200 rounded-full -z-10"></span>

                    </span>

                </h1>

                <!-- DESCRIPTION -->
                <p class="text-slate-600 text-base leading-relaxed mt-6 max-w-lg">

                    {{ $clinic->clinic_description ?? ($clinic->clinic_name ?? 'DigitalCare') . ' hadir untuk memberikan kemudahan konsultasi dokter, booking online, rekam medis, dan layanan kesehatan modern dalam satu platform.' }}

                </p>

                <!-- FEATURES -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center mb-3">

                            <i data-lucide="shield-check" class="text-teal-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Aman
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Data pasien aman terenkripsi.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center mb-3">

                            <i data-lucide="clock-3" class="text-green-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Cepat
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Booking tanpa antri.
                        </p>

                    </div>

                    <!-- CARD -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl p-4 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center mb-3">

                            <i data-lucide="stethoscope" class="text-yellow-500 w-5 h-5"></i>

                        </div>

                        <h3 class="font-semibold text-sm text-slate-800">
                            Profesional
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Dokter terpercaya & ahli.
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="flex flex-wrap items-center gap-4 mt-10">

                    <a href="/register" class="flex items-center gap-2 px-6 py-3 bg-teal-500 text-white rounded-2xl text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 hover:scale-105 transition-all duration-300">

                        Buat Janji

                        <i data-lucide="arrow-right" class="w-4 h-4"></i>

                    </a>

                    <a href="#dokter" class="flex items-center gap-2 px-6 py-3 border border-teal-500 text-teal-500 rounded-2xl text-sm font-medium hover:bg-teal-50 hover:scale-105 transition-all duration-300">

                        <i data-lucide="users" class="w-4 h-4"></i>

                        Lihat Dokter

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative flex justify-center items-center min-h-[460px]">

                <!-- BLUR -->
                <div class="absolute w-96 h-96 bg-teal-200/40 blur-3xl rounded-full"></div>
                <div class="absolute w-64 h-64 bg-cyan-200/40 blur-3xl rounded-full translate-x-20 translate-y-10"></div>

                <!-- BLOB SHAPE -->
                <div class="absolute w-[340px] h-[340px] lg:w-[400px] lg:h-[400px] bg-gradient-to-br from-teal-400 to-cyan-500 rounded-[45%_55%_60%_40%/50%_40%_60%_50%] -z-0 opacity-90"></div>

                <!-- FLOATING CARD TOP -->
                <div class="absolute top-4 left-0 lg:-left-4 bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl p-4 border border-white/60 z-20 animate-bounce">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                            <i data-lucide="calendar-check-2" class="w-5 h-5 text-green-500"></i>
                        </div>

                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">Booking Berhasil</h4>
                            <p class="text-xs text-slate-500">Jadwal dikonfirmasi</p>
                        </div>

                    </div>

                </div>

                <!-- IMAGE -->
                <img
                    src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?q=80&w=800&auto=format&fit=crop"
                    alt="Dokter DigitalCare"
                    class="relative z-10 w-full max-w-[360px] aspect-square object-cover rounded-[45%_55%_60%_40%/50%_40%_60%_50%] hover:scale-105 transition duration-500 shadow-2xl border-4 border-white/70"
                >

                <!-- RATING CARD -->
                <div class="absolute top-1/2 -translate-y-1/2 -right-2 lg:right-0 bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl p-3 border border-white/60 z-20 hover:scale-105 transition">

                    <div class="flex items-center gap-2">
                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-yellow-400"></i>
                        <span class="text-sm font-bold text-slate-800">4.9</span>
                    </div>

                    <p class="text-[10px] text-slate-500 mt-0.5">
                        Rating Pasien
                    </p>

                </div>

                <!-- BOTTOM CARD -->
                <div class="absolute bottom-2 right-0 lg:right-4 bg-white/90 backdrop-blur-lg rounded-2xl shadow-xl p-4 border border-white/60 z-20 hover:scale-105 transition">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
                            <i data-lucide="activity" class="w-5 h-5 text-teal-500"></i>
                        </div>

                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">100+ Pasien</h4>
                            <p class="text-xs text-slate-500">
                                Menggunakan {{ $clinic->clinic_name ?? 'DigitalCare' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- LAYANAN -->
        <div id="layanan" class="mt-28">

            <div class="text-center max-w-xl mx-auto">

                <span class="text-xs font-semibold text-teal-500 bg-teal-50 px-4 py-1.5 rounded-full border border-teal-100">
                    Layanan Kami
                </span>

                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 mt-4">
                    Solusi Kesehatan Lengkap
                </h2>

                <p class="text-slate-500 text-sm mt-3">
                    Berbagai layanan kesehatan digital yang dirancang untuk
                    memenuhi kebutuhan Anda dan keluarga.
                </p>

            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">

                <!-- ITEM -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                    <div class="w-12 h-12 rounded-xl bg-teal-100 flex items-center justify-center mb-4">
                        <i data-lucide="calendar-clock" class="text-teal-500 w-6 h-6"></i>
                    </div>

                    <h3 class="font-semibold text-slate-800">
                        Booking Online
                    </h3>

                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Buat janji temu dengan dokter kapan saja tanpa perlu antri.
                    </p>

                </div>

                <!-- ITEM -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                    <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center mb-4">
                        <i data-lucide="video" class="text-cyan-500 w-6 h-6"></i>
                    </div>

                    <h3 class="font-semibold text-slate-800">
                        Konsultasi Online
                    </h3>

                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Konsultasi langsung dengan dokter via chat atau video call.
                    </p>

                </div>

                <!-- ITEM -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4">
                        <i data-lucide="file-heart" class="text-green-500 w-6 h-6"></i>
                    </div>

                    <h3 class="font-semibold text-slate-800">
                        Rekam Medis Digital
                    </h3>

                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Riwayat kesehatan tersimpan rapi dan mudah diakses.
                    </p>

                </div>

                <!-- ITEM -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                    <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center mb-4">
                        <i data-lucide="pill" class="text-yellow-500 w-6 h-6"></i>
                    </div>

                    <h3 class="font-semibold text-slate-800">
                        Resep & Obat
                    </h3>

                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        Pesan obat sesuai resep dan diantar langsung ke rumah.
                    </p>

                </div>

            </div>

        </div>

        <!-- DOKTER -->
        <div id="dokter" class="mt-28">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">

                <div>
                    <span class="text-xs font-semibold text-teal-500 bg-teal-50 px-4 py-1.5 rounded-full border border-teal-100">
                        Tim Medis
                    </span>

                    <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 mt-4">
                        Dokter Unggulan Kami
                    </h2>
                </div>

                <a href="/register" class="text-sm font-medium text-teal-500 hover:underline flex items-center gap-1">
                    Lihat Semua Dokter
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>

            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">

                @forelse ($dokters as $dokter)

                    <!-- DOCTOR CARD -->
                    <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 text-center">

                        <div class="relative w-24 h-24 mx-auto">

                            <img
                                src="{{ $dokter->foto_profil ? asset('storage/' . $dokter->foto_profil) : 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png' }}"
                                alt="{{ $dokter->user->nama }}"
                                class="w-24 h-24 rounded-2xl object-cover bg-teal-50 p-2"
                            >

                            <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white {{ $dokter->status_ketersediaan === 'Available' ? 'bg-green-500' : 'bg-slate-300' }}"></span>

                        </div>

                        <h3 class="font-semibold text-slate-800 mt-4">
                            dr. {{ $dokter->user->nama }}
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            No. SIP {{ $dokter->no_sip }}
                        </p>

                        <span class="inline-block mt-2 text-[11px] font-medium px-3 py-1 rounded-full {{ $dokter->status_ketersediaan === 'Available' ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-400' }}">
                            {{ $dokter->status_ketersediaan === 'Available' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>

                    </div>

                @empty

                    <p class="col-span-full text-center text-sm text-slate-400">
                        Belum ada data dokter.
                    </p>

                @endforelse

            </div>

        </div>

        <!-- CTA -->
        <div id="kontak" class="mt-28 mb-10">

            <div class="relative overflow-hidden bg-gradient-to-r from-teal-500 to-cyan-500 rounded-3xl px-8 py-14 text-center shadow-xl shadow-teal-200">

                <div class="absolute -top-10 -left-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>

                <h2 class="text-2xl lg:text-3xl font-extrabold text-white relative z-10">
                    Mulai Jaga Kesehatan Anda Hari Ini
                </h2>

                <p class="text-teal-50 text-sm mt-3 max-w-lg mx-auto relative z-10">
                    Daftar sekarang dan nikmati kemudahan layanan kesehatan
                    digital bersama tim dokter profesional {{ $clinic->clinic_name ?? 'DigitalCare' }}.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4 mt-8 relative z-10">

                    <a href="/register" class="flex items-center gap-2 px-6 py-3 bg-white text-teal-600 rounded-2xl text-sm font-semibold shadow-lg hover:scale-105 transition-all duration-300">
                        Daftar Sekarang
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>

                    <a href="#" class="flex items-center gap-2 px-6 py-3 border border-white/60 text-white rounded-2xl text-sm font-semibold hover:bg-white/10 hover:scale-105 transition-all duration-300">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                        Hubungi Kami
                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-10 py-12">

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- BRAND -->
                <div>

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 rounded-xl bg-teal-500 flex items-center justify-center text-white text-lg shadow-md shadow-teal-200">
                            🩺
                        </div>

                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $clinic->clinic_name ?? 'DigitalCare' }}
                        </h3>

                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $clinic->clinic_description ?? 'Platform kesehatan digital terpercaya untuk konsultasi, booking, dan rekam medis dalam satu genggaman.' }}
                    </p>

                </div>

                <!-- LINKS -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-800 mb-4">Layanan</h4>
                    <ul class="space-y-2 text-xs text-slate-500">
                        <li><a href="#layanan" class="hover:text-teal-500 transition">Booking Online</a></li>
                        <li><a href="#layanan" class="hover:text-teal-500 transition">Konsultasi Online</a></li>
                        <li><a href="#layanan" class="hover:text-teal-500 transition">Rekam Medis Digital</a></li>
                        <li><a href="#layanan" class="hover:text-teal-500 transition">Resep & Obat</a></li>
                    </ul>
                </div>

                <!-- LINKS -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-800 mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-xs text-slate-500">
                        <li><a href="#" class="hover:text-teal-500 transition">Tentang Kami</a></li>
                        <li><a href="#dokter" class="hover:text-teal-500 transition">Tim Dokter</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-teal-500 transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <!-- CONTACT -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-800 mb-4">Kontak</h4>
                    <ul class="space-y-3 text-xs text-slate-500">

                        @if($clinic->address ?? false)
                            <li class="flex items-start gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4 text-teal-500 shrink-0 mt-0.5"></i>
                                {{ $clinic->address }}{{ $clinic->city ? ', ' . $clinic->city : '' }}
                            </li>
                        @endif

                        @if($clinic->clinic_phone ?? false)
                            <li class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4 text-teal-500"></i>
                                {{ $clinic->clinic_phone }}
                            </li>
                        @endif

                        @if($clinic->clinic_email ?? false)
                            <li class="flex items-center gap-2">
                                <i data-lucide="mail" class="w-4 h-4 text-teal-500"></i>
                                {{ $clinic->clinic_email }}
                            </li>
                        @endif

                        @if($clinic->open_days ?? false)
                            <li class="flex items-center gap-2">
                                <i data-lucide="clock-3" class="w-4 h-4 text-teal-500"></i>
                                {{ $clinic->open_days }}, {{ \Illuminate\Support\Carbon::parse($clinic->open_time)->format('H:i') }} - {{ \Illuminate\Support\Carbon::parse($clinic->close_time)->format('H:i') }}
                            </li>
                        @endif

                    </ul>
                </div>

            </div>

            <div class="border-t border-slate-100 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

                <p class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} {{ $clinic->clinic_name ?? 'DigitalCare' }}. Seluruh hak cipta dilindungi.
                </p>

                <div class="flex items-center gap-3">

                    @if($clinic->instagram ?? false)
                        <a href="{{ $clinic->instagram }}" target="_blank" class="w-9 h-9 rounded-full bg-teal-50 flex items-center justify-center hover:bg-teal-100 transition">
                            <i data-lucide="instagram" class="w-4 h-4 text-teal-500"></i>
                        </a>
                    @endif

                    @if($clinic->facebook ?? false)
                        <a href="{{ $clinic->facebook }}" target="_blank" class="w-9 h-9 rounded-full bg-teal-50 flex items-center justify-center hover:bg-teal-100 transition">
                            <i data-lucide="facebook" class="w-4 h-4 text-teal-500"></i>
                        </a>
                    @endif

                    @if($clinic->twitter ?? false)
                        <a href="{{ $clinic->twitter }}" target="_blank" class="w-9 h-9 rounded-full bg-teal-50 flex items-center justify-center hover:bg-teal-100 transition">
                            <i data-lucide="twitter" class="w-4 h-4 text-teal-500"></i>
                        </a>
                    @endif

                    @if($clinic->youtube ?? false)
                        <a href="{{ $clinic->youtube }}" target="_blank" class="w-9 h-9 rounded-full bg-teal-50 flex items-center justify-center hover:bg-teal-100 transition">
                            <i data-lucide="youtube" class="w-4 h-4 text-teal-500"></i>
                        </a>
                    @endif

                </div>

            </div>

        </div>

    </footer>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>