@extends('layout.admin')
@section('title','Edit siswa')
@section('content-title', 'Edit siswa')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="post" enctype="multipart/form-data" action="{{route('MasterSiswa.update', $siswa->id)}}">

                    @csrf 
                    @method('put')
                {{-- <form action="{{ route('Master_siswa.store')}}"> --}}
                <div class="form-group">
                    <label for="Nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}">
                </div>

                    <div class="form-group">
                        <label for="nisn">Nisn</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$siswa->alamat}}">
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-select form-control" id="jk" name='jk'>
                            <option value="laki-laki"@if($siswa->jk == 'laki-laki') selected @endif>laki-laki</option>
                            <option value="perempuan"@if($siswa->jk == 'perempuan') selected @endif>perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Siswa</label><br>
                        <img src="{{asset('template/img/'.$siswa->foto)}}" width="300" class="img-thumbnail">
                        <input type="file" class="form-control-file" id="foto" name='foto'>
                    </div>

                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea type="text" class="form-control" id="about" name="about">{{$siswa->about}}</textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success">
                        <a href="{{route('MasterSiswa.index')}}" class="btn btn-danger">Batal</a>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection