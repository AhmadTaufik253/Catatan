<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['dataTransaksi'] = Transaksi::orderByDesc('id')->get();
        return view('transaksi', $data);
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
        Transaksi::create($request->all());

        return redirect()->route('transaksi')->with('success','Berhasil Input Transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        Transaksi::where('id', $id)->update([
            'nama_transaksi' => $request->nama_transaksi,
            'nominal' => $request->nominal,
            'kategori' => $request->kategori
        ]);
        return redirect()->back()->with('success','Berhasil Update Transaksi');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Transaksi::find($id);
        $data->delete();

        return redirect()->back()->with('success','Berhasil Delete Transaksi');;
    }
}
