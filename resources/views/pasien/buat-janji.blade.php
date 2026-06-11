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
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">Make Appointment</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-0.5">Fill in the details below to book your appointment</p>
        </div>
    </div>

    <form action="{{ route('pasien.buat-janji.store') }}" method="POST" class="w-full">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
            
            {{-- 1. Personal Information --}}
            <div class="lg:col-span-3 bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                        1
                    </div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">Personal Information</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-5">
                    <div class="sm:col-span-3">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Name</label>
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
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Date of Birth</label>
                        <input type="text" 
                               value="{{ Auth::user()->pasien->birth_date ?? '-' }}"
                               class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm" 
                               readonly>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Gender</label>
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
                            Phone Number
                        </label>
                        <input type="text"
                            value="{{ Auth::user()->pasien->phone_number ?? '-' }}"
                            class="w-full px-4 py-2.5 sm:py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-400 cursor-not-allowed focus:outline-none text-sm"
                            readonly>
                    </div>

                    <div class="sm:col-span-4">
                        <label class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">
                            Address
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
            <div class="lg:col-span-1 bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            2
                        </div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-800">Appointment Details</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="tanggal_janji" class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Select Date</label>
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

                        <div>
                            <label for="id_jadwal" class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Select Doctor & Schedule</label>
                            <select name="id_jadwal" 
                                    id="id_jadwal" 
                                    class="w-full px-4 py-2.5 sm:py-3 border @error('id_jadwal') border-red-500 @else border-slate-200 @enderror rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-emerald-400 text-slate-700 text-sm" 
                                    required>
                                <option value="">Select Doctor</option>
                                @if(isset($dokters) && $dokters->count() > 0)
                                    @foreach($dokters as $dokter)
                                        @foreach($dokter->jadwalDokter as $jadwal)
                                            {{-- Menyimpan data tanggal pada atribut data-tanggal untuk difilter oleh JS --}}
                                            <option value="{{ $jadwal->id_jadwal }}" 
                                                    data-tanggal="{{ $jadwal->tanggal }}"
                                                    {{ old('id_jadwal') == $jadwal->id_jadwal ? 'selected' : '' }}>
                                                Dr. {{ $dokter->user->nama ?? 'Unknown' }} @if(!empty($dokter->user->spesialis)) ({{ $dokter->user->spesialis }}) @endif 
                                                — Jam {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                                (Sisa Kuota: {{ $jadwal->kuota_harian - $jadwal->terisi }})
                                            </option>
                                        @endforeach
                                    @endforeach
                                @else
                                    <option value="" disabled>No doctors with active schedules</option>
                                @endif
                            </select>
                            @error('id_jadwal')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Visit Details --}}
            <div class="lg:col-span-2 bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-sm flex flex-col justify-between">
                <div class="h-full flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm shrink-0">
                            3
                        </div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-800">Visit Details</h2>
                    </div>

                    <div class="flex-1 flex flex-col">
                        <label for="keluhan_utama" class="text-xs sm:text-sm font-semibold text-slate-700 block mb-1.5">Reason for Visit</label>
                        <textarea name="keluhan_utama" 
                                  id="keluhan_utama" 
                                  class="w-full flex-1 min-h-[150px] lg:min-h-[120px] px-4 py-2.5 sm:py-3 border @error('keluhan_utama') border-red-500 @else border-slate-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 text-slate-700 text-sm resize-none" 
                                  placeholder="Write your symptoms or reason here..." 
                                  required>{{ old('keluhan_utama') }}</textarea>
                        @error('keluhan_utama')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full bg-emerald-500 hover:bg-emerald-600 active:scale-[0.99] text-white font-bold py-3.5 sm:py-4 rounded-xl shadow-lg shadow-emerald-100 flex items-center justify-center gap-3 transition-all duration-200 text-sm sm:text-base">
                <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                </div>
                <span>Book Appointment</span>
            </button>
        </div>

    </form>
</div>

{{-- JavaScript Dinamis Filter Tanggal & Dokter --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputTanggal = document.getElementById('tanggal_janji');
    const selectJadwal = document.getElementById('id_jadwal');
    const optionsJadwal = Array.from(selectJadwal.querySelectorAll('option')).filter(opt => opt.value !== "");

    function filterSchedules() {
        const tanggalTerpilih = inputTanggal.value;
        
        // Bersihkan opsi dropdown terlebih dahulu
        selectJadwal.innerHTML = '<option value="">Select Doctor</option>';
        
        let adaJadwal = false;

        if (tanggalTerpilih) {
            optionsJadwal.forEach(option => {
                // Ambil data-tanggal dari option tag
                const tanggalJadwal = option.getAttribute('data-tanggal');
                
                if (tanggalJadwal === tanggalTerpilih) {
                    selectJadwal.appendChild(option.cloneNode(true));
                    adaJadwal = true;
                }
            });
        }

        if (!adaJadwal && tanggalTerpilih) {
            const noScheduleOpt = document.createElement('option');
            noScheduleOpt.value = "";
            noScheduleOpt.disabled = true;
            noScheduleOpt.textContent = "No doctors available on this date";
            selectJadwal.appendChild(noScheduleOpt);
        }
    }

    // Jalankan filter saat halaman pertama kali dimuat (jika ada data 'old')
    if (inputTanggal.value) {
        filterSchedules();
    }

    // Jalankan filter setiap kali elemen input tanggal berubah
    inputTanggal.addEventListener('change', filterSchedules);
});
</script>
@endsection