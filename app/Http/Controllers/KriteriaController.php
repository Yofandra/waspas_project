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
        $kriteria = Kriteria::orderBy('id', 'desc')->paginate(5);
        return view('#', compact('kriteria'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required',
            ]);
            $kriteria = new Kriteria();
            $kriteria->id = $request->get('id');
            $kriteria->nama_kriteria = $request->get('nama_kriteria');
            $kriteria->bobot_kriteria = $request->get('bobot_kriteria');
            $kriteria->jenis_kriteria = $request->get('jenis_kriteria');

            $kriteria->save();
            return redirect()->route('#') 
            -> with('success', 'Data Kriteria Berhasil Ditambahkan');
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
        return view('#', compact('Kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required',
            ]);
            $kriteria = Kriteria::where('id', $id)->first();
            $kriteria->id = $request->get('id');
            $kriteria->nama_kriteria = $request->get('nama_kriteria');
            $kriteria->bobot_kriteria = $request->get('bobot_kriteria');
            $kriteria->jenis_kriteria = $request->get('jenis_kriteria');

            $kriteria->save();
            return redirect()->route('#') 
            -> with('success', 'Data Kriteria Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kriteria::find($id)->delete();
        return redirect()->route('#') -> with('success', 'Data Kriteria Berhasil Dihapus');
    }
}
