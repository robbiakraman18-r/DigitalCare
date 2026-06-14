{{-- resources/views/dokter/rekam-medis.blade.php --}}
@extends('layouts.dokter')

@section('title', 'Rekam Medis')
@section('subtitle', 'Riwayat pemeriksaan pasien')

@section('content')
<div class="space-y-5">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">

            {{-- Tombol kembali kalau dari halaman pasien --}}
            @if(request('id_pasien'))
            <a href="{{ route('dokter.pasien') }}"
               class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition shrink-0">
                <i data-lucide="arrow-left" class="w-4 h-4 text-slate-500"></i>
            </a>
            @endif

            <div>
                <h1 class="text-xl font-bold text-slate-800">
                    @if($filterPasien)
                        Rekam Medis &mdash; {{ $filterPasien->user->name ?? 'Pasien' }}
                    @else
                        Rekam Medis
                    @endif
                </h1>
                <p class="text-xs text-slate-400 mt-0.5">
                    {{ $rekamMedis->total() }} catatan ditemukan
                </p>
            </div>
        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('dokter.rekammedis') }}" class="flex items-center gap-2 flex-wrap">
            @if(request('id_pasien'))
                <input type="hidden" name="id_pasien" value="{{ request('id_pasien') }}">
            @endif

            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input
                    type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari diagnosis..."
                    class="pl-9 pr-4 py-2.5 text-sm border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-teal-300 w-52 bg-white"
                >
            </div>

            <input
                type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="text-sm border border-slate-200 rounded-2xl px-3 py-2.5 text-slate-600 focus:outline-none focus:ring-2 focus:ring-teal-300 bg-white"
                onchange="this.form.submit()"
            >

            @if(request('id_pasien'))
            <a href="{{ route('dokter.rekammedis') }}"
               class="px-3 py-2.5 rounded-2xl border border-slate-200 text-xs text-slate-500 hover:bg-slate-50 transition whitespace-nowrap">
                Semua Pasien
            </a>
            @endif

            <button type="submit"
                class="px-4 py-2.5 rounded-2xl bg-teal-500 text-white text-xs font-semibold hover:bg-teal-600 transition">
                Cari
            </button>
        </form>
    </div>

    {{-- INFO PASIEN (kalau filter 1 pasien) --}}
    @if($filterPasien)

@php
    $nama = $filterPasien->user->name ?? 'Pasien';

    $inisial = collect(explode(' ', $nama))
        ->filter()
        ->take(2)
        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
        ->join('');

    $age = $filterPasien->birth_date
        ? \Carbon\Carbon::parse($filterPasien->birth_date)->age . ' tahun'
        : '-';
@endphp

