{{--
    Sesuaikan @extends() di bawah dengan nama layout admin kamu
    kalau ternyata bukan 'layouts.admin'.
--}}
@extends('layouts.admin')

@section('content')
<div class="p-6 md:p-10 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Complaint</h1>
        <p class="text-slate-400 text-sm">Kelola komplain yang masuk dari pasien &amp; dokter</p>
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

    {{-- FILTER TABS --}}
    <div class="flex flex-wrap gap-2">
        <a href="{{ url()->current() }}"
           class="px-4 py-2 rounded-2xl text-sm font-medium transition
           {{ request('status') ? 'bg-white text-slate-500 border border-slate-200' : 'bg-teal-500 text-white shadow-lg shadow-teal-200' }}">
            Semua
        </a>
        <a href="{{ url()->current() }}?status=pending"
           class="px-4 py-2 rounded-2xl text-sm font-medium transition
           {{ request('status') == 'pending' ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'bg-white text-slate-500 border border-slate-200' }}">
            Pending <span class="opacity-70">({{ $countPending }})</span>
        </a>
        <a href="{{ url()->current() }}?status=in_progress"
           class="px-4 py-2 rounded-2xl text-sm font-medium transition
           {{ request('status') == 'in_progress' ? 'bg-blue-500 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-500 border border-slate-200' }}">
            In Progress <span class="opacity-70">({{ $countInProgress }})</span>
        </a>
        <a href="{{ url()->current() }}?status=resolved"
           class="px-4 py-2 rounded-2xl text-sm font-medium transition
           {{ request('status') == 'resolved' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-500 border border-slate-200' }}">
            Resolved <span class="opacity-70">({{ $countResolved }})</span>
        </a>
        <a href="{{ url()->current() }}?status=closed"
           class="px-4 py-2 rounded-2xl text-sm font-medium transition
           {{ request('status') == 'closed' ? 'bg-slate-500 text-white shadow-lg shadow-slate-200' : 'bg-white text-slate-500 border border-slate-200' }}">
            Closed <span class="opacity-70">({{ $countClosed }})</span>
        </a>
    </div>

    {{-- LIST --}}
    <div class="space-y-4">
        @forelse($complaints as $complaint)
            <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-md border border-slate-100 p-5">

                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-slate-800">
                                {{ $complaint->user->nama ?? 'User telah dihapus' }}
                            </span>
                            @if($complaint->user)
                                <span class="text-[11px] uppercase tracking-wide text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">
                                    {{ $complaint->user->role }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-500">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                    </div>

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

                @if(!in_array($complaint->status, ['closed']))
                    <div class="mt-4">
                        <button @click="open = !open" class="text-sm font-medium text-teal-600 hover:underline">
                            <span x-show="!open">Tangani complaint ini</span>
                            <span x-show="open">Tutup form</span>
                        </button>

                        <form x-show="open" method="POST" action="{{ url('/admin/complaint/' . $complaint->id) }}" class="mt-3 space-y-3">
                            @csrf
                            @method('PUT')

                            <textarea name="response" rows="3" placeholder="Tulis tanggapan/solusi untuk komplain ini..."
                                class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400"
                            >{{ $complaint->response }}</textarea>

                            <div class="flex flex-wrap gap-3 items-center">
                                <select name="status" class="rounded-xl border border-slate-200 px-3 py-2 text-sm">
                                    <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>
                                        In Progress (sedang ditangani)
                                    </option>
                                    <option value="resolved">Resolved (sudah dikasih solusi)</option>
                                </select>

                                <button type="submit"
                                    class="px-5 py-2 rounded-xl bg-teal-500 text-white text-sm font-medium shadow-lg shadow-teal-200 hover:bg-teal-600 transition">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="mt-3 text-xs text-slate-400 italic">
                        Complaint ini sudah dikonfirmasi selesai oleh pengirim
                        @if($complaint->confirmed_at)
                            pada {{ $complaint->confirmed_at->format('d M Y, H:i') }}
                        @endif
                        .
                    </p>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-10 text-center text-slate-400">
                Belum ada complaint yang masuk.
            </div>
        @endforelse
    </div>

</div>
@endsection