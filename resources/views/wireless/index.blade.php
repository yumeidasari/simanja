@extends('layouts.app', ['activePage' => 'wireless', 'titlePage' => __('Alamat IP')])

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
                        <h4 class="card-title ">{{ __('Alamat IP') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!--import file-->
								<form action="{{route('wireless.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
								  
							    </form>
							<!--------------->
							</div>
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('wireless')}}" method="GET">
                                    
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
								
                                <a title="tambah data" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahWireless">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="eksport file" href="{{ route('wireless.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
								
                            </div>
							
						</div>
						
						<div class="row">
							
							<!--Buat Modal tambah Wireless-->
							<div class="modal fade" id="modalTambahWireless" tabindex="-1" aria-labelledby="modalTambahWireless" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Data Wireless') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH WIRELESS-->
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
												<label for="">IP Router</label>
												<br>
												<input type="text" class="form-control" id="ip_router" name="ip_router" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">IP Client</label>
												<br>
												<input type="text" class="form-control" id="ip_client" name="ip_client" aria-describedby="emailHelp">
											</div>
																					
											<div class="form-group">
												<label for="">Keterangan</label>
												<br>
												<input type="text" class="form-control" id="keterangan" name="keterangan" aria-describedby="emailHelp">
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH WIRELESS-->
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
														<h4 class="card-title ">{{ __('Petunjuk Import Data Alamat IP') }}</h4>
													</div>
												</div>
												<div class="row">
													<div class="col-1">
													</div>
													<div class="col">
															<b>1. Untuk Header pada File Excel yang akan diimport atributnya :</b><br>
																nama_opd
																<br>
																ip_client
																<br>
																ip_router
																<br>
																keterangan
																<br><br>
																															
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
                                            <b>IP Router</b>
                                        </th>
										<th>
                                            <b>IP Client</b>
                                        </th>
																				
                                        <th class="text-right">
                                           <b> Actions<b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_wireless as $no => $record)
									<tr>
										<td> {{++$no + ($semua_wireless->currentPage()-1) * $semua_wireless->perPage()}}</td>
										<td>{{ $record->nama_opd }}</td>
										<td>{{ $record->ip_router }}</td>
										<td>{{ $record->ip_client }}</td>
										
										<td class="td-actions text-right">
											<a  title="Edit" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalEditWireless{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a  title="Hapus" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusWireless{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									
									<!-- modal hapus Wireless -->
									<div class="modal fade" id="modalHapusWireless{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusWireless" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Data Wireless') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data wireless: <span>{{ $record->nama_opd }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("wireless/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data wireless!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									<!-- modal UPDATE/EDIT WIRELESS -->
									<div class="modal fade" id="modalEditWireless{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditWireless" aria-hidden="true">
									  <div class="modal-dialog">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit data Wireless') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM UPDATE/EDIT WIRELESS-->
										  <form action="{{url("wireless/$record->id")}}" method="post">
											@csrf
											@method('put')
																						   
											   <div class="form-group">
												<label for="">Nama OPD</label>
												<br>
												<select name="id_opd" class="form-control">
													<option value="">Pilih OPD</option>
													@foreach($semua_opd as $opd)
														<option {{$record->id_opd == $opd->id ? "selected" : ""}} value="{{$opd->id}}"> {{$opd->nama_opd}} </option>
													@endforeach
												</select>
											   </div>
												
											   <div class="form-group">
												<label for="">IP Router</label>
												<br>
												<input type="text" class="form-control" id="ip_router" name="ip_router" value="{{$record->ip_router}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">IP Client</label>
												<br>
												<input type="text" class="form-control" id="ip_client" name="ip_client" value="{{$record->ip_client}}" aria-describedby="emailHelp">
											   </div>
																					
											   <div class="form-group">
												<label for="">Keterangan</label>
												<br>
												<input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$record->keterangan}}" aria-describedby="emailHelp">
											   </div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM UPDATE/EDIT JARINGAN-->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
                            </table>
							{{$semua_wireless->links()}}
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection

