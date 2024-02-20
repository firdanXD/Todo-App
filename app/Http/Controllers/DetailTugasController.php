<?php

namespace App\Http\Controllers;

use App\Models\DetailTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;

class DetailTugasController extends Controller
{
    public function update(Request $request, $id_detail_tugas){
        $tugas = DetailTugas::findOrFail($id_detail_tugas);
        $tugas->status = $tugas->status == 1 ? 0 : 1;
        $tugas->save();

        $tugasCheck = DetailTugas::where('id_tugas', $tugas->id_tugas)->where("status",1)->get();
        $semuaTugas = DetailTugas::where('id_tugas', $tugas->id_tugas)->get();

        if(count($tugasCheck) == count($semuaTugas)){
            Tugas::where('id_tugas', $tugas->id_tugas)->update([
                "status" => 1
        ]);
    }else{
        Tugas::where('id_tugas', $tugas->id_tugas)->update([
            "status" => 0
    ]);
    }
    return response()->json([
    'status' => 200
    ]);
}

public function store(Request $request){
    $tugas = new DetailTugas();
    $tugas->detail_tugas = $request ->list;
    $tugas->id_tugas = $request->id_tugas;
    $tugas->save();

    return response()->json([
        'status' => 200
    ]);
}
public function destroy($id_detail_tugas){
    $items = DetailTugas::findOrFail($id_detail_tugas);
    $items->delete();

    if($items){
        return response()->json([
            "status" => 200
        ]);
    }else{
    return response()->json([
        "status" => 500
    ]);
}
}
}


