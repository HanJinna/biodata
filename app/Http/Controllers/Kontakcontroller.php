<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jenis_kontak;
use App\Models\kontak;
use Session;

class Kontakcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::paginate(5);
        $jk = jenis_kontak::all();
        return view('layout.sidebar.MasterKontak', compact('data', 'jk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function tambah($id)
    {
        $siswa=siswa::find($id);
        $jk=jenis_kontak::all();
        return view('layout.sidebar.KontakTambah', compact('siswa', 'jk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'siswa_id' => 'required',
            'jenis_kontak_id' => 'required',
            'deskripsi' => 'required'
        ]);
        // $validasi['id_siswa'] = $request->id;
        kontak::create($validasi);
        return redirect('/MasterKontak')->with('success', 'Contact Berhasil Ditambah');
    }

    public function storejenis(Request $request)
    {
        $validasi = $request->validate([
            'jenis_kontak' => 'required',
        ]);
        jenis_kontak::create($validasi);
        return redirect('/MasterKontak')->with('success', 'Jenis Contact Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontak=siswa::find($id)->kontak()->get();
        $contact=kontak::find($id);
        return view('layout.sidebar.KontakShow', compact('kontak', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kontak = kontak::find($id);
        $siswa = siswa::find($id);
        return view('layout.sidebar.KontakEdit', compact('kontak', 'siswa'));
    }

    public function editjenis($id)
    {
        $jk = jenis_kontak::find($id);
        return view('jenis-edit', compact('jk'));
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
        //
    }

    public function updatejenis(Request $request, $id)
    {
        $message = [
            'required' => ':attribute isi woi',
            'min' => ':attribute minimal :min karakter woi',
            'max' => ':attribute maksimal :max karakter woi'
        ];

        $this->validate($request, [
            'jenis_kontak' => 'required',
        ], $message);

            //simpan ke database
            $jk=jenis_kontak::find($id);
            $jk->jenis_kontak = $request->jenis_kontak;
            $jk->save();
            Session::flash('berhasil', 'Data Berhasil Di Update');
            return redirect('MasterKontak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hapus($id)
    {
        //
    }

    public function hapusjenis($id)
    {
        $jk=jenis_kontak::find($id)->delete();
        Session::flash('hapus', 'Data Berhasil Di Hapus');
        return redirect('/MasterKontak');
    }
}