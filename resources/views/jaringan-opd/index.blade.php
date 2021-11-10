@extends('layouts.app', ['activePage' => 'jaringan-opd', 'titlePage' => __('Perangkat Jaringan -> View All')])

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
                        <h4 class="card-title ">{{ __('Perangkat Jaringan -> View All') }}</h4>
                        <p class="card-category">{{ __('Form untuk mengelola Semua data Peralatan yang digunakan') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!-- IMPORT FILE -->	
								<form action="{{route('jaringan-opd.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form>
							<!--END -->
							</div>
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('jaringan-opd')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search ...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</span>
									</div>
                    
								</form>
								
							</div>
                            <div class="col-2 text-right">
                                <a title="tambah data" href="{{url('jaringan-opd/create')}}" class="btn btn-sm btn-rose">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="eksport file" href="{{ route('jaringan-opd.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
                            </div>
							
							<!--Buat Modal tambah Jaringan-->
							<div class="modal fade" id="modalTambahJaringan" tabindex="-1" aria-labelledby="modalTambahJaringan" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Data Jaringan OPD') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH JARINGAN-->
										  <form action="" method="post">
											@csrf
											<div class="form-group">
												<label for="">Nama OPD</label>
												<br>
												<select name="id_opd" class="form-control">
													<option value="">Pilih OPD</option>
													@foreach($semua_opd as $opd)
														<option value="{{$opd->id}}"> {{$opd->nama_opd}} </option>
													@endforeach
												</select>
											</div>
											
											<div class="form-group">
												<label for="">Nama Alat</label>
												<br>
												<select name="id_alat" class="form-control">
													<option value="">Pilih Alat</option>
													@foreach($semua_alat as $alat)
														<option value="{{$alat->id}}"> {{$alat->nama_alat}} - {{$alat->tipe}} - {{$alat->model}} </option>
													@endforeach
												</select>
											</div>
											
											<div class="form-group">
												<label for="">Kondisi</label>
												<br>
												<select class=form-control name="kondisi">
													<option value="">Pilih Kondisi</option>
													<option value="BAIK">BAIK</option>
													<option value="RUSAK">RUSAK</option>
												</select>
											</div>
																					
											<div class="form-group">
												<label for="">Tgl Pemasangan</label>
												<br>
												<input type="text" class="date form-control" name="tgl_pemasangan" id="datepicker">
											</div>
																																	
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH JARINGAN-->
										</div>
									</div>
								</div>
							</div>
							<!--end Modal-->
							
                        </div>
						<div class="row">
							<div class="col-5">
								<a title="catatan" href='#' class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalTampilCatatan">
									<i class="material-icons">help</i>
									Petunjuk untuk Import
									<div class="ripple-container"></div>
								</a>
							</div>
							<!-- modal Tampil Catatan -->
									<div class="modal fade bd-example-modal-lg" id="modalTampilCatatan" tabindex="-1" aria-labelledby="modalTampilCatatan" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Petunjuk Import Data Perangkat Jaringan') }}</h4>
													</div>
												</div>
												<div class="row">
													<div class="col-1">
													</div>
													<div class="col">
															<b>1. Untuk Header pada File Excel yang akan diimport atributnya :</b><br>
																<b>nama_opd</b>
																<br>
																<b>nama_alat</b>
																<br>
																<b>tipe</b>     (Tipe Alat)
																<br>
																<b>model</b>    (Model Alat)
																<br>
																<b>kode_alat</b>
																<br>
																<b>kondisi</b>  (Fieldnya diisi dengan 'BAIK' atau 'RUSAK)
																<br>
																															
															<b>2. Semua atribut harus diisi (tidak boleh kosong) </b>
													</div>
												</div>											
												<div class="modal-footer  ml-auto mr-auto">
													
														<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
													
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
						</div>
						<hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
										<th>
											<b>No.</b>
										</th>
                                        <th>
                                            <b>Nama OPD</b>
                                        </th>
										<th>
                                            <b>Nama alat</b>
                                        </th>
										<th>
                                            <b>Tipe alat</b>
                                        </th>
										<th>
                                            <b>Model alat</b>
                                        </th>
										<th>
                                            <b>Kode alat</b>
                                        </th>
										<th>
                                            <b>Kondisi</b>
                                        </th>
										
                                        <th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_jaringan as $no => $record)
									<tr>
										<td> {{++$no + ($semua_jaringan->currentPage()-1) * $semua_jaringan->perPage()}}</td>
										<td>{{ $record->nama_opd }}</td>
										<td>
											<a data-toggle="modal" data-target="#modalTampilFoto{{ $record->id }}" href='#' class='link' >{{ $record->nama_alat }}</a>
										</td>
										<td>{{ $record->tipe }}</td>
										<td>{{ $record->model }}</td>
										<td>{{ $record->kode_alat }}</td>
										<td>{{ $record->kondisi }}</td>
										<td class="td-actions text-right">
											<a  title="Edit" href='{{url("jaringan-opd/$record->id/edit")}}' class="btn btn-warning btn-link" data-original-title="" title="">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a  title="Hapus" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusJaringan{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									
									<!-- modal hapus JARINGAN -->
									<div class="modal fade" id="modalHapusJaringan{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusJaringan" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Data Jaringan') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data jaringan: <span>{{ $record->nama_opd }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("jaringan-opd/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data jaringan!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									<!-- modal Tampil foto -->
									<div class="modal fade" id="modalTampilFoto{{ $record->id }}" tabindex="-1" aria-labelledby="modalTampilFoto" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Gambar Alat') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													
														<div >
				  
															<br>
															@if(isset($record->foto))
																<center><img width="120px" src="{{asset("/storage/$record->foto")}}" alt="foto"></center>
															@else
																Belum Ada Gambar Alat
															@endif
				 
														</div>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													
														<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
													
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
																		
									@endforeach
									
                                </tbody>
								
                            </table>
							<th colspan="10">{{$semua_jaringan->links()}}</th>
                        </div>
						<a href="{{url('perangkat-jaringan-tes')}}" class="btn btn-warning"> << Kembali</a>
                    </div>
					
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
<script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true   
              
         }); 
		
		$('#datepicker1').datepicker({ 
            autoclose: true   
              
         });
               
  </script>
@endsection

