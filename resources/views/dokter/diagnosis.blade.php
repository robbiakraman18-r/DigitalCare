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
                    {{-- FIX: kolom no_rekam_medis tidak ada di tabel appointments,
                         jadi langsung pakai format DCM26-{id_janji} tanpa akses kolom yang tidak ada --}}
                    <div><span class="font-semibold">No. Rekam Medis :</span> DCM26-{{ $appointment->id_janji }}</div>
                    <div><span class="font-semibold">Tanggal :</span> {{ \Carbon\Carbon::parse($appointment->tanggal_janji)->format('d M Y') }}</div>
                    {{-- FIX: kolom di tabel appointments bernama jam_konsultasi, bukan jam_janji --}}
                    <div><span class="font-semibold">Waktu :</span> {{ \Carbon\Carbon::parse($appointment->jam_konsultasi)->format('H:i') }} WIB</div>
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
                        <h2 class="text-2xl font-bold text-slate-800">Informasi Pasien</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- LEFT — hanya tampilan, tidak di-submit -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-semibold">Nama Pasien</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->user->nama ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Tanggal Lahir</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->birth_date ? \Carbon\Carbon::parse($appointment->pasien->birth_date)->format('d M Y') : '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="text-sm font-semibold">Jenis Kelamin</label>
                                <input type="text"
                                    value="{{ $appointment->pasien->gender ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                        </div>

                        <!-- RIGHT — semua readonly -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-semibold">Nama Dokter</label>
                                <input type="text"
                                    value="{{ $appointment->dokter->user->nama ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            {{-- FIX: tabel dokters tidak punya kolom spesialisasi, jadi field ini
                                 diganti jadi No. SIP (kolom yang memang ada) --}}
                            <div>
                                <label class="text-sm font-semibold">No. SIP</label>
                                <input type="text"
                                    value="{{ $appointment->dokter->no_sip ?? '-' }}"
                                    readonly
                                    class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-100 text-slate-500 cursor-not-allowed">
                            </div>
                            {{-- FIX: tabel appointments tidak punya kolom jenis_kunjungan,
                                 field ini diganti menampilkan Status Janji (status_janji) yang memang ada --}}
                            <div>
                                <label class="text-sm font-semibold">Status Janji</label>
                                <input type="text"
                                    value="{{ ucfirst(str_replace('_', ' ', $appointment->status_janji)) ?? '-' }}"
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
                            <textarea name="keluhan" rows="5"
                                class="w-full rounded-2xl border px-5 py-4 bg-slate-50">{{ trim($appointment->keluhan_utama) }}</textarea>
                        </div>

                        {{-- DIHAPUS: section "Medical History" (riwayat_medis) dihapus karena
                             tidak ada kolom riwayat_medis baik di tabel appointments maupun rekam_medis.
                             Kalau field ini tetap dikirim (name="riwayat_medis"), insert ke rekam_medis
                             akan gagal dengan error "Unknown column". --}}

                        {{-- DIHAPUS: section "Physical Examination" (temperature, blood_pressure,
                             heart_rate, respiratory_rate) dihapus karena tabel rekam_medis tidak
                             punya kolom untuk menyimpan data vital sign ini. --}}

                    </div>
                    <!-- RIGHT -->
                    <div class="space-y-6">

                        <!-- DIAGNOSIS -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Diagnosis</h3>
                            <label class="text-sm font-semibold">
                                Final Diagnosis <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="diagnosa" required
                                placeholder="Masukkan diagnosis akhir..."
                                class="mt-2 w-full rounded-2xl border px-5 py-4 bg-slate-50">
                        </div>

                        <!-- PRESCRIPTION -->
                        <div class="bg-emerald-50 border border-emerald-100 rounded-[30px] p-6">
                            <h3 class="text-xl font-bold text-emerald-700 mb-5">Resep Obat</h3>

                            <div id="resep-container" class="space-y-3">
                                {{-- Baris pertama tidak bisa dihapus --}}
                                <div class="resep-row grid grid-cols-4 gap-3">
                                    <input type="text" name="nama_obat[]" placeholder="Nama Obat" required
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="text" name="dosis[]" placeholder="Dosis"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="number" name="jumlah[]" placeholder="Jumlah" min="1"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                    <input type="text" name="aturan_pakai[]" placeholder="Aturan Pakai"
                                        class="rounded-2xl border px-4 py-3 bg-white">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" onclick="tambahObat()"
                                    class="px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">
                                    + Tambah Obat
                                </button>
                            </div>
                        </div>

                        <!-- NOTES -->
                        <div class="bg-white border rounded-[30px] p-6 shadow-sm">
                            <h3 class="text-xl font-bold mb-5">Catatan Tambahan</h3>
                            <textarea name="catatan_dokter" rows="4"
                                class="w-full rounded-2xl border px-5 py-4 bg-slate-50"></textarea>
                        </div>

                    </div>

                </div>

                <!-- SUBMIT -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-5 rounded-3xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-lg hover:opacity-90 transition">
                        Simpan Diagnosis
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
            <input type="text" name="nama_obat[]" placeholder="Nama Obat" 
                class="rounded-2xl border px-4 py-3 bg-white">
            <input type="text" name="dosis[]" placeholder="Dosis"
                class="rounded-2xl border px-4 py-3 bg-white">
            <input type="number" name="jumlah[]" placeholder="Jumlah" min="1"
                class="rounded-2xl border px-4 py-3 bg-white">
            <div class="relative">
                <input type="text" name="aturan_pakai[]" placeholder="Aturan Pakai"
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