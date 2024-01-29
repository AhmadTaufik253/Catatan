<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['totalPemasukan'] = Transaksi::where('kategori', 'Pemasukan')->sum('nominal');
        $data['totalPengeluaran'] = Transaksi::where('kategori', 'Pengeluaran')->sum('nominal');
        $data['totalUang'] = $data['totalPemasukan'] - $data['totalPengeluaran'];

        // Pemasukan
        $data['dataPemasukan'] = Transaksi::where('kategori', 'Pemasukan')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(nominal) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Pengeluaran
        $data['dataPengeluaran'] = Transaksi::where('kategori', 'Pengeluaran')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(nominal) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
