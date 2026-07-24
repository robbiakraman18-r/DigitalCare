@extends('layouts.pasien')

@section('content')

<div class="w-full max-w-[1400px] mx-auto p-4 sm:p-6 lg:p-8 transition-all duration-300">

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-center gap-3 text-sm animate-fade-in">
            <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 text-red-500"></i>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 text-sm animate-fade-in">
            <i data-lucide="check-circle" class="w-5 h-5 shrink-0 text-emerald-500"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center border border-slate-200 shadow-sm shrink-0">
            <i data-lucide="calendar" class="w-6 h-6 text-slate-700"></i>
        </div>
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">Buat Janji Temu</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-0.5">Lengkapi data di bawah ini untuk membuat janji temu Anda</p>
        </div>
    </div>

    <form action="{{ route('pasien.buat-janji.store') }}" method="POST" class="w-full">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">
            
            {{-- 1. Personal Information --}}
            <div class="lg:col-span-2 bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        1
                    </div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">Data Diri</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-5">
                    <div class="sm:col-span-3">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Nama</label>
                        <input type="text" 
                               value="{{ Auth::user()->nama }}" 
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">No. ID</label>
                        <input type="text" 
                               value="{{ Auth::user()->id_pasien ?? Auth::id() }}" 
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Tanggal Lahir</label>
                        <input type="text" 
                               value="{{ Auth::user()->pasien->birth_date ?? '-' }}"
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Jenis Kelamin</label>
                        <input type="text" 
                               value="{{ Auth::user()->pasien->gender ?? '-' }}" 
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                            NIK
                        </label>
                        <input type="text"
                            value="{{ Auth::user()->pasien->nik ?? '-' }}"
                            class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm"
                            readonly>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                            Nomor Telepon
                        </label>
                        <input type="text"
                            value="{{ Auth::user()->pasien->phone_number ?? '-' }}"
                            class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm"
                            readonly>
                    </div>

                    <div class="sm:col-span-4">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                            Alamat
                        </label>
                        <textarea
                            rows="3"
                            class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm resize-none"
                            readonly>{{ Auth::user()->pasien->address ?? '-' }}</textarea>
                    </div>

                    <div class="sm:col-span-4">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Email</label>
                        <input type="email" 
                               value="{{ Auth::user()->email }}" 
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>
                </div>
            </div>

            {{-- 2. Appointment Details --}}
            <div class="lg:col-span-3 bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-800">Detail Janji Temu</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="tanggal_janji" class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Pilih Tanggal</label>
                            <input type="date" 
                                   name="tanggal_janji" 
                                   id="tanggal_janji"
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ old('tanggal_janji') }}"
                                   class="w-full px-4 py-2.5 sm:py-3 border @error('tanggal_janji') border-red-500 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 text-slate-700 text-sm" 
                                   required>
                            @error('tanggal_janji')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Select Doctor --}}
                        <div>

                            <label
                                class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                                Pilih Dokter
                            </label>
                            <select
                                name="id_dokter"
                                id="id_dokter"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl">
                                <option value="">
                                    Pilih Dokter
                                </option>
                                @foreach($dokters as $dokter)
                                    <option
                                        value="{{ $dokter->id_dokter }}">
                                        {{ $dokter->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Select Time --}}
                        <div class="mt-4">
                            <label
                                class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                                Pilih Waktu
                            </label>
                            <select
                                name="id_jadwal"
                                id="id_jadwal"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl"
                                required>
                                <option value="">
                                    Pilih Waktu
                                </option>
                                @foreach($dokters as $dokter)
                                    @foreach($dokter->jadwalDokter as $jadwal)
                                        <option
                                            value="{{ $jadwal->id_jadwal }}"
                                            data-tanggal="{{ $jadwal->tanggal }}"
                                            data-dokter="{{ $dokter->id_dokter }}">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                            • Sisa
                                            {{ $jadwal->kuota_harian-$jadwal->terisi }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 3. Visit Details --}}
                <div class="mt-8 border-t border-slate-100 pt-6">
                    <div class="h-full flex flex-col">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                                3
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-slate-800">Detail Kunjungan</h2>
                        </div>

                        <div class="flex-1 flex flex-col">
                            <label for="keluhan_utama" class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Keluhan / Alasan Kunjungan</label>
                            <textarea name="keluhan_utama" 
                                    id="keluhan_utama" 
                                    class="w-full flex-1 min-h-[150px] lg:min-h-[120px] px-4 py-2.5 sm:py-3 border @error('keluhan_utama') border-red-500 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 text-slate-700 text-sm resize-none" 
                                    placeholder="Tuliskan keluhan atau alasan kunjungan Anda di sini..." 
                                    required>{{ old('keluhan_utama') }}</textarea>
                            @error('keluhan_utama')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
                {{-- Footer Action --}}
                <div class="mt-8 col-span-full w-full">
                    <button
                        type="submit"
                        class="w-full bg-emerald-500 hover:bg-emerald-600
                            text-white font-bold py-4 rounded-2xl
                            shadow-lg shadow-emerald-100
                            flex items-center justify-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <span>Buat Janji Temu</span>
                    </button>
                </div>
            </div>
    </form>
</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tanggal = document.getElementById('tanggal_janji');
    const dokter  = document.getElementById('id_dokter');
    const jadwal  = document.getElementById('id_jadwal');

    // Simpan semua option jam
    const semuaOption = [...jadwal.options].slice(1);

    function filterJam() {

        jadwal.innerHTML =
            '<option value="">Pilih Waktu</option>';

        semuaOption.forEach(function(option){

            if(
                option.dataset.tanggal === tanggal.value &&
                option.dataset.dokter === dokter.value
            ){

                jadwal.appendChild(option.cloneNode(true));

            }

        });

    }

    tanggal.addEventListener('change', filterJam);

    dokter.addEventListener('change', filterJam);

});

</script>
@endsection