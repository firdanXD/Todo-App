<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTugas extends Model
{
    use HasFactory;
    
    protected $table = "detail_tugas";
    protected $primaryKey = "id_detail_tugas";
    protected $guarded = [];

    public function Tugas(){
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }
}
