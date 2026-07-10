<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use App\Models\Notifikasi;

class AdminJadwalController extends Controller
{
    public function index(Request $request)
    {
    JadwalDokter::tutupJadwalKadaluarsa();

    $query = JadwalDokter::with('dokter.user');

    // SEARCH
    if ($request->search) {
        $query->whereHas('dokter.user', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%');
        });
    }

    // STATUS
    if ($request->status) {
        $query->where('status_jadwal', $request->status);
    }

    // 📅 FILTER TANGGAL (INI YANG KAMU BUTUH)
        if ($request->tanggal) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    $jadwal = $query
        ->orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->get();
    $dokters = Dokter::with('user')->get();
    
        return view('admin.schedule-management', compact(
            'jadwal',
            'dokters'
        ));
    }

    public function create()
    {
        $dokters = Dokter::with('user')->get();

        return view('admin.schedule-create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokters,id_dokter',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required',
            'kuota_harian' => 'required|integer',
        ]);

        $cekBentrok = JadwalDokter::where('id_dokter', $request->id_dokter)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                        ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($cekBentrok) {
            return back()->withInput()->with('error', 'Jadwal bentrok dengan jadwal dokter yang sudah ada');
        }

        $jadwal = JadwalDokter::create([
            'id_dokter' => $request->id_dokter,
            'tanggal' => $request->tanggal,
            'hari' => date('l', strtotime($request->tanggal)),
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruang,
            'kuota_harian' => $request->kuota_harian,
            'terisi' => 0,
            'current_antrian' => 0,
            'status_jadwal' => 'Available',
        ]);

        $jadwal->status_jadwal = $this->getStatus($jadwal);
        $jadwal->save();

        Notifikasi::create([
            'dokter_id' => $jadwal->id_dokter,
            'tipe'      => 'jadwal',
            'judul'     => 'Jadwal Praktik Baru',
            'pesan'     => 'Jadwal praktik pada '
                            . Carbon::parse($jadwal->tanggal)->format('d M Y')
                            . ' pukul '
                            . Carbon::parse($jadwal->jam_mulai)->format('H:i')
                            . ' - '
                            . Carbon::parse($jadwal->jam_selesai)->format('H:i'),
            'link'      => route('dokter.jadwal'),
            'is_read'   => false,
        ]);

        return redirect()->route('admin.schedule.index')
            ->with('success', 'Jadwal dokter berhasil dibuat');
    }

    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $dokters = Dokter::with('user')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        if ($this->jadwalSudahDimulai($jadwal)) {
            return back()->with('error', 'Jadwal yang sudah dimulai tidak bisa diedit.');
        }

        $request->validate([
            'id_dokter' => 'required|exists:dokters,id_dokter',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required',
            'kuota_harian' => 'required|integer',
        ]);

        $jadwal->update([
            'id_dokter' => $request->id_dokter,
            'tanggal' => $request->tanggal,
            'hari' => date('l', strtotime($request->tanggal)),
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruang,
            'kuota_harian' => $request->kuota_harian,
        ]);

        $jadwal->status_jadwal = $this->getStatus($jadwal);
        $jadwal->save();

        return redirect()->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        if ($this->jadwalSudahDimulai($jadwal)) {
            return back()->with('error', 'Jadwal yang sudah dimulai tidak bisa dihapus.');
        }

        $jadwal->delete();

        return back()->with('success', 'Schedule deleted successfully.');
    }

    private function jadwalSudahDimulai(JadwalDokter $jadwal): bool
    {
        $waktuMulai = Carbon::parse(
            $jadwal->tanggal . ' ' . $jadwal->jam_mulai,
            'Asia/Jakarta'
        );

        return now('Asia/Jakarta')->greaterThanOrEqualTo($waktuMulai);
    }

    /**
     * LOGIC STATUS JADWAL (BERSIH & REUSABLE)
     */
    private function getStatus($jadwal)
    {
        $selesai = \Carbon\Carbon::parse($jadwal->tanggal . ' ' . $jadwal->jam_selesai);

        if (now()->greaterThan($selesai)) {
            return 'Closed';
        }

        if ($jadwal->terisi >= $jadwal->kuota_harian) {
            return 'Full';
        }

        return 'Available';
    }
    
}
