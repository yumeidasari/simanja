@extends('layouts.app', ['activePage' => 'jaringan-opd', 'titlePage' => __('Perangkat Jaringan')])

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
                        <h4 class="card-title ">{{ __('Perangkat Jaringan') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							
							<div class="col-5">
							<!--Form pencarian -->
								<form action="{{url('perangkat-jaringan-tes')}}" method="GET">
                                    
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
							<div class="col-5">
							<!-- IMPORT FILE -->	
								<!--form action="{{route('opd.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form-->
							<!--END -->
							</div>
                            <div class="col-2 text-right">
                               <a title="tampil semua data perangkat" href="{{url('jaringan-opd')}}" class="btn btn-sm btn-rose">
									
										View All
									<div class="ripple-container"></div>
								</a>
								
                            </div>
							
							
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
										<th>
                                            <b>Total Perangkat</b>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_opd as $no => $record)
									<tr>
										<td> {{++$no + ($semua_opd->currentPage()-1) * $semua_opd->perPage()}}</td>
										<td>
											<a data-toggle="modal" data-target="#modalTampilPerangkat{{ $record->id }}"  href='#' class='link' >{{ $record->nama_opd }}</a>
										</td>
										<td>{{ $record->total_alat }}</td>
										

									</tr>
									<!-- Modal Show Perangkat-->
									<div class="modal fade bd-example-modal-lg" id="modalTampilPerangkat{{ $record->id }}" tabindex="-1" aria-labelledby="modalTampilPerangkat" aria-hidden="true">
										<div class="modal-dialog modal-dialog-scrollable modal-lg">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">DAFTAR PERANGKAT PADA {{ $record->nama_opd }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<div class="row text-primary">
														<div class="col">
															<b>No.</b>
														</div>
														<div class="col">
															<b>Nama Alat</b>
														</div>
														<div class="col">
															<b>Tipe</b>
														</div>
														<div class="col">
															<b>Model</b>
														</div>
														<div class="col">
															<b>Kondisi</b>
														</div>
														<div class="col-3">
															<center><b>Action</b></center>
														</div>
													</div><!--end row-->
													<hr>
													@foreach($perangkat as $no=>$row)
														@if($row->id_opd == $record->id)
															<div class="row">
																<div class="col">
																	{{++$no}}
																</div>
																<div class="col">
																	{{ $row->nama_alat }}
																</div>
																<div class="col">
																	{{ $row->tipe }}
																</div>
																<div class="col">
																	{{ $row->model }}
																</div>
																<div class="col">
																	{{ $row->kondisi }}
																</div>
																<div class="col-3 text-right">
																
																	<a  title="Edit" href='{{url("jaringan-opd/$row->id/edit")}}' class="btn btn-warning btn-link" data-original-title="" title="">
																		<i class="material-icons">edit</i>
																		<div class="ripple-container"></div>
																	</a>
																	<a  title="Hapus" href="{{url("/perangkat-jaringan-tes/$row->id/destroy")}}" class="btn btn-danger btn-link" >
																		<i class="material-icons">delete</i>
																		<div class="ripple-container"></div>
																	</a>
																</div>
															</div><!--end row-->
															<hr>
														@else
															
														@endif
														<!-- modal hapus Perangkat -->
														<div class="modal fade" id="modalHapusJaringan{{ $row->id }}" tabindex="-2" aria-labelledby="modalHapusJaringan" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="card">
																		<div class="card-header card-header-rose">
																			<h4 class="card-title ">{{ __('Delete Data Perangkat') }}</h4>
																		</div>
																	</div>
																	<div class="modal-body">
																		<h4 class="text-center">Apakah anda yakin ingin menghapus data perangkat: <span>{{ $record->nama_opd }} ?</span></h4>
																	</div>
																	
																	<div class="modal-footer  ml-auto mr-auto">
																		<form action="{{url("jaringan-opd/$row->id")}}" method="post">
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
													@endforeach
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
							 {!! $semua_opd->links() !!}
							 
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection
