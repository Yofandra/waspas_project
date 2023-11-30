<?php

namespace App\Models;

use App\Models\DecisionMatrix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = "table_kriteria";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_kriteria',
        'bobot_kriteria',
        'jenis_kriteria',
    ];

    public function decision_matrix()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_kriteria', 'id');
    }
}
