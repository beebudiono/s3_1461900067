<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TugasPraktikum3Controller extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table("kelas")
            ->select("siswa.nama as siswa", "guru.nama as guru", "guru.mengajar as pelajaran")
            ->join("siswa", "siswa.id", "kelas.id_siswa")
            ->join("guru", "guru.id", "kelas.id_guru")
            ->orderBy("kelas.id", "desc")->get();

        $guru = DB::table('guru')->orderBy("nama", "asc")->get();

        return view('index_0067', compact('data', 'guru'));
    }

    public function create()
    {
        return view('tugas_parktikum3_0067');
    }

    public function store(Request $request)
    {
        DB::table("guru")->insert([
            "nama" => $request->nama,
            "mengajar" => $request->mengajar,
        ]);

        alert()->html('Barang', "Berhasil disimpan", 'success');

        return redirect('tugas_praktikum3');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tugas_praktikum = DB::table('guru')->where('id',$id)->first();
        return view('tugas_parktikum3_0067', compact('tugas_praktikum'));
    }

    public function update(Request $request, $id)
    {

        DB::table("guru")->where('id', $id)->update([
            "nama" => $request->nama,
            "mengajar" => $request->mengajar,
        ]);

        alert()->html('Barang', "Berhasil diupdate", 'success');

        return redirect('tugas_praktikum3');
    }

    public function destroy($id)
    {
        DB::table("guru")->where('id', $id)->delete();
        alert()->html('Barang', "Berhasil diupdate", 'success');

        return redirect()->back();
    }
}
