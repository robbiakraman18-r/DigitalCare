<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class ListPatientController extends Controller
{
    public function show()
    {
        $patients = Patient::all();

        return view('list_patient', compact('patients'));
    }
}