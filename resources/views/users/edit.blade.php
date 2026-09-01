@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Manajemen User -> Edit User')])

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
          <form method="post" action="{{url("user/$user->id")}}" autocomplete="off" class="form-horizontal">
            {{csrf_field()}}
			@method('put')
			
		    <div class="card ">
			  <div class="card-header card-header-rose">
                <h4 class="card-title">{{ __('Edit Data User') }}</h4>
                <!--p class="card-category">{{ __('User information') }}</p-->
              </div>
			  
			  <div class="card-body ">
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Nama</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
					@if ($errors->has('name'))
						<span class="text-danger">{{ $errors->first('name') }}</span>
					@endif
				  </div>
                </div>
				</div>
				
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Email</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="text" name="email" class="form-control" value="{{$user->email}}">
					@if ($errors->has('email'))
						<span class="text-danger">{{ $errors->first('email') }}</span>
					@endif
                  </div>
				 </div>
				</div>
				
				<div class="row">
                    <label class="col-sm-2 col-form-label" for="">Password</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="password" name="password" class="form-control">
					<small class="text-muted">Kosongkan kalau tidak mau ganti password</small>
					@if ($errors->has('password'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
				  </div>
                </div>
				</div>
				
				<div class="row">
					<label class="col-sm-2 col-form-label" for="">Password - ulangi</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control">
					@if ($errors->has('password_confirmation'))
						<span class="text-danger">{{ $errors->first('password') }}</span>
					@endif
				  </div>
                </div>
                </div>

				<div class="row">
                    <label class="col-sm-2 col-form-label" for="">Role</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <select name="role" class="form-control">
						<option value="ADMIN" {{ $user->role == 'ADMIN' ? 'selected' : '' }}>Admin</option>
						<option value="USER" {{ $user->role == 'USER' ? 'selected' : '' }}>User</option>
					</select>
					@if ($errors->has('role'))
						<span class="text-danger">{{ $errors->first('role') }}</span>
					@endif
				  </div>
                </div>
				</div>

				<div class="row">
                    <label class="col-sm-2 col-form-label" for="">Unit Kerja / Bidang</label>
				<div class="col-sm-7">
				  <div class="form-group">
                    <select name="id_bidang" class="form-control">
						<option value="">--Pilih Unit Kerja (khusus role User)</option>
						@foreach($data_bidang as $uk)
							<option value="{{ $uk->id }}" {{ $user->id_bidang == $uk->id ? 'selected' : '' }}>{{ $uk->nama_unit_kerja }}</option>
						@endforeach
					</select>
					@if ($errors->has('id_bidang'))
						<span class="text-danger">{{ $errors->first('id_bidang') }}</span>
					@endif
				  </div>
                </div>
				</div>
                    
			  </div> <!--card-body-->
			  
			  <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
				<a href="{{url('user')}}" class="btn btn-warning">List User</a>
              </div>
			  
            </div> <!--card-->
          </form>
        </div>
      </div>
      
    </div>
  </div>
@endsection