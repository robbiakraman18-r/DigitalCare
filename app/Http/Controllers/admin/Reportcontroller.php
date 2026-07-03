<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Notifikasi;
use App\Models\RekamMedis;
use App\Exports\AppointmentsExport;
use App\Exports\PatientsExport;
use App\Exports\DoctorsExport;
use App\Exports\MedicalRecordsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * NOTE: sesuaikan nilai status di bawah ini ('completed', 'cancelled', dst)
     * dengan enum / string status_janji yang benar-benar dipakai di database kamu.
     */
    public function index()
    {
        $totalAppointments = Appointment::count();

        $completedAppointments = Appointment::where('status_janji', 'completed')->count();

        $cancelledAppointments = Appointment::where('status_janji', 'cancelled')->count();

        $completionRate = $totalAppointments > 0
            ? round(($completedAppointments / $totalAppointments) * 100)
            : 0;

        $cancellationRate = $totalAppointments > 0
            ? round(($cancelledAppointments / $totalAppointments) * 100)
            : 0;

        $newPatientsThisMonth = Pasien::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $totalPatients = Pasien::count();

        $totalDoctors = Dokter::count();

        $activeDoctors = Dokter::where('status_ketersediaan', 'Available')->count();

        $doctorAvailabilityRate = $totalDoctors > 0
            ? round(($activeDoctors / $totalDoctors) * 100)
            : 0;

        $totalMedicalRecords = RekamMedis::count();

        // Appointment volume 6 bulan terakhir, untuk grafik bar Tailwind
        $months = collect();

        for ($i = 5; $i >= 0; $i--) {

            $date = now()->subMonths($i);

            $count = Appointment::whereMonth('tanggal_janji', $date->month)
                ->whereYear('tanggal_janji', $date->year)
                ->count();

            $months->push([
                'label' => $date->translatedFormat('M'),
                'count' => $count,
            ]);
        }

        $maxCount = $months->max('count') ?: 1;

        $months = $months->map(function ($m) use ($maxCount) {
            $m['percentage'] = max(round(($m['count'] / $maxCount) * 100), 4);
            return $m;
        });

        // Daftar jenis report yang bisa di-generate
        $reports = [
            [
                'key'       => 'appointments',
                'name'      => 'Appointment Report',
                'category'  => 'Appointments',
                'icon'      => 'calendar-check-2',
                'bgClass'   => 'bg-blue-100',
                'textClass' => 'text-blue-600',
                'total'     => $totalAppointments,
            ],
            [
                'key'       => 'patients',
                'name'      => 'Patient Report',
                'category'  => 'Patients',
                'icon'      => 'users',
                'bgClass'   => 'bg-cyan-100',
                'textClass' => 'text-cyan-600',
                'total'     => $totalPatients,
            ],
            [
                'key'       => 'doctors',
                'name'      => 'Doctor Performance',
                'category'  => 'Doctors',
                'icon'      => 'stethoscope',
                'bgClass'   => 'bg-yellow-100',
                'textClass' => 'text-yellow-600',
                'total'     => $totalDoctors,
            ],
            [
                'key'       => 'medical-records',
                'name'      => 'Medical Records',
                'category'  => 'Records',
                'icon'      => 'file-text',
                'bgClass'   => 'bg-purple-100',
                'textClass' => 'text-purple-600',
                'total'     => $totalMedicalRecords,
            ],
        ];

        return view('admin.reports', compact(
            'totalAppointments',
            'completedAppointments',
            'completionRate',
            'cancellationRate',
            'newPatientsThisMonth',
            'totalPatients',
            'totalDoctors',
            'activeDoctors',
            'doctorAvailabilityRate',
            'totalMedicalRecords',
            'months',
            'reports'
        ));
    }

    /**
     * Export satu jenis report ke PDF.
     * Route: GET /admin/reports/{type}/pdf
     */
    public function exportPdf(string $type)
    {
        $data = $this->resolveReportData($type);

        $pdf = Pdf::loadView('admin.reports.pdf.' . $type, $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download($type . '-report-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Export satu jenis report ke Excel.
     * Route: GET /admin/reports/{type}/excel
     */
    public function exportExcel(string $type)
    {
        $export = match ($type) {
            'appointments' => new AppointmentsExport(),
            'patients' => new PatientsExport(),
            'doctors' => new DoctorsExport(),
            'medical-records' => new MedicalRecordsExport(),
            default => abort(404),
        };

        return Excel::download(
            $export,
            $type . '-report-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Ringkasan keseluruhan klinik dalam satu PDF (tombol "Generate Report").
     * Route: GET /admin/reports/summary/pdf
     */
    public function exportSummaryPdf()
    {
        $totalAppointments = Appointment::count();
        $completedAppointments = Appointment::where('status_janji', 'completed')->count();
        $totalPatients = Pasien::count();
        $totalDoctors = Dokter::count();
        $totalMedicalRecords = RekamMedis::count();

        $recentAppointments = Appointment::with(['pasien.user', 'dokter.user'])
            ->latest('tanggal_janji')
            ->take(15)
            ->get();

        $pdf = Pdf::loadView('admin.reports.pdf.summary', compact(
            'totalAppointments',
            'completedAppointments',
            'totalPatients',
            'totalDoctors',
            'totalMedicalRecords',
            'recentAppointments'
        ))->setPaper('a4', 'portrait');

        Notifikasi::create([
            'dokter_id' => null,
            'tipe'      => 'laporan',
            'judul'     => 'Laporan Klinik',
            'pesan'     => 'Laporan ringkasan klinik berhasil dibuat.',
            'link'      => route('admin.reports.index'),
            'is_read'   => false,
        ]);

        return $pdf->download('clinic-summary-report-' . now()->format('Y-m-d') . '.pdf');
    }

    private function resolveReportData(string $type): array
    {
        return match ($type) {
            'appointments' => [
                'appointments' => Appointment::with(['pasien.user', 'dokter.user'])
                    ->latest('tanggal_janji')
                    ->get(),
            ],
            'patients' => [
                'pasienList' => Pasien::with('user')->get(),
            ],
            'doctors' => [
                'dokterList' => Dokter::with('user')->get(),
            ],
            'medical-records' => [
                'rekamMedisList' => RekamMedis::with(['appointment.pasien.user', 'dokter.user'])
                    ->latest('waktu_pemeriksaan')
                    ->get(),
            ],
            default => abort(404),
        };
    }
}