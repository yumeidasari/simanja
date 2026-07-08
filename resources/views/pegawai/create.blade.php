@extends('layouts.app', ['activePage' => 'pegawai', 'titlePage' => __('Data Pegawai -> Tambah Pegawai')])

@section('content')
 <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
		@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message')}}
            </div>
        @endif
		@if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
			@endif
          <form method="post" action="{{ url('/pegawai') }}" autocomplete="off" class="form-horizontal">
            {{csrf_field()}}
		    <div class="card ">
			  <div class="card-header card-header-rose">
                <h4 class="card-title">{{ __('Tambah Pegawai Baru') }}</h4>
              </div>
			  <div class="card-body ">
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Nama Pegawai</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="text" name="nama" class="form-control">
					@if ($errors->has('nama'))
						<span class="text-danger">{{ $errors->first('nama') }}</span>
					@endif
				  </div>
                </div>
				</div>

				<div class="row">
					<label class="col-sm-2 col-form-label" for="">NIP</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="text" name="nip" class="form-control" maxlength="20">
					@if ($errors->has('nip'))
						<span class="text-danger">{{ $errors->first('nip') }}</span>
					@endif
                  </div>
				 </div>
				</div>

				<div class="row">
                    <label class="col-sm-2 col-form-label" for="">Bidang</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <select name="bidang" class="form-control">
						<option value="">--Pilih Bidang</option>
						<option value="Sekretariat">Sekretariat</option>
						<option value="IKP">IKP</option>
						<option value="KIPS">KIPS</option>
						<option value="APTIKA">APTIKA</option>
					</select>
					@if ($errors->has('bidang'))
						<span class="text-danger">{{ $errors->first('bidang') }}</span>
					@endif
				  </div>
                </div>
				</div>

			  </div> <!--card-body-->
			  <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
				<a href="{{url('pegawai')}}" class="btn btn-warning">List Pegawai</a>
              </div>
            </div> <!--card-->
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection