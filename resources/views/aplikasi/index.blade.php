@extends('layouts.app', ['activePage' => 'aplikasi', 'titlePage' => __('Aplikasi')])

@section('content')
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/-->

<style>

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}
</style>

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
                        <h4 class="card-title ">{{ __('Aplikasi') }}</h4>
                        <p class="card-category">{{ __('Form untuk mengelola data Aplikasi') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!-- IMPORT FILE -->	
								<form action="{{route('aplikasi.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form>
								
							<!--END -->
							</div>
							
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('aplikasi')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</span>
									</div>
                    
								</form>
								
							</div>
                            <div class="col-2 text-right">
                                <a rel="tooltip" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahAplikasi">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="eksport file" href="{{ route('aplikasi.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
                            </div>
							<!--MoDAL LARGE-->
							<!--Buat Modal tambah Aplikasi-->
							<div class="modal fade bd-example-modal-lg" id="modalTambahAplikasi" tabindex="-1" aria-labelledby="modalTambahAplikasi" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Aplikasi') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH APLIKASI-->
										  <form action="" method="post">
											@csrf
										   
											 <div class="form-group">
												<label for="">Nama Aplikasi</label>
												<br>
												<input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" aria-describedby="emailHelp">
											 </div>
											 
											 <div class="form-group">
												<label for="">Fungsi</label>
												<br>
												<input type="text" class="form-control" id="fungsi" name="fungsi" aria-describedby="emailHelp">
											 </div>
											
											 <div class="form-group">
												<label for="">OPD </label>
												<br>
												<select name="id_opd" class="form-control">
													<option value="">Pilih OPD</option>
													@foreach($semua_opd as $opd)
														<option value="{{$opd->id}}"> {{$opd->nama_opd}} </option>
													@endforeach
												</select>
											 </div>
											
											 <div class="form-group">
												<label for="">Letak Server</label>
												<br>
												<input type="text" class="form-control" id="letak_server" name="letak_server" aria-describedby="emailHelp">
											 </div>
											
											<div class="form-group">
												<label for="">Link Repo</label>
												<br>
												<input type="text" class="form-control" id="link_repo" name="link_repo" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Domain URL</label>
												<br>
												<input type="text" class="form-control" id="domain_url" name="domain_url" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Domain IP</label>
												<br>
												<input type="text" class="form-control" id="domain_ip" name="domain_ip" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Jenis Layanan</label>
												<br>
												<select class=form-control name="jenis_layanan">
													<option value="">Pilih Jenis Layanan</option>
													<option value="PUBLIK">PUBLIK</option>
													<option value="LOKAL">NON PUBLIK</option>
												</select>
											</div>
											
											<div class="form-group">
												<label for="">Platform</label>
												<br>
												<select class=form-control name="platform">
													<option value="">Pilih Platform</option>
													<option value="WEB">WEB</option>
													<option value="DESKTOP">DESKTOP</option>
												</select>
											</div>
											
											<div class="form-group">
												<label for="">Versi Aplikasi</label>
												<br>
												<input type="text" class="form-control" id="versi" name="versi" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Pengembang</label>
												<br>
												<input type="text" class="form-control" id="pengembang" name="pengembang" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Bahasa Pemrograman</label>
												<br>
												<input type="text" class="form-control" id="bhs_pemrograman" name="bhs_pemrograman" aria-describedby="emailHelp">
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH APLIKASI-->
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
														<h4 class="card-title ">{{ __('Petunjuk Import Data Aplikasi') }}</h4>
													</div>
												</div>
												<div class="row">
													<div class="col-1">
													</div>
													<div class="col">
															<b>1. Untuk Header pada File Excel yang akan diimport atributnya :</b><br>
																nama_opd
																<br>
																nama_aplikasi
																<br>
																letak_server
																<br>
																link_repo
																<br>
																domain_url
																<br>
																domain_ip
																<br>
																jenis_layanan  (Fieldnya diisi dengan 'LOKAL' atau 'PUBLIK')
																<br>
																fungsi
																<br>
																platform  (Fieldnya diisi dengan 'WEB' atau 'DESKTOP)
																<br>
																versi
																<br>
																pengembang
																<br>
																bhs_pemrograman
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
                                        <th><center>
                                            <b>Nama Aplikasi</b>
										</center>
                                        </th>
										<th><center>
                                            <b>OPD Pengguna</b>
										</center>
                                        </th>
										<th><center>
                                            <b>URL</b>
										</center>
                                        </th>
										<th width="120px">
                                            <b>Domain IP</b>
                                        </th>
										<th >
                                            <b>Link Repo</b>
                                        </th>
                                        <th width="75px" class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_aplikasi as $no => $record)
									<tr>
										<td> {{++$no + ($semua_aplikasi->currentPage()-1) * $semua_aplikasi->perPage()}}</td>
										<td>{{ $record->nama_aplikasi }}</td>
										<td>{{ $record->nama_opd }}</td>
										<td> <a target='_BLANK' href='http://{{$record->domain_url}}' class='link' >{{ $record->domain_url }}</a></td>
										<td>{{ $record->domain_ip }}</td>
										<td><a target='_BLANK' href='http://{{ $record->link_repo }}' class='link' >{{ $record->link_repo }}</a></td>
										<td width="75px" class="td-actions text-right">
											<a rel="tooltip" href='#' class="btn btn-warning btn-link" data-toggle="modal" data-target="#modalEditAplikasi{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAplikasi{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									<!-- modal hapus Aplikasi -->
									<div class="modal fade" id="modalHapusAplikasi{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusAplikasi" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Aplikasi') }}</h4>
													</div>
												</div>
												<!--div class="modal-body"-->
													<h4 class="text-center">Apakah anda yakin ingin menghapus data aplikasi : <span>{{ $record->nama_aplikasi }} ?</span></h4>
												<!--/div-->
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("aplikasi/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus Aplikasi!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									<!--MODAL BESAR-->
									<!-- modal UPDATE/EDIT Aplikasi -->
									<div class="modal fade bd-example-modal-lg" id="modalEditAplikasi{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditAplikasi" aria-hidden="true">
									  <div class="modal-dialog modal-lg">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit Aplikasi') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM EDIT APLIKASI-->
										  <form action="{{url("aplikasi/$record->id")}}" method="post" enctype="multipart/form-data">
											@csrf
											@method('put')
											{{ method_field('PUT') }}
											
											   <div class="form-group">
												<label for="">Nama Aplikasi</label>
												<br>
												<input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" value="{{ $record->nama_aplikasi}}" aria-describedby="emailHelp">
											   </div>
											   
											   <div class="form-group">
												<label for="">Fungsi</label>
												<br>
												<input type="text" class="form-control" id="fungsi" name="fungsi" value="{{ $record->fungsi}}" aria-describedby="emailHelp">
											 </div>
											
											   <div class="form-group">
												<label for="">OPD </label>
												<br>
												<select name="id_opd" class="form-control">
													<option value="">Pilih OPD</option>
													@foreach($semua_opd as $opd)
														<option {{$record->id_opd == $opd->id ? "selected" : ""}} value="{{$opd->id}}"> {{$opd->nama_opd}} </option>
													@endforeach
												</select>
											   </div>
											   		
											   <div class="form-group">
												<label for="">Letak Server</label>
												<br>
												<input type="text" class="form-control" id="letak_server" name="letak_server" value="{{ $record->letak_server}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Link Repo</label>
												<br>
												<input type="text" class="form-control" id="link_repo" name="link_repo" value="{{ $record->link_repo}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Domain URL</label>
												<br>
												<input type="text" class="form-control" id="domain_url" name="domain_url" value="{{ $record->domain_url}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Domain IP</label>
												<br>
												<input type="text" class="form-control" id="domain_ip" name="domain_ip" value="{{ $record->domain_ip}}" aria-describedby="emailHelp">
											   </div>
											   
											   <div class="form-group">
												<label for="">Jenis Layanan</label>
												<br>
												<select class=form-control name="jenis_layanan">
													<option {{$record->jenis_layanan == "" ? "selected" : ""}} value="">Pilih Jenis Layanan</option>
													<option {{$record->jenis_layanan == "PUBLIK" ? "selected" : ""}} value="PUBLIK">PUBLIK</option>
													<option {{$record->jenis_layanan == "LOKAL" ? "selected" : ""}} value="LOKAL">NON PUBLIK</option>
												</select>
											   </div>
											
											   <div class="form-group">
												<label for="">Platform</label>
												<br>
												<select class=form-control name="platform">
													<option {{$record->platform == "" ? "selected" : ""}} value="">Pilih Platform</option>
													<option {{$record->platform == "WEB" ? "selected" : ""}} value="WEB">WEB</option>
													<option {{$record->platform == "DESKTOP" ? "selected" : ""}} value="DESKTOP">DESKTOP</option>
												</select>
											   </div>
											   
											   <div class="form-group">
												<label for="">Versi Aplikasi</label>
												<br>
												<input type="text" class="form-control" id="versi" name="versi" value="{{ $record->versi}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Pengembang</label>
												<br>
												<input type="text" class="form-control" id="pengembang" name="pengembang" value="{{ $record->pengembang}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Bahasa Pemrograman</label>
												<br>
												<input type="text" class="form-control" id="bhs_pemrograman" name="bhs_pemrograman" value="{{ $record->bhs_pemrograman}}" aria-describedby="emailHelp">
											   </div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM EDIT APLIKASI -->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
                            </table>
							{{$semua_aplikasi->links()}}
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection

