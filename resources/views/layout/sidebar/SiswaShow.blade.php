@extends('layout.admin')
@section('title','show siswa')
@section('content-title', 'show siswa')
@section('content')
<div class="row">
    <div class="col-lg-4">

        {{-- kartu satu --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-graduate"></i>Nama Siswa</h6>
            </div>
            <div class="card-body text-center">
                <img src="{{ asset('/template/img/'.$siswa->foto)}}" width="200" class="mt-3 mxauto img-thumbnail"><br>
                <h5 class="">{{$siswa->nama}}</h5>
                <h5>{{$siswa->nisn}}</h5>
                <h5>{{$siswa->alamat}}</h5>
                <h5>{{$siswa->jk}}</h5>
            </div>
        </div>

        {{-- kartu dua --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-plus"></i>Kontak Siswa</h6>
            </div>
            <div class="card-body text-center">
                @foreach ($kontaks as $kontak)
                 <li>{{ $kontak->jenis_kontak}}:{{ $kontak->pivot->deskripsi }} </li> 
                @endforeach
            </div>
        </div>  
    </div>
    
    <div class="col-lg-8">
      {{-- kartu tiga --}}
      <div class="card shadow mb-4">
        <div class="card-header"><h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-quote-left">About Siswa</i></h6></div>
            <div class="card-body">
                <blockquote class="blockquote tecxt-center">
                    <p class="mb-0">{{$siswa->about}}</p>
                    <footer class="blockquote-footer">Ditulis oleh aku yang sedang duduk <cite title="Source Title"></cite></footer>
                </blockquote>
            </div>
        </div>  

     {{-- kartu empat --}}
     <div class="card shadow">
        <div class="card-header"><h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tasks">Project Siswa</i></h6></div>
        <div class="card-body"></div>
    </div>
</div>
	<div class="col-lg-4">
		<a href="{{ route('MasterSiswa.index')}}" class="btn btn-primary">Back</a>
	</div>
</div>
@endsection