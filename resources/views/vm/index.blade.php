@extends('layouts.app', ['activePage' => 'vm', 'titlePage' => __('Virtual Machine')])

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
                        <h4 class="card-title ">{{ __('Virtual Machine') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!--import file-->
								<form action="{{route('vm.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
								  
							    </form>
							<!--------------->
							</div>
							
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('vm')}}" method="GET">
                                    
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
								
                                <a rel="tooltip" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahVm">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="eksport file" href="{{ route('vm.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
								
                            </div>
							
						</div>
						<hr>
						<div class="row">
							
							<!--Buat Modal tambah Wireless-->
							<div class="modal fade" id="modalTambahVm" tabindex="-1" aria-labelledby="modalTambahVm" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Data VM') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH VM-->
										  <form action="" method="post">
											@csrf
											
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
												<label for="">Nama VM</label>
												<br>
												<input type="text" class="form-control" id="nama_vm" name="nama_vm" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">IP VM</label>
												<br>
												<input type="text" class="form-control" id="ip_vm" name="ip_vm" aria-describedby="emailHelp">
											</div>
																					
											<div class="form-group">
												<label for="">OS VM</label>
												<br>
												<input type="text" class="form-control" id="os_vm" name="os_vm" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Server</label>
												<br>
												<select class=form-control name="server_vm">
													<option value="">Pilih Server</option>
													<option value="10.10.10.3">10.10.10.3</option>
													<option value="10.10.10.4">10.10.10.4</option>
													<option value="10.10.10.5">10.10.10.5</option>
													<option value="10.10.10.6">10.10.10.6</option>
													<option value="10.10.10.7">10.10.10.7</option>
													<option value="10.10.10.8">10.10.10.8</option>
													<option value="10.10.10.9">10.10.10.9</option>
													<option value="10.10.10.10">10.10.10.10</option>
												</select>
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH VM-->
										</div>
									</div>
								</div>
							</div>
							<!--end Modal-->													
							
                        </div>
						
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
										<th>
											<b>No.</b>
										</th>
                                        
										<th>
                                            <b>Nama VM</b>
                                        </th>
										<th>
                                            <b>Tipe</b>
                                        </th>
										<th>
                                            <b>IP VM</b>
                                        </th>
										
										<th>
                                            <b>OS VM</b>
                                        </th>
										
										<th>
                                            <b>Server</b>
                                        </th>
																				
                                        <th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_vm as $no => $record)
									<tr>
										<td> {{++$no + ($semua_vm->currentPage()-1) * $semua_vm->perPage()}}</td>
										<td>{{ $record->nama_vm }}</td>
										<td>{{ $record->tipe }}</td>
										<td>{{ $record->ip_vm }}</td>
										<td>{{ $record->os_vm }}</td>
										<td>{{ $record->server_vm }}</td>
										<td class="td-actions text-right">
											<a rel="tooltip" title="Edit" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalEditVm{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" title="Hapus" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusVm{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									
									<!-- modal hapus VM-->
									<div class="modal fade" id="modalHapusVm{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusVm" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Data VM') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data VM: <span>{{ $record->nama_vm }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("vm/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data VM!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									<!-- modal UPDATE/EDIT VM -->
									<div class="modal fade" id="modalEditVm{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditVm" aria-hidden="true">
									  <div class="modal-dialog">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit data VM') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM UPDATE/EDIT VM-->
										  <form action="{{url("vm/$record->id")}}" method="post">
											@csrf
											@method('put')
																						   
											   
											   <div class="form-group">
												<label for="">Nama Alat</label>
												<br>
												<select name="id_alat" class="form-control">
													<option value="">Pilih Alat</option>
													@foreach($semua_alat as $alat)
														<option {{$record->id_alat == $alat->id ? "selected" : ""}} value="{{$alat->id}}"> {{$alat->nama_alat}} - {{$alat->tipe}} - {{$alat->model}} </option>
													@endforeach
												</select>
											   </div>
											
											   <div class="form-group">
												<label for="">Nama VM</label>
												<br>
												<input type="text" class="form-control" id="nama_vm" name="nama_vm" value="{{$record->nama_vm}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">IP VM</label>
												<br>
												<input type="text" class="form-control" id="ip_vm" name="ip_vm" value="{{$record->ip_vm}}" aria-describedby="emailHelp">
											   </div>
																					
											   <div class="form-group">
												<label for="">OS VM</label>
												<br>
												<input type="text" class="form-control" id="os_vm" name="os_vm" value="{{$record->os_vm}}" aria-describedby="emailHelp">
											   </div>
											   <div class="form-group">
												<label for="">Server</label>
												<br>
												<select class=form-control name="server_vm">
													<option {{$record->server_vm == "" ? "selected" : ""}} value="">Pilih Server</option>
													<option {{$record->server_vm == "10.10.10.3" ? "selected" : ""}} value="10.10.10.3">10.10.10.3</option>
													<option {{$record->server_vm == "10.10.10.4" ? "selected" : ""}} value="10.10.10.4">10.10.10.4</option>
													<option {{$record->server_vm == "10.10.10.5" ? "selected" : ""}} value="10.10.10.5">10.10.10.5</option>
													<option {{$record->server_vm == "10.10.10.6" ? "selected" : ""}} value="10.10.10.6">10.10.10.6</option>
													<option {{$record->server_vm == "10.10.10.7" ? "selected" : ""}} value="10.10.10.7">10.10.10.7</option>
													<option {{$record->server_vm == "10.10.10.8" ? "selected" : ""}} value="10.10.10.8">10.10.10.8</option>
													<option {{$record->server_vm == "10.10.10.9" ? "selected" : ""}} value="10.10.10.9">10.10.10.9</option>
													<option {{$record->server_vm == "10.10.10.10" ? "selected" : ""}} value="10.10.10.10">10.10.10.10</option>
												</select>
												</div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM UPDATE/EDIT VM-->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
                            </table>
							{{$semua_vm->links()}}
                        </div>
						<a href="{{url('tes-wifi')}}" class="btn btn-warning"> << Kembali</a>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection