<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\JadwalDokter;

class AdminJadwalController extends Controller
{
   public function index(Request $request)
{
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
        $dokters = Dokter::all();
        return view('admin.schedule.create', compact('dokters'));
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

        // CEK BENTROK JADWAL
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
            return back()->with('error', 'Jadwal bentrok dengan jadwal dokter yang sudah ada');
        }

        
        // CREATE JADWAL
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
        

        // AUTO STATUS CHECK
        $jadwal->status_jadwal = $this->getStatus($jadwal);
        $jadwal->save();

        return back()->with('success', 'Jadwal dokter berhasil dibuat');
    }

    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $dokters = Dokter::all();

        return view('admin.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $jadwal->update([
            'id_dokter' => $request->id_dokter,
            'tanggal' => $request->tanggal,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruang,
            'kuota_harian' => $request->kuota_harian,
            'status_jadwal' => $request->status_jadwal,
        ]);

        return redirect()->route('admin.schedule.index');
    }

    public function destroy($id)
{
    $jadwal = JadwalDokter::findOrFail($id);

    $jadwal->delete();

    return back()->with(
        'success',
        'Schedule deleted successfully.'
    );
}

    /**
     * LOGIC STATUS JADWAL (BERSIH & REUSABLE)
     */
    private function getStatus($jadwal)
    {
        if (now()->toDateString() > $jadwal->tanggal) {
            return 'Closed';
        }

        if ($jadwal->terisi >= $jadwal->kuota_harian) {
            return 'Full';
        }

        return 'Available';
    }
    
}
