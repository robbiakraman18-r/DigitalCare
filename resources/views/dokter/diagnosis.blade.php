@extends('layouts.dokter')


@section('content')

<div class="min-h-screen bg-transparent p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-[35px] border border-sky-100 shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-10 py-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-black tracking-wide">FORM DIAGNOSA DOKTER</h1>
                    <p class="mt-2 text-cyan-100 text-lg">Pemeriksaan</p>
                </div>
                <div class="bg-white/20 px-6 py-4 rounded-3xl text-sm space-y-2">
                    <div><span class="font-semibold">Medical Record :</span> {{ $appointment->no_rekam_medis ?? 'DCM26-' . $appointment->id_janji }}</div>
                    <div><span class="font-semibold">Date :</span> {{ \Carbon\Carbon::parse($appointment->tanggal_janji)->format('d M Y') }}</div>
                    <div><span class="font-semibold">Time :</span> {{ \Carbon\Carbon::parse($appointment->jam_janji)->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-8 space-y-8">

            <form method="POST" action="{{ route('dokter.diagnosis.store', $appointment->id_janji) }}" id="form-diagnosis">
                @csrf

                <!-- PATIENT INFO -->
                <div class="bg-sky-50 border border-sky-100 rounded-[30px] p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center text-xl">👤</div>
                        <h2 class="text-2xl font-bold text-slate-800">Patient Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- LEFT — hanya tampilan, tidak di-submit -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-semibold">Patient Name</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->user->nama ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Date of Birth</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->birth_date ? \Carbon\Carbon::parse($appointment->pasien->birth_date)->format('d M Y') : '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Gender</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->gender ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                        </div>

                        <!-- RIGHT — semua readonly -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-semibold">Doctor Name</label>
                                {{-- ✅ FIX #2: readonly ditambahkan --}}
                                <input type="text"
                                    value="{{ $appointment->dokter->user->nama ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Department</label>
                                <input type="text"
                                    value="{{ $appointment->dokter->spesialisasi ?? 'Internal Medicine' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Visit Type</label>
                                <input type="text"
                                    value="{{ $appointment->jenis_kunjungan ?? 'General Consultation' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- MAIN GRID -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-8">

                    <!-- LEFT -->
                    <div class="space-y-6">

                        <!-- ANAMNESIS -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Anamnesis</h3>
                            {{-- ✅ FIX #1: trim() + tidak ada spasi di dalam tag --}}
                            <textarea name="keluhan" rows="5"
                                class="w-full rounded-2xl border px-5 py-4 bg-slate-50">{{ trim($appointment->keluhan_utama) }}</textarea>
                        </div>

                        <!-- HISTORY -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Medical History</h3>
                            <textarea name="riwayat_medis" rows="4"
                                class="w-full rounded-2xl border px-5 py-4 bg-slate-50">{{ trim($appointment->riwayat_medis ?? 'No history of chronic disease.') }}</textarea>
                        </div>

                        <!-- PHYSICAL EXAMINATION -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Physical Examination</h3>
                            <div class="grid grid-cols-2 gap-4">
                                    <!-- Temperature -->
                                <div class="relative">
                                    <input
                                        type="number"
                                        step="0.1"
                                        name="temperature"
                                        placeholder="Temperature"
                                        class="w-full rounded-2xl border px-4 py-3 pr-14 bg-slate-50">

                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        °C
                                    </span>
                                </div>
                                    <!-- Blood Pressure -->
                                <div class="relative flex items-center">
                                    <input
                                        type="text"
                                        name="blood_pressure"
                                        placeholder="Blood Pressure"
                                        class="w-full rounded-2xl border px-4 py-3 pr-20 bg-slate-50">
                                    <span class="absolute right-5 text-slate-500">
                                        mmHg
                                    </span>
                                </div>
                                    <!-- Heart Rate -->
                                <div class="relative">
                                    <input
                                        type="number"
                                        name="heart_rate"
                                        placeholder="Heart Rate"
                                        class="w-full rounded-2xl border px-4 py-3 pr-16 bg-slate-50">

                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        bpm
                                    </span>
                                </div>

                                <!-- Respiratory -->
                                <div class="relative">
                                    <input
                                        type="number"
                                        name="respiratory_rate"
                                        placeholder="Respiratory Rate"
                                        class="w-full rounded-2xl border px-4 py-3 pr-20 bg-slate-50">

                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        x/min
                                    </span>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    <!-- RIGHT -->
                    <div class="space-y-6">

                        <!-- DIAGNOSIS -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Diagnosis</h3>
                            <label class="text-sm font-semibold">
                                Final Diagnosis <span class="text-red-500">*</span>
                            </label>
                            {{-- ✅ FIX #4: required --}}
                            <input type="text" name="diagnosa" required
                                placeholder="Masukkan diagnosis akhir..."
                                class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-50">
                        </div>

                        <!-- PRESCRIPTION -->
                        <div class="bg-emerald-50 border border-emerald-100 rounded-[30px] p-6">
                            <h3 class="text-xl font-bold text-emerald-700 mb-5">Prescription</h3>

                            <div id="resep-container" class="space-y-3">
                                {{-- Baris pertama tidak bisa dihapus --}}
                                <div class="resep-row grid grid-cols-4 gap-3">
                                    {{-- ✅ FIX #5: nama_obat[] baris pertama required --}}
                                    <input type="text" name="nama_obat[]" placeholder="Medicine Name" required
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="text" name="dosis[]" placeholder="Dosage"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="number" name="jumlah[]" placeholder="Qty" min="1"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="text" name="aturan_pakai[]" placeholder="Usage"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" onclick="tambahObat()"
                                    class="px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">
                                    + Add Medicine
                                </button>
                            </div>
                        </div>

                        <!-- NOTES -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Additional Notes</h3>
                            <textarea name="catatan_dokter" rows="4"
                                class="w-full rounded-2xl border px-5 py-4 bg-slate-50"></textarea>
                        </div>

                    </div>

                </div>

                <!-- SUBMIT -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-5 rounded-3xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-lg hover:opacity-90 transition">
                        Save Diagnosis Report
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function tambahObat() {
    const html = `
        <div class="resep-row grid grid-cols-4 gap-3 relative">
            <input type="text" name="nama_obat[]" placeholder="Medicine Name"
                class="rounded-2xl border px-4 py-3 bg-white">
            <input type="text" name="dosis[]" placeholder="Dosage"
                class="rounded-2xl border px-4 py-3 bg-white">
            <input type="number" name="jumlah[]" placeholder="Qty" min="1"
                class="rounded-2xl border px-4 py-3 bg-white">
            <div class="relative">
                <input type="text" name="aturan_pakai[]" placeholder="Usage"
                    class="w-full rounded-2xl border px-4 py-3 bg-white">
                <button type="button" onclick="hapusObat(this)"
                    class="absolute -top-2 -right-2 w-6 h-6 bg-red-400 hover:bg-red-600 text-white rounded-full text-xs font-bold leading-none">
                    ×
                </button>
            </div>
        </div>
    `;
    document.getElementById('resep-container').insertAdjacentHTML('beforeend', html);
}

function hapusObat(btn) {
    btn.closest('.resep-row').remove();
}
</script>

@endsection