@extends('layouts.pasien')

@section('content')
@section('title', 'Halo, Rizki 👋')
@section('subtitle', 'Selamat datang kembali di DigitalCare')

<!-- HERO -->
<div class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-teal-500 to-cyan-500 p-8 lg:p-10 shadow-2xl shadow-teal-200">

    <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center">

        <!-- LEFT -->
        <div>

            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-lg border border-white/20 text-white text-sm mb-6">

                <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>

                Sistem kesehatan aktif

            </div>

            <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                Kelola kesehatan Anda dengan lebih mudah
            </h1>

            <p class="text-white/90 mt-5 leading-relaxed max-w-xl">
                Booking dokter, lihat rekam medis, resep obat,
                dan notifikasi klinik dalam satu dashboard modern.
            </p>

            <div class="flex flex-wrap gap-4 mt-8">

                <a href="/buat-janji"
                class="px-6 py-3 rounded-2xl bg-white text-teal-600 font-semibold shadow-lg hover:scale-105 transition">

                    Buat Janji

                </a>

                <a href="/rekam-medis"
                class="px-6 py-3 rounded-2xl border border-white/40 text-white font-semibold hover:bg-white/10 transition">

                    Rekam Medis

                </a>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative flex justify-center">

            <img
            src="https://cdn-icons-png.flaticon.com/512/3304/3304567.png"
            class="w-full max-w-[340px] drop-shadow-2xl relative z-10">

            <!-- FLOAT -->
            <div class="absolute top-5 left-0 bg-white p-4 rounded-3xl shadow-2xl animate-bounce">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center">
                        <i data-lucide="calendar-check-2" class="text-green-500"></i>
                    </div>

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Booking Berhasil
                        </h3>

                        <p class="text-sm text-slate-400">
                            Jadwal dikonfirmasi
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

    <!-- REKAM MEDIS -->
    <div class="bg-white rounded-3xl p-6 shadow-lg border border-white">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Rekam Medis
                </p>

                <h2 class="text-4xl font-bold text-slate-800 mt-2">
                    5
                </h2>

            </div>

            <div class="w-16 h-16 rounded-3xl bg-green-100 flex items-center justify-center">
                <i data-lucide="file-heart" class="text-green-500 w-8 h-8"></i>
            </div>

        </div>

    </div>

    <!-- NOTIFIKASI -->
    <div class="bg-white rounded-3xl p-6 shadow-lg border border-white">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-slate-400 text-sm">
                    Notifikasi
                </p>

                <h2 class="text-4xl font-bold text-slate-800 mt-2">
                    3
                </h2>

            </div>

            <div class="w-16 h-16 rounded-3xl bg-yellow-100 flex items-center justify-center">
                <i data-lucide="bell-ring" class="text-yellow-500 w-8 h-8"></i>
            </div>

        </div>

    </div>

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

@endsection