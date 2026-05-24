<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::all();

        return view('rekam_medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        return view('rekam_medis.create');
    }

    public function store(Request $request)
    {
        RekamMedis::create($request->all());

        return redirect('/rekam-medis');
    }
}