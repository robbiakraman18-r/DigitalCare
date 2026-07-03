@if($notifikasiListPasien->isEmpty())

    <div class="p-6 text-center text-slate-400">
        Tidak ada notifikasi
    </div>

@else

    @foreach($notifikasiListPasien as $notif)

    <a href="{{ route('pasien.notifikasi.read', $notif) }}"
       class="flex gap-4 px-5 py-4 hover:bg-slate-50 transition border-b border-slate-100">

        <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0
            @switch($notif->tipe)
                @case('appointment') bg-teal-100 @break
                @case('rekam_medis') bg-emerald-100 @break
                @case('komplain') bg-amber-100 @break
                @default bg-slate-100
            @endswitch
        ">

            @switch($notif->tipe)

                @case('appointment')
                    <i data-lucide="calendar-check" class="w-5 h-5 text-teal-500"></i>
                    @break

                @case('rekam_medis')
                    <i data-lucide="file-text" class="w-5 h-5 text-emerald-500"></i>
                    @break

                @case('komplain')
                    <i data-lucide="message-circle" class="w-5 h-5 text-amber-500"></i>
                    @break

                @default
                    <i data-lucide="bell" class="w-5 h-5 text-slate-500"></i>

            @endswitch

        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-sm text-slate-800">{{ $notif->judul }}</h3>
                <span class="text-[11px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-sm text-slate-500 mt-1">{{ $notif->pesan }}</p>
        </div>

    </a>

    @endforeach

@endif