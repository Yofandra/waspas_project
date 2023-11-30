<?php

namespace App\Models;

use App\Models\DecisionMatrix;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = "table_alternatif";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_alternatif',
    ];

    public function decision_matrix()
    {
        return $this->hasMany(DecisionMatrix::class, 'id_alternatif', 'id');
    }

}
