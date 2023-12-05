<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::orderBy('id', 'asc')->paginate(5);
        return view('kriteria.indexKriteria', compact('kriteria'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.createKriteria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required|in:cost,benefit',
            ]);
            Kriteria::create($request->all());

            return redirect()->route('data-kriteria.index')->with('success', 'Kriteria Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Kriteria $kriteria)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.editKriteria', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required|in:cost,benefit',
            ]);
            $kriteria = Kriteria::where('id', $id)->first();
            $kriteria->nama_kriteria = $request->get('nama_kriteria');
            $kriteria->bobot_kriteria = $request->get('bobot_kriteria');
            $kriteria->jenis_kriteria = $request->get('jenis_kriteria');

            $kriteria->save();
            return redirect()->route('data-kriteria.index') 
            -> with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kriteria::find($id)->delete();
        return redirect()->route('data-kriteria.index') -> with('success', 'Data Kriteria Berhasil Dihapus');
    }
}
