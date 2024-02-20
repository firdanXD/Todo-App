<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;


class TugasController extends Controller
{
    public function data(Request $request){
        if($request->key){
            $tugas = Tugas::where('judul', 'like', '%'.$request->key.'%')->orWhere('deskripsi','like', '%'.$request->key.'%')->get();
            return response()->json($tugas);
        }
        else{
        $tugas = Tugas::get();
        return response()->json($tugas);
    }
    }


    public function index(){
        $title = "List Tugas";

        return view('tugas.index',[
            "title" => $title
        ]);
    }

    public function store(Request $request){
        $tugas = new Tugas();
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->save();

        return response()->json([
            'status' => 200
        ]);
    }

    public function updateStatus(Request $request, $id_tugas)
    {
        $tugas = Tugas::findOrFail($id_tugas);
        $tugas->status = $tugas->status == 1 ? 0 : 1;
        $tugas->save();

        return response()->json([
            'status' => 200
        ]);
    }
    public function destroy($id_tugas){
        $items = Tugas::findOrFail($id_tugas);
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

    public function show($id_tugas){
        $tugas = Tugas::with('DetailTugas')->where('id_tugas', $id_tugas)->first();
        return response()->json($tugas);
    }

    public function update(Request $request, $id_tugas){
        $tugas = Tugas::findOrFail($id_tugas);
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->save();
        return response()->json([
                'status' => 200
            ]);
    }
}
