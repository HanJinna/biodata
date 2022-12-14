@extends('layout.admin')
@section('title', 'Edit Jenis Contact')
@section('content-title', 'Edit Jenis Contact')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-4">
			<div class="card-body">
				@if(count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $item)
								<li>
									{{$item}}
								</li>
							@endforeach
						</ul>
					</div>

				@endif

				<form method="post" enctype="multipart/form-data" action="{{ route('MasterKontak.updatejenis', $jk->id) }}">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="jenis_kontak">Nama Project : </label>
						<input type="text" class="form-control" id="jenis_kontak" name="jenis_kontak" value="{{$jk->jenis_kontak}}">
					</div>
					<div class="form-group">
						<!-- <a type="submit" class="btn btn-success">Save</a> -->
						<input type="submit" class="btn btn-success" value="Update">
						<a href="{{ route('MasterKontak.index') }}" class="btn btn-danger">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection