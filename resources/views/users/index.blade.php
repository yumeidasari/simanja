@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Manajemen User')])

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
                        <h4 class="card-title ">{{ __('Manajemen User') }}</h4>
                        <p class="card-category">{{ __('Form untuk Mengelola Data User') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a rel="tooltip" href="{{url('user/create')}}" class="btn btn-sm btn-primary">
									<i class="material-icons">person_add</i>
									<div class="ripple-container"></div>
								</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
										<th>
											No.
										</th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Creation date
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_user as $no => $record)
									<tr>
										<td> {{++$no + ($semua_user->currentPage()-1) * $semua_user->perPage()}}</td>
										<td>{{ $record->name }}</td>
										<td>{{ $record->email }}</td>
										<td>{{ $record->created_at }}</td>
										<td class="td-actions text-right">
											<a rel="tooltip" href='{{url("user/$record->id/edit")}}' class="btn btn-warning btn-link" data-original-title="" title="">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusUser{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									<!-- modal hapus user -->
									<div class="modal fade" id="modalHapusUser{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusUser" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete User') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus user : <span>{{ $record->name }} ?</span></h4>
												</div>
												
												<div class="modal-footer">
													<form action="{{url("user/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus User!</button>
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
							<!--Current Page: {{ $semua_user->currentPage() }}
							<br>
							Jumlah Data: {{ $semua_user->total() }}<br>
							<br>
							Data perhalaman: {{ $semua_user->perPage() }}<br>
							<br>
							
							-->
							{!! $semua_user->links() !!}
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
@endsection
