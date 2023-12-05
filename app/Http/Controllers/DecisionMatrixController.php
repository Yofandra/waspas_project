<?php

namespace App\Http\Controllers;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\DecisionMatrix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DecisionMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data DecisionMatrix dari database
        $decision_matrix = DecisionMatrix::all();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($decision_matrix->isEmpty()) {
            return view('waspas.indexDecisionMatrix')->with('error', 'Tidak ada data Decision Matrix yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($decision_matrix as $data) {
            $matrixTable[$data->id_alternatif][$data->id_kriteria] = $data->value;
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = DB::table('table_kriteria')->pluck('nama_kriteria', 'id')->toArray();

        // Kirim data ke view
        return view('waspas.indexDecisionMatrix', compact('matrixTable', 'kriteriaNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();

        if ($alternatif->isEmpty()) {
            return redirect()->route('some.route')->with('error', 'Tidak ada alternatif yang ditemukan.');
        }

        return view('waspas.createDecisionMatrix', compact('alternatif', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'value_*_*' => 'required|numeric',
        ]);

        try {
            $alt = Alternatif::all();
            $krit = Kriteria::all();

            foreach ($alt as $Alt) {
                if (!$Alt->isUsed()) {
                    foreach ($krit as $Krit) {
                        $fieldName = 'value_' . $Alt->id . '_' . $Krit->id;
                        $dec = new DecisionMatrix;
                        $dec->id_alternatif = $Alt->id;
                        $dec->id_kriteria = $Krit->id;
                        $dec->value = $request->get($fieldName);
                        $dec->save();
                    }
                }
            }

            return redirect()->route('decision-matrix.create')->with('success', 'Nilai Decision Matrix berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.create')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_alternatif)
    {
        // Ambil data Decision Matrix berdasarkan id_alternatif
        $matrixData = DecisionMatrix::where('id_alternatif', $id_alternatif)->get();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($matrixData->isEmpty()) {
            return redirect()->route('decision-matrix.index')->with('error', 'Tidak ada data Decision Matrix untuk alternatif ini.');
        }

        // Ambil alternatif dan kriteria
        $alternatif = Alternatif::findOrFail($id_alternatif);
        $kriteria = Kriteria::all();

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matrixData as $data) {
            $matrixTable[$data->id_kriteria] = $data->value;
        }

        return view('waspas.editDecisionMatrix', compact('alternatif', 'kriteria', 'matrixTable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_alternatif)
    {
        $this->validate($request, [
            'value.*' => 'required|numeric', // Validasi untuk setiap nilai
        ]);

        try {
            foreach ($request->value as $id_kriteria => $value) {
                DecisionMatrix::where('id_alternatif', $id_alternatif)
                    ->where('id_kriteria', $id_kriteria)
                    ->update(['value' => $value]);
            }

            return redirect()->route('decision-matrix.index')->with('success', 'Nilai Decision Matrix berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DecisionMatrix::where('id_alternatif', $id)->delete();
            return redirect()->route('decision-matrix.index')->with('success', 'Data Decision Matrix berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
