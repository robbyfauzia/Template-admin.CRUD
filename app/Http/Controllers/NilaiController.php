<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilai = Nilai::all();
        return view('nilai.index', compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nilai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nis' => 'required|unique:nilais|max:255',
        //     'kode_mata_pelajaran' => 'required',
        //     'nilai' => 'required',
        //     'indeks_nilai' => 'required',
        // ]);

        $nilai = new Nilai();
        $nilai->nis = $request->nis;
        $nilai->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $nilai->nilai = $request->nilai;
        if ($request->nilai >= 90 && $request->nilai <= 100) {
            $grade = 'A';
        }
        elseif ($request->nilai >= 80 && $request->nilai <= 89) {
            $grade = 'B';
        }
        elseif ($request->nilai >= 70 && $request->nilai <= 79) {
            $grade = 'C';
        }
        elseif ($request->nilai >= 60 && $request->nilai <= 69) {
            $grade = 'D';
        }
        elseif ($request->nilai >= 1 && $request->nilai <= 59) {
            $grade = 'E';
        }
        else {
            $grade = '404';
        }
        $nilai->indeks_nilai = $grade;
        $nilai->save();
        return redirect()->route('nilai.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nilai = Nilai::findOrFail($id);
        return view('nilai.show', compact('nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        return view('nilai.edit', compact('nilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'nis' => 'required|max:255',
        //     'kode_mata_pelajaran' => 'required',
        //     'nilai' => 'required',
        //     'indeks_nilai' => 'required',
        // ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->nis = $request->nis;
        $nilai->kode_mata_pelajaran = $request->kode_mata_pelajaran;
        $nilai->nilai = $request->nilai;
        if ($request->nilai >= 90 && $request->nilai <= 100) {
            $grade = 'A';
        }
        elseif ($request->nilai >= 80 && $request->nilai <= 89) {
            $grade = 'B';
        }
        elseif ($request->nilai >= 70 && $request->nilai <= 79) {
            $grade = 'C';
        }
        elseif ($request->nilai >= 60 && $request->nilai <= 69) {
            $grade = 'D';
        }
        elseif ($request->nilai >= 1 && $request->nilai <= 59) {
            $grade = 'E';
        }
        else {
            $grade = '404';
        }
        $nilai->indeks_nilai = $grade;
        $nilai->save();
        return redirect()->route('nilai.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->route('nilai.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
