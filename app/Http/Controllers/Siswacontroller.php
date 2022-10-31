<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\Session;
use App\Models\siswa;
use App\Models\kontak;
use Illuminate\Support\facades\file;
use Illuminate\Http\Request;

class siswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::all();
        return view('layout.sidebar.MasterSiswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.sidebar.TambahSiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $message=[
            'required' => ':attribute harus diisi gaesss',
            'min' => ':attribute minimal :min karakter ya coy',
            'max' => ':attribute maximal :max karakter gaess',
            'numeric' => ':attribute harus diisi angka',
            'mimes' => 'file :attribute harus bertipe jpg, jpeg'

        ];

        //validate form
        $this->validate($request,[ 
            'nama'=>'required|min:7|max:30',
            'nisn'=>'required|numeric',
            'alamat'=>'required',
            'jk'=>'required',
            'foto' => 'required|mimes : jpg,jpeg',
            'about'=>'required|min:10'
        ], $message);

        //ambil informasi file yang di upload
        $file = $request->file('foto');

        //rename
        // $nama_file = time()."_".$file->getClientOriginal();

        //proses upload
        $tujuan_upload = './template/img';
        // $file->move($tujuan_upload,$nama_file);
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);
        //insert data
        Siswa::create([
            'nama'=> $request -> nama,
            'nisn'=> $request -> nisn,
            'alamat'=> $request -> alamat,
            'jk'=> $request -> jk,
            'foto'=> $nama_file,
            'about'=> $request -> about
        ]);


        session::flash('success', 'data anda tersimpan!');
        return redirect('/MasterSiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = siswa::find($id);
        $kontaks = $siswa->kontak()->get();
        return view ('layout.sidebar.SiswaShow', compact('siswa', 'kontaks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa=Siswa::find($id);
        return view ('layout.sidebar.SiswaEdit', compact('siswa'));
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
        $message=[
            'required' => ':attribute harus diisi gaesss',
            'min' => ':attribute minimal :min karakter ya coy',
            'max' => ':attribute maximal :max karakter gaess',
            'numeric' => ':attribute harus diisi angka',
            'mimes' => 'file :attribute harus bertipe jpg, jpeg'

        ];

        //validate form
        $this->validate($request,[
            'nama'=>'required|min:7|max:30',
            'nisn'=>'required|numeric',
            'alamat'=>'required',
            'jk'=>'required',
            'foto' => 'mimes : jpg,jpeg',
            'about'=>'required|min:10'
        ], $message);

        if($request->foto !=''){
            $siswa = siswa::find($id);
            file::delete('./template/img/'. $siswa->foto);

        //ambil informasi file yang di upload
        $file = $request->file('foto');
            // dd($foto);
        //rename
        $nama_file = time()."_".$file->getClientOriginalName();
        //proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload,$nama_file);

        $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->nisn = $request->nisn;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->foto = $nama_file;
            $siswa->save();
            session::flash('success', 'data anda tersimpan!');
            return redirect('/MasterSiswa');



            
        } else {
            $siswa=siswa::find($id);
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->nisn = $request->nisn;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->save();
            session::flash('success', 'data anda tersimpan!');
            return redirect('/MasterSiswa');

        };
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
        $siswa=siswa::find($id)->delete();
        Session::flash('danger', 'Data berhasil dihapus');
        return redirect('/MasterSiswa');
    }
}