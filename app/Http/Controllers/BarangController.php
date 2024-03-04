<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Barang::query();

        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort);
        }

        $barangs = $query->get();

        return response()->json($barangs);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->jumlah_terjual = $request->jumlah_terjual;
        $barang->tanggal_transaksi = $request->tanggal_transaksi;
        $barang->jenis_barang = $request->jenis_barang;
        $barang->save();
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $barang = Barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->jumlah_terjual = $request->jumlah_terjual;
        $barang->tanggal_transaksi = $request->tanggal_transaksi;
        $barang->jenis_barang = $request->jenis_barang;
        $barang->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json($barang);
    }

    public function max()
    {
        $maxBarang = Barang::orderBy('jumlah_barang', 'desc')->first();
        return response()->json($maxBarang);
    }


    public function min()
    {
        $minBarang = Barang::orderBy('jumlah_barang', 'asc')->first();
        return response()->json($minBarang);
    }

    public function getData(Request $request)
    {

        $request->validate([
            'start_date' => 'date',
            'end_date' => 'date'
        ]);


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $barang = Barang::whereBetween('date', [$startDate, $endDate])->get();

        return response()->json($barang);
    }
}
