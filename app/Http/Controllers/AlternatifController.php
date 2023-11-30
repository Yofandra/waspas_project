<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = Alternatif::orderBy('id', 'desc')->paginate(5);
        return view('#', compact('alternatif'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('#');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama_alternatif' => 'required',
            ]);
            // Guru::create($request->all());
            $alternatif = new Alternatif();
            $alternatif->id = $request->get('id');
            $alternatif->nama_alternatif = $request->get('nama_alternatif');

            $alternatif->save();
            return redirect()->route('#') 
            -> with('success', 'Data Alternatif Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Alternatif $alternatif)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        return view('#', compact('Alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'nama_alternatif' => 'required',
            ]);
            
            $alternatif = Alternatif::where('id', $id)->first();
            $alternatif->id = $request->get('id');
            $alternatif->nama_alternatif = $request->get('nama_alternatif');

            $alternatif->save();
            return redirect()->route('#') 
            -> with('success', 'Data Alternatif Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alternatif::find($id)->delete();
        return redirect()->route('#') -> with('success', 'Data Alternatif Berhasil Dihapus');
    }
}
