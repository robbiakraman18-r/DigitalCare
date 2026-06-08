@extends('layouts.dokter')

@section('title', 'Pemeriksaan')
@section('subtitle', 'Pilih pasien dari appointment untuk memulai pemeriksaan')

@section('content')

<div class="space-y-6">

    <!-- MAIN CARD -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="relative bg-gradient-to-r from-teal-500 via-cyan-500 to-sky-500 px-6 py-6 text-white">

            <!-- decorative blur -->
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,white,transparent)]"></div>

            <div class="relative">
                <h2 class="text-2xl font-bold tracking-tight">Pemeriksaan Pasien</h2>
                <p class="text-sm text-white/80 mt-1">
                    Pilih pasien dari appointment untuk memulai proses pemeriksaan medis
                </p>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-8">

            <!-- EMPTY STATE -->
            <div class="flex flex-col items-center justify-center text-center py-16">

                <!-- ICON CARD -->
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-teal-50 to-cyan-50
                            flex items-center justify-center shadow-sm border border-slate-100 mb-5">

                    <svg class="w-9 h-9 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19.428 15.341A8 8 0 118 4.928M12 12v.01" />
                    </svg>
                </div>

                <!-- TITLE -->
                <h3 class="text-xl font-semibold text-slate-800">
                    Belum ada pasien dipilih
                </h3>

                <p class="text-sm text-slate-500 mt-2 max-w-md leading-relaxed">
                    Silakan pilih pasien dari daftar appointment hari ini untuk memulai pemeriksaan.
                    Sistem akan otomatis menampilkan data medis pasien setelah dipilih.
                </p>

                <!-- ACTIONS -->
                <div class="mt-6 flex flex-wrap gap-3 justify-center">

                    <a href="{{ route('dokter.appointment') }}"
                       class="px-5 py-2.5 rounded-xl bg-teal-500 text-white text-sm font-medium
                              shadow-sm hover:shadow-md hover:bg-teal-600 active:scale-[0.98]
                              transition-all duration-200">
                        Appointment Hari Ini
                    </a>

                    <a href="{{ route('dokter.appointment') }}"
                       class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-sm font-medium
                              hover:bg-slate-200 active:scale-[0.98]
                              transition-all duration-200">
                        Semua Appointment
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection