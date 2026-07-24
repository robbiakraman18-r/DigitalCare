{{--
    Sesuaikan @extends() di bawah dengan nama layout pasien kamu
    kalau ternyata bukan 'layouts.pasien'.
--}}
@extends('layouts.pasien')

@section('content')
<div class="p-6 md:p-10 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">Bantuan</h1>
        <p class="text-slate-400 text-sm">Sampaikan kendala atau keluhan Anda ke admin</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 rounded-2xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-600 border border-red-200 px-4 py-3 rounded-2xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM KIRIM COMPLAINT BARU --}}
    <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
        <h2 class="font-semibold text-slate-800 mb-3">Kirim Complaint Baru</h2>
        <form method="POST" action="{{ route('pasien.complaint.store') }}" class="space-y-3">
            @csrf
            <textarea name="message" rows="3" required placeholder="Jelaskan kendala/keluhan Anda..."
                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400"></textarea>
            <button type="submit"
                class="px-5 py-2 rounded-xl bg-teal-500 text-white text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 transition">
                Kirim Complaint
            </button>
        </form>
    </div>

    {{-- RIWAYAT COMPLAINT --}}
    <div class="space-y-4">
        <h2 class="font-semibold text-slate-800">Riwayat Complaint Saya</h2>

        @forelse($complaints as $complaint)
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-5">

                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <p class="text-sm text-slate-500">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $complaint->status_color }}">
                        {{ $complaint->status_label }}
                    </span>
                </div>

                <p class="mt-3 text-slate-700">{{ $complaint->message }}</p>

                @if($complaint->response)
                    <div class="mt-3 bg-teal-50 border border-teal-100 rounded-xl p-3">
                        <p class="text-xs font-semibold text-teal-600 mb-1">Tanggapan Admin</p>
                        <p class="text-sm text-slate-700">{{ $complaint->response }}</p>
                    </div>
                @endif

                @if($complaint->status === 'resolved')
                    <form method="POST" action="{{ route('pasien.complaint.confirm', $complaint->id) }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="px-5 py-2 rounded-xl bg-emerald-500 text-white text-sm font-medium shadow-lg shadow-emerald-200 hover:bg-emerald-600 transition">
                            Konfirmasi Puas &amp; Tutup Complaint
                        </button>
                    </form>
                @elseif($complaint->status === 'closed')
                    <p class="mt-3 text-xs text-slate-400 italic">
                        Sudah dikonfirmasi selesai
                        @if($complaint->confirmed_at)
                            pada {{ $complaint->confirmed_at->format('d M Y, H:i') }}
                        @endif
                        .
                    </p>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-10 text-center text-slate-400">
                Anda belum pernah mengirim complaint.
            </div>
        @endforelse
    </div>

</div>
@endsection
