<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $data = [
        ['id' => 1, 'produk' => 'Booking Dokter'],
        ['id' => 2, 'produk' => 'Rekam Medis'],
        ['id' => 3, 'produk' => 'Resep Obat'],
    ];

    return view('list_product', compact('data'));
}
}
