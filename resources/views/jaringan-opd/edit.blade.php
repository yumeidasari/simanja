@extends('layouts.app', ['activePage' => 'jaringan-opd', 'titlePage' => __('Perangkat Jaringan -> Edit')])

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
          <form method="post" action="{{url("jaringan-opd/$jaringan->id")}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
			@method('put')
			
		    <div class="card ">
			  <div class="card-header card-header-rose">
                <h4 class="card-title">{{ __('Edit Data Perangkat Jaringan') }}</h4>
                
              </div>
			  
			  <div class="card-body ">
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Nama OPD</label>
				<div class="col-sm-4">
				  <div class="form-group">
                    <select name="id_opd" class="form-control">
						<option value="">Pilih OPD</option>
							@foreach($semua_opd as $opd)
								<option {{$jaringan->id_opd == $opd->id ? "selected" : ""}} value="{{$opd->id}}"> {{$opd->nama_opd}} </option>
							@endforeach
					</select>
				  </div>
                </div>
				<!---->
				<label class="col-sm-2 col-form-label" for="">Tgl Pemasangan</label>
				<div class="col-sm-4">
				  <div class="form-group">
                    <input type="text" value="{{\Carbon\Carbon::create($jaringan->tgl_pemasangan)->format('m/d/Y')}}" data-role="date" class="date form-control" name="tgl_pemasangan" id="datepicker">
												
				  </div>
                </div>
				<!---->
				</div>
				
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Nama Alat</label>
				<div class="col-sm-4">
				  <div class="form-group">
                    <select name="id_alat" class="form-control">
						<option value="">Pilih Alat</option>
						@foreach($semua_alat as $alat)
							<option {{$jaringan->id_alat == $alat->id ? "selected" : ""}} value="{{$alat->id}}"> {{$alat->nama_alat}} - {{$alat->tipe}} - {{$alat->model}} </option>
						@endforeach
					</select>
                  </div>
				 </div>
				 <!---->
				<label class="col-sm-2 col-form-label" for="">Kode Alat</label>
				<div class="col-sm-4">
				  <div class="form-group">
                    <input type="text" value="{{$jaringan->kode_alat}}"  class="form-control" name="kode_alat" id="kode_alat">
												
				  </div>
                </div>
				<!---->
				</div>
				
				<div class="row">
                    <label class="col-sm-2 col-form-label" for="">Kondisi</label>
				<div class="col-sm-4">
				  <div class="form-group">
                    <select class=form-control name="kondisi">
						<option {{$jaringan->kondisi == "" ? "selected" : ""}} value="">Pilih Kondisi</option>
						<option {{$jaringan->kondisi == "BAIK" ? "selected" : ""}} value="BAIK">BAIK</option>
						<option {{$jaringan->kondisi == "RUSAK" ? "selected" : ""}} value="RUSAK">RUSAK</option>
					</select>
				  </div>
                </div>
				<!---->
				<label class="col-sm-2 col-form-label" for="">Gambar Alat</label>
				<div class="col-sm-4">
				  
                    <br>
						<input type="file" name="file" >
						<br>
						@if(isset($jaringan->foto))
                          <img width="120px" src="{{asset("/storage/$jaringan->foto")}}" alt="foto">
                        @else
                           Belum Ada Gambar Alat
                        @endif
				 
                </div>
				<!---->
				
				</div>
				   
			  </div> <!--card-body-->
			  
			  <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
				<a href="{{url('jaringan-opd')}}" class="btn btn-warning">Batal</a>
              </div>
			  
            </div> <!--card-->
          </form>
        </div>
      </div>
      
    </div>
  </div>
 <script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true   
              
         }); 
		
  </script>
@endsection
