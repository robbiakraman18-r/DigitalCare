<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionDetail;

class ListPrescriptionController extends Controller
{
    public function show()
    {
        $obat = PrescriptionDetail::all();

        return view('list_prescriptions', compact('obat'));
    }
}