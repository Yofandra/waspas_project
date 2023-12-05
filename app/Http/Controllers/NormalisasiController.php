<?php

namespace App\Http\Controllers;
use App\Models\DecisionMatrix;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class NormalisasiController extends Controller
{
    public function index(){
        $decisionMatrix = DecisionMatrix::all();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($decisionMatrix->isEmpty()) {
            return view('waspas.indexNormalisasi')->with('error', 'Tidak ada data Normalisasi yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $normalisasiTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($decisionMatrix as $data) {
            $normalisasiTable[$data->id_alternatif][$data->id_kriteria] = $this->calculateNormalized($data->value, $data->id_kriteria);
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = Kriteria::pluck('nama_kriteria', 'id')->toArray();

        // Kirim data ke view
        return view('waspas.indexNormalisasi', compact('normalisasiTable', 'kriteriaNames'));
    }

    public function calculateNormalized($value, $idKriteria){
        $jenisKriteria = Kriteria::where('id', $idKriteria)->value('jenis_kriteria');
        $data = DecisionMatrix::where('id_kriteria', $idKriteria)->pluck('value')->toArray();

        $extremeValue = $jenisKriteria === 'benefit' ? max($data) : min($data);

        $normalizedValue = $jenisKriteria === 'benefit' ? $value / $extremeValue : $extremeValue / $value;

        $formattedValue = number_format($normalizedValue, 3);

        return $formattedValue;
    }
}
