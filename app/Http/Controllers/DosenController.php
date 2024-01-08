<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\mahasiswa;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FacadesSession::flash('nip',$request->nip);
        FacadesSession::flash('nama',$request->nama);

        $request->validate([
            'nip'=>'required|numeric|unique:dosen,nip',
            'nama'=>'required',
        ],[
            'nip.required'=>'NIP Harus Diisi',
            'nip.numeric'=>'NIP Harus Angka',
            'nip.unique'=>'NIP Sudah ada dalam Database',
            'nama.required'=>'Nama Harus Diisi',
        ]);
        $data = [
            'nip'=>$request->nip,
            'nama'=>$request->nama,
        ];
        Dosen::create($data);
        return redirect()->to('dosen')->with('success','Data berhasil ditambahkan');
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
    public function edit($id)
    {
        $data = Dosen::where('nip', $id)->first();
        return view('dosen.edit')->with('data', $data);
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
        $request->validate([
            'nama'=>'required',
        ],[
            'nama.required'=>'Nama Harus Diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
        ];
        Dosen::where('nip', $id)->update($data);
        return redirect()->to('dosen')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success','Data berhasil dihapus');
    }
}
