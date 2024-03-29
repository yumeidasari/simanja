@extends('layouts.app', ['activePage' => 'vm', 'titlePage' => __('Server')])

@section('content')
<style>
/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal1-body{
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
                        <h4 class="card-title ">{{ __('Server') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('tes-wifi')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search by nama server...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i> Cari</button>
										</span>
									</span>
									</div>
                    
								</form>
								
							</div>
							<div class="col-4">
							<!-- IMPORT FILE -->	
								<!--form action="{{route('opd.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form-->
							<!--END -->
							</div>
                            <div class="col-3 text-right">
								 <a title="tambah data server" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahServer">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="tampil semua data host server" href="{{url('vm')}}" class="btn btn-sm btn-rose">
										
									View All
									<div class="ripple-container"></div>
								</a>
								
                            </div>
							<!--Buat Modal tambah Server-->
							<div class="modal fade" id="modalTambahServer" tabindex="-1" aria-labelledby="modalTambahServer" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Server') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH SERVER-->
										  <form action="" method="post">
											@csrf
											<div class="form-group">
												<label for="">Nama Server</label>
												<br>
												<input type="text" class="form-control" id="nama_server" name="nama_server" aria-describedby="emailHelp">
											</div>
											<div class="form-group">
												<label for="">Jenis Server</label>
												<br>
												<select class=form-control name="model_server">
													<option value="">Pilih Jenis Server</option>
													<option value="VM WARE">VM WARE</option>
													<option value="PROXMOX">PROXMOX</option>
												</select>
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH SERVER-->
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
                                            <b>Server</b>
                                        </th>
										<th>
                                            <b>Jenis Server</b>
                                        </th>
										<th>
                                            <b>Jumlah Host</b>
                                        </th>
										<th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_server as $no => $record)
									<tr>
										<td> {{++$no + ($semua_server->currentPage()-1) * $semua_server->perPage()}}</td>
										<td>
											<a data-toggle="modal" data-target="#modalTampilPerangkat{{ $record->id }}"  href='#' class='link' >{{ $record->nama_server }}</a>
										</td>
										<td>{{ $record->model_server }}</td>
										<td>{{ $record->jml_host }}</td>
										<td class="td-actions text-right">
											<a title="hapus server" title="Hapus" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusServer{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
										</td>									

									</tr>
									<!-- Modal Show Perangkat-->
									<div class="modal fade bd-example-modal-lg" id="modalTampilPerangkat{{ $record->id }}" tabindex="-1" aria-labelledby="modalTampilPerangkat" aria-hidden="true">
										<div class="modal-dialog modal-dialog-scrollable modal-lg">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">DAFTAR HOST PADA SERVER {{ $record->nama_server }}</h4>
													</div>
												</div>
												<div class="modal1-body">
													<div class="row text-primary">
														<div class="col-2">
															<center><b>No.</b></center>
														</div>
														<div class="col">
															<b>Nama Host</b>
														</div>
														<div class="col">
															<b>IP</b>
														</div>
														<div class="col">
															<b>OS</b>
														</div>
														<!--div class="col-3">
															<center><b>Action</b></center>
														</div-->
													</div><!--end row-->
													<hr>
													@php $i=1 @endphp
													@foreach($host_vm as $row)
														@if($row->server_vm == $record->nama_server)
															<div class="row">
																<div class="col-2">
																	<center>{{$i++}}</center>
																</div>
																<div class="col">
																	{{ $row->nama_vm }}
																</div>
																<div class="col">
																	{{ $row->ip_vm }}
																</div>
																<div class="col">
																	{{ $row->os_vm }}
																</div>
																<!--div class="col-3 text-right">
																
																	<a  title="Edit" href='{{url("vm/$row->id/edit")}}' class="btn btn-warning btn-link" data-original-title="" title="">
																		<i class="material-icons">edit</i>
																		<div class="ripple-container"></div>
																	</a>
																	<a  title="Hapus" href="{{url("/tes-wifi/$row->id/destroy")}}" class="btn btn-danger btn-link" >
																		<i class="material-icons">delete</i>
																		<div class="ripple-container"></div>
																	</a>
																</div-->
															</div><!--end row-->
															<hr>
														@else
															
														@endif
														
													@endforeach
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													
														<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
													
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									<!-- modal hapus VM-->
									<div class="modal fade" id="modalHapusServer{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusServer" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Data Server') }}</h4>
														<p class="card-category">{{ __('!! Jika data dihapus, maka data yang memiliki relasi dengan data ini juga akan dihapus !!') }}</p>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data Server: <span>{{ $record->nama_server }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("tes-wifi/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data Server!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
								
                            </table>
							 {!! $semua_server->links() !!}
							 
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection