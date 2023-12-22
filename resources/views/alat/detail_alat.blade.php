@extends('layouts.app', ['activePage' => 'alat', 'titlePage' => __('Detail Alat')])

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
                        <h4 class="card-title ">{{ __('Detail Alat')}}</h4>
						<h4></h4>
                        <p class="card-category">{{ __($data->nama_alat) }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!-- IMPORT FILE -->
							{{--
								<form action="{{route('alat.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form>
							--}}
							<!--END -->
							</div>
							
							<div class="col-5">
							<!--Form pencarian -->
							{{--
								<form action="{{url('alat')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</span>
									</div>
                    
								</form>
							--}}	
							</div>
							
							<div class="col-2 text-right">
								
                                <a title="tambah data" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahAlat">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								
								<a title="eksport file" href="{{ route('exportDetail') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
								
															
                            </div>
							
							
							<!--Buat Modal tambah Detail Alat-->
							<div class="modal fade" id="modalTambahAlat" tabindex="-1" aria-labelledby="modalTambahAlat" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Data Detail Alat') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH Detail ALAT-->
										  <form action="{{ route('simpanDetailAlat') }}" method="post">
											@csrf
											<input type="hidden" name="id_alat" id="haid" value="{{$data->id}}" />
											<div class="form-group">
												<label for="">Tanggal Pengadaan</label>
												<br>
												<input type="date" class="form-control" id="tgl_pengadaan" name="tgl_pengadaan" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Jumlah</label>
												<br>
												<input type="text" class="form-control" id="jumlah" name="jumlah" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Harga</label>
												<br>
												<input type="number_format" class="form-control" id="harga" name="harga" aria-describedby="emailHelp">
											</div>
											
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH ALAT-->
										</div>
									</div>
								</div>
							</div>
							<!--end Modal-->
							
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
                                            <b>Tanggal Pengadaan</b>
                                        </th>
										<th>
                                            <b>Jumlah</b>
                                        </th>
										<th>
                                            <b>Harga</b>
                                        </th>
                                        <th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
								@if(count($detil) > 0)
									@foreach($detil as $no => $record)
									<tr>
										<td> {{ ++$no + ($detil->currentPage()-1) * $detil->perPage() }}</td>
										<td>{{ $record->tgl_pengadaan }}</td>
										<td>{{ $record->jumlah }}</td>
										<td>Rp. {{ $record->harga }}</td>
										<td class="td-actions text-right">
											<a rel="tooltip"  href='#' class="btn btn-warning btn-link" data-toggle="modal" data-target="#modalEditAlat{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAlat{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									<!-- modal hapus detail ALAT -->
									<div class="modal fade" id="modalHapusAlat{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusAlat" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Alat') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data detail alat: <span>{{ $data->nama_alat }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("alat/detail/del/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data alat!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									
									<!-- modal UPDATE/EDIT DETAIL ALAT -->
									<div class="modal fade" id="modalEditAlat{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditAlat" aria-hidden="true">
									  <div class="modal-dialog">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit data Detail Alat') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH ALAT-->
										  <form action="{{url("alat/detail/updt/$record->id")}}" method="post">
											@csrf
											@method('put')
																						   
											   <div class="form-group">
												<label for="">Tanggal Pengadaan</label>
												<br>
												<input type="date" class="form-control" id="uptgl_pengadaan" name="tgl_pengadaan" value="{{ $record->tgl_pengadaan }}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Jumlah</label>
												<br>
												<input type="text" class="form-control" id="upjumlah" name="jumlah" value="{{ $record->jumlah }}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Harga</label>
												<br>
												<input type="text" class="form-control" id="upharga" name="harga" value="Rp. {{ $record->harga }}" aria-describedby="emailHelp">
											   </div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM TAMBAH DETAIL ALAT-->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
								@else
									-- Belum ada data detail alat --
								@endif
                                </tbody>
                            </table>
							{{-- $detil->links() --}}
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
@endsection
