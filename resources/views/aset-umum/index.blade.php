@extends('layouts.app', ['activePage' => 'aset-umum', 'titlePage' => __('Aset Umum')])

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
                        <h4 class="card-title ">{{ __('Aset Umum') }}</h4>
                        <p class="card-category">{{ __('Form untuk mengelola data aset umum Diskomifo') }}</p>
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
							
								<form action="{{url('aset-umum')}}" method="GET">
                                    
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
								
                                <a title="tambah data" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahAlat">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								{{--	
								<a title="eksport file" href="{{ route('alat.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">save_alt</i>
									
									<div class="ripple-container"></div>
								</a>
								--}}							
                            </div>
							
							
							<!--Buat Modal tambah Alat-->
							<div class="modal fade" id="modalTambahAlat" tabindex="-1" aria-labelledby="modalTambahAlat" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Tambah Alat') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM TAMBAH ALAT-->
										  <form action="" method="post">
											@csrf
											<div class="form-group">
												<label for="">Nama Alat</label>
												<br>
												<input type="text" class="form-control" id="nama_alat" name="nama_alat" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Tipe</label>
												<br>
												<input type="text" class="form-control" id="tipe" name="tipe" aria-describedby="emailHelp">
											</div>
											
											<div class="form-group">
												<label for="">Model</label>
												<br>
												<input type="text" class="form-control" id="model" name="model" aria-describedby="emailHelp">
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
									{{--	<th>
											<b>No.</b>
										</th>
									--}}
                                        <th>
                                            <b>Jenis Barang</b>
                                        </th>
										<th>
                                            <b>Nama Barang</b>
                                        </th>
										<th>
                                            <b>Merek</b>
                                        </th>
										<th>
                                            <b>Penanggung Jawab</b>
                                        </th>
										<th>
                                            <b>Unit Kerja/Bidang</b>
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
									@foreach($semua_aset as $no => $record)
									@if (auth()->user()->role == 'USER')
										@if ($record->id_unit_kerja == auth()->user()->id_bidang)
									<tr>
									{{-- <td>{{ $semua_aset->firstItem() + $loop->index }} {{++$no + ($semua_aset->currentPage()-1) * $semua_aset->perPage()}}</td> --}}
										<td>{{ $record->jenis_aset }}</td>
										<td>
											<a rel="tooltip"  href="{{ url("/aset-umum/detail/$record->id") }}" class="btn btn-primary btn-link" >
												{{ $record->nama_aset }}
											</a>
										
										</td>
										<td>{{ $record->merek }}</td>
										<td>{{ $record->penanggung_jawab }}</td>
										<td>{{ $record->bidang }}</td>
										@if ($record->kondisi_aset == 'baik')
											<td><span class="badge badge-success">{{ $record->kondisi_aset }}</span></td>
										@elseif ($record->kondisi_aset == 'rusak ringan')
											<td><span class="badge badge-warning">{{ $record->kondisi_aset }}</span></td>
										@else
											<td><span class="badge badge-danger">{{ $record->kondisi_aset }}</span></td>
										@endif
										<td class="td-actions text-right">
										{{--
											<a rel="tooltip"  href='#' class="btn btn-warning btn-link" data-toggle="modal" data-target="#modalEditAlat{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
										--}}
											{{--
											<a rel="tooltip"  href="{{ url("/alat/detail2/$record->id") }}" class="btn btn-primary btn-link" >
												<i class="material-icons">note</i>
												<div class="ripple-container"></div>
											</a>
											--}}
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAlat{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
										@endif
									@else
										<tr>
									{{-- <td>{{ $semua_aset->firstItem() + $loop->index }} {{++$no + ($semua_aset->currentPage()-1) * $semua_aset->perPage()}}</td> --}}
										<td>{{ $record->jenis_aset }}</td>
										<td>
											<a rel="tooltip"  href="{{ url("/aset-umum/detail/$record->id") }}" class="btn btn-primary btn-link" >
												{{ $record->nama_aset }}
											</a>
										
										</td>
										<td>{{ $record->merek }}</td>
										<td>{{ $record->penanggung_jawab }}</td>
										<td>{{ $record->bidang }}</td>
										@if ($record->kondisi_aset == 'baik')
											<td><span class="badge badge-success">{{ $record->kondisi_aset }}</span></td>
										@elseif ($record->kondisi_aset == 'rusak ringan')
											<td><span class="badge badge-warning">{{ $record->kondisi_aset }}</span></td>
										@else
											<td><span class="badge badge-danger">{{ $record->kondisi_aset }}</span></td>
										@endif
										<td class="td-actions text-right">
										{{--
											<a rel="tooltip"  href='#' class="btn btn-warning btn-link" data-toggle="modal" data-target="#modalEditAlat{{ $record->id }}">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
										--}}
											{{--
											<a rel="tooltip"  href="{{ url("/alat/detail2/$record->id") }}" class="btn btn-primary btn-link" >
												<i class="material-icons">note</i>
												<div class="ripple-container"></div>
											</a>
											--}}
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAlat{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									@endif
									<!-- modal hapus ALAT -->
									<div class="modal fade" id="modalHapusAlat{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusAlat" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Aset') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data alat: <span>{{ $record->nama_aset }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("aset-umum/$record->id")}}" method="post">
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
									
									<!-- modal UPDATE/EDIT ALAT -->
									<div class="modal fade" id="modalEditAlat{{ $record->id }}" tabindex="-1" aria-labelledby="modalEditAlat" aria-hidden="true">
									  <div class="modal-dialog">
									   <div class="modal-content">
										
										<div class="card">
											<div class="card-header card-header-rose">
												<h5 class="card-title ">{{ __('Edit data Alat') }}</h4>
												
											</div>
										</div>
										<div class="modal-body">
										  <!--FORM UBAH ASET KANTOR-->
										  <form action="{{url("aset-umum/$record->id")}}" method="post">
											@csrf
											@method('put')
																						   
											   <div class="form-group">
												<label for="">Nama Alat</label>
												<br>
												<input type="text" class="form-control" id="nama_alat" name="nama_alat" value="{{ $record->nama_aset}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Tipe</label>
												<br>
												<input type="text" class="form-control" id="tipe" name="tipe" value="{{ $record->merek}}" aria-describedby="emailHelp">
											   </div>
											
											   <div class="form-group">
												<label for="">Model</label>
												<br>
												<input type="text" class="form-control" id="model" name="model" value="{{ $record->jenis_aset}}" aria-describedby="emailHelp">
											   </div>
											  
											<button type="submit" class="btn btn-primary">Simpan Data</button>
											<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
										  </form>
										  <!--END FORM UBAH ASET-->
										</div>
									   </div>
								     </div>
									</div>
									<!-- end modal-->
									
									@endforeach
									
                                </tbody>
                            </table>
							{{ $semua_aset->links() }} 
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
@endsection