<div class="relative overflow-hidden rounded-3xl 
            bg-gradient-to-br from-white via-teal-50/60 to-white 
            border border-teal-100/60 
            p-7 mb-7 shadow-sm">

    {{-- accent blur --}}
    <div class="absolute -top-12 -right-12 w-52 h-52 bg-teal-200/40 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-12 -left-12 w-52 h-52 bg-sky-100/40 rounded-full blur-3xl"></div>

    <div class="relative flex items-center gap-5">

        {{-- AVATAR (lebih besar) --}}
        @if($filterPasien->foto)
            <img src="{{ asset('storage/' . $filterPasien->foto) }}"
                 class="w-16 h-16 rounded-2xl object-cover border border-slate-200 shadow-sm">
        @else
            <div class="w-16 h-16 rounded-2xl 
                        bg-teal-100 border border-teal-200 
                        flex items-center justify-center 
                        text-teal-700 text-base font-bold">
                {{ $inisial }}
            </div>
        @endif

        {{-- INFO --}}
        <div class="flex-1 min-w-0">
            <h2 class="text-lg font-semibold text-slate-800 truncate">
                {{ $nama }}
            </h2>

            <p class="text-sm text-slate-600 mt-1">
                {{ $filterPasien->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                · {{ $age }}
                · {{ $filterPasien->phone_number ?? '-' }}
            </p>

            <p class="text-xs text-slate-400 mt-2">
                DigitalCare Patient Profile • Active Record
            </p>
        </div>

        {{-- ACTION --}}
        <a href="{{ route('dokter.detailpasien', $filterPasien->id_pasien) }}"
           class="px-4 py-2 rounded-xl 
                  bg-teal-500 text-white text-xs font-semibold 
                  hover:bg-teal-600 transition shadow-sm">
            Lihat Profil
        </a>

    </div>
</div>

@endif

    {{-- LIST REKAM MEDIS --}}
    <div class="space-y-4">
        @forelse($rekamMedis as $index => $rekam)
        @php
            $pasienRekam  = $rekam->appointment->pasien ?? null;
            $namaPasienRekam  = $pasienRekam->user->name ?? 'Pasien';
            $inisialRekam = collect(explode(' ', $namaPasienRekam))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
        @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

            {{-- HEADER CARD --}}
            <button
                onclick="toggleRekam('rm-{{ $rekam->id_rekam_medis }}')"
                class="w-full flex items-center gap-4 px-5 py-4 hover:bg-slate-50/80 transition text-left">

                {{-- Tanggal --}}
                <div class="w-12 h-12 rounded-xl bg-teal-50 flex flex-col items-center justify-center shrink-0">
                    <p class="text-sm font-bold text-teal-700 leading-none">
                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->format('d') }}
                    </p>
                    <p class="text-[10px] text-teal-500 leading-none mt-0.5">
                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('M Y') }}
                    </p>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        {{-- Nama pasien — tampil kalau tidak filter 1 pasien --}}
                        @if(!$filterPasien)
                        <p class="text-sm font-semibold text-slate-800">{{ $namaPasienRekam }}</p>
                        <span class="text-slate-300">·</span>
                        @endif
                        <p class="text-sm {{ $filterPasien ? 'font-semibold text-slate-800' : 'text-slate-600' }}">
                            {{ $rekam->diagnosa ?? 'Diagnosa belum diisi' }}
                        </p>
                    </div>
                    <p class="text-xs text-slate-400 mt-0.5">
                        {{ \Carbon\Carbon::parse($rekam->waktu_pemeriksaan)->translatedFormat('l, d F Y · H:i') }}
                    </p>
                    <p class="text-xs text-slate-500">
                        Dokter: {{ $rekam->dokter->user->name ?? '-' }}
                    </p>
                </div>

                @if($index === 0)
                    <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-teal-100 text-teal-700 shrink-0">Terbaru</span>
                @endif

                <i data-lucide="chevron-down"
                   class="w-4 h-4 text-slate-400 transition-transform duration-200 shrink-0"
                   id="icon-rm-{{ $rekam->id_rekam_medis }}">
                </i>
            </button>

            {{-- BODY EXPANDABLE --}}
            <div id="rm-{{ $rekam->id_rekam_medis }}" class="{{ $index === 0 ? '' : 'hidden' }}">
                <div class="border-t border-slate-100 px-5 py-5 space-y-4">

                    {{-- Link ke semua rekam medis pasien ini (kalau tampil semua) --}}
                    @if(!$filterPasien && $pasienRekam)
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center text-xs font-bold shrink-0">
                                {{ $inisialRekam }}
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-700">{{ $namaPasienRekam }}</p>
                                <p class="text-[10px] text-slate-400">
                                    {{ $pasienRekam->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    &nbsp;·&nbsp;
                                    {{ $pasienRekam->birth_date ? \Carbon\Carbon::parse($pasienRekam->birth_date)->age . ' thn' : '-' }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('dokter.rekammedis', ['id_pasien' => $pasienRekam->id_pasien]) }}"
                           class="text-xs text-teal-600 font-semibold hover:underline whitespace-nowrap">
                            Semua rekam medis →
                        </a>
                    </div>
                    @endif

                    {{-- DETAIL --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="bg-orange-50 rounded-2xl p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i data-lucide="clipboard-list" class="w-3.5 h-3.5 text-orange-500"></i>
                                <p class="text-[11px] font-semibold text-orange-600 uppercase tracking-wide">Diagnosis</p>
                            </div>
                            <p class="text-sm font-semibold text-slate-800">{{ $rekam->diagnosa ?? '-' }}</p>
                        </div>

                        <div class="bg-slate-50 rounded-2xl p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i data-lucide="message-square" class="w-3.5 h-3.5 text-slate-500"></i>
                                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Keluhan</p>
                            </div>
                            <p class="text-sm text-slate-700">{{ $rekam->keluhan ?? '-' }}</p>
                        </div>

                    </div>

                    @if($rekam->catatan_dokter)
                    <div class="bg-cyan-50 rounded-2xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="pencil-line" class="w-3.5 h-3.5 text-cyan-600"></i>
                            <p class="text-[11px] font-semibold text-cyan-600 uppercase tracking-wide">Catatan Dokter</p>
                        </div>
                        <p class="text-sm text-slate-700 leading-relaxed">{{ $rekam->catatan_dokter }}</p>
                    </div>
                    @endif

                    {{-- RESEP OBAT (pakai relasi detailResep dari model RekamMedis) --}}
                    @if($rekam->detailResep && $rekam->detailResep->count())
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="pill" class="w-3.5 h-3.5 text-purple-500"></i>
                            <p class="text-[11px] font-semibold text-slate-600 uppercase tracking-wide">Resep Obat</p>
                        </div>
                        <div class="overflow-x-auto rounded-2xl border border-slate-100">
                            <table class="w-full text-sm">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="text-left text-xs text-slate-400 font-semibold px-4 py-2.5">Nama Obat</th>
                                        <th class="text-left text-xs text-slate-400 font-semibold px-4 py-2.5">Dosis</th>
                                        <th class="text-left text-xs text-slate-400 font-semibold px-4 py-2.5">Aturan Pakai</th>
                                        <th class="text-left text-xs text-slate-400 font-semibold px-4 py-2.5">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($rekam->detailResep as $resep)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $resep->nama_obat }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $resep->dosis }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $resep->aturan_pakai }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $resep->jumlah }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <p class="text-xs text-slate-400 italic">Tidak ada resep obat pada kunjungan ini</p>
                    @endif

                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl py-16 text-center shadow-sm border border-slate-100">
            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="file-x" class="w-7 h-7 text-slate-400"></i>
            </div>
            <p class="text-sm font-medium text-slate-500">Belum ada rekam medis</p>
            <p class="text-xs text-slate-400 mt-1">Rekam medis tersimpan otomatis setelah pemeriksaan selesai</p>
        </div>
        @endforelse
    </div>

    @if($rekamMedis->hasPages())
    <div>{{ $rekamMedis->links() }}</div>
    @endif

</div>

<script>
function toggleRekam(id) {
    const el   = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    el.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endsection