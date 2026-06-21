<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class AdminRekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = RekamMedis::with([
            'dokter.user',
            'appointment.pasien.user',
            'detailResep'
        ]);

        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'diagnosa',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'appointment.pasien.user',
                    function ($user) use ($search) {

                        $user->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

            });
        }

        if ($request->tanggal) {

            $query->whereDate(
                'waktu_pemeriksaan',
                $request->tanggal
            );
        }

        $rekamMedis = $query
            ->latest('waktu_pemeriksaan')
            ->paginate(10);

        $totalRecords = RekamMedis::count();

        $totalDoctors = RekamMedis::distinct()
            ->count('id_dokter');

        $totalPrescriptions = RekamMedis::has('detailResep')
            ->count();

        return view(
            'admin.medical-records',
            compact(
                'rekamMedis',
                'totalRecords',
                'totalDoctors',
                'totalPrescriptions'
            )
        );
    }

    public function show($id)
{
    $rekamMedis = RekamMedis::with([
        'appointment.pasien.user',   // pasien diakses lewat appointment, bukan langsung
        'dokter.user',
        'detailResep'
    ])->findOrFail($id);

    return view('admin.show', compact('rekamMedis'));
    
}
}