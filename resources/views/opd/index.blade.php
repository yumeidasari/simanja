@extends('layouts.app', ['activePage' => 'opd', 'titlePage' => __('Organisasi Perangkat Daerah')])

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
                <div class="card">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title ">{{ __('OPD') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!-- IMPORT FILE -->	
								<form action="{{route('opd.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form>
							<!--END -->
							</div>
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('opd')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search by nama opd...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i> Cari</button>
										</span>
									</span>
									</div>
                    
								</form>
								
							</div>
                            <div class="col-2 text-right">
                                <a rel="tooltip" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahOpd">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="eksport file" href="{{ route('opd.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
								
                            </div>
							
							<!--Buat Modal tambah OPD-->
							<div class="modal fade" id="modalTambahOpd" tabindex="-1" aria-labelledby="modalTambahOpd" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah OPD') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH OPD-->
										  <form action="" method="post">
											@csrf
											<div class="form-group">
												<label for="">Nama OPD</label>
												<br>
												<input type="text" class="form-control" id="nama_opd" name="nama_opd" aria-describedby="emailHelp">
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH OPD-->
										</div>
									</div>
								</div>
							</div>
							<!--end Modal-->
							
                        </div>
						<hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-primary">
									
                                    <tr >
										<th>
											<b>No.</b>
										</th>
                                        <th>
                                            <b>Nama OPD</b>
                                        </th>
                                        <th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_opd as $no => $record)
									<tr>
										<td> {{++$no + ($semua_opd->currentPage()-1) * $semua_opd->perPage()}}</td>
										<td>{{ $record->nama_opd }}</td>
										<td class="td-actions text-right">
											<a rel="tooltip" href='#' class="btn btn-warning btn-link" data-toggle="modal" data-target="#modalEditOPD{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusOPD{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									<!-- modal hapus OPD -->
									<div class="modal fade" id="modalHapusOPD{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusOPD" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete OPD') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus opd : <span>{{ $record->nama_opd }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("opd/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus OPD!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									<!-- modal UPDATE/EDIT OPD -->
									<div class="modal fade" id="modalEditOPD{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditOPD" aria-hidden="true">
									  <div class="modal-dialog">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit OPD') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH OPD-->
										  <form action="{{url("opd/$record->id")}}" method="post">
											@csrf
											@method('put')
											
											   <div class="form-group">
												<label  for="">Nama OPD</label>
												<br>
												<input type="text" class="form-control" id="nama_opd" name="nama_opd" value="{{ $record->nama_opd}}" aria-describedby="emailHelp">
											   </div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH OPD-->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
								
                            </table>
							 {!! $semua_opd->links() !!}
							 
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
@endsection
