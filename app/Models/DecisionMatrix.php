<?php

namespace App\Models;

use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionMatrix extends Model
{
    use HasFactory;
    protected $table = 'table_decision_matrix';
    protected $fillable = ['id_kriteria', 'id_alternatif', 'value'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }
}
