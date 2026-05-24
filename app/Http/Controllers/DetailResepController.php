<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailResep;

class DetailResepController extends Controller
{
    public function index()
    {
        $detailResep = DetailResep::all();

        return view('detail_resep.index', compact('detailResep'));
    }

    public function create()
    {
        return view('detail_resep.create');
    }

    public function store(Request $request)
    {
        DetailResep::create($request->all());

        return redirect('/detail-resep');
    }
}