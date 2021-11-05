<div class="sidebar" data-color="rose" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-5.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <!--a width="50px" href="{{ asset('/storage/img/beltim.png') }}" class="simple-text logo-normal">
      {{ __('SIMAPDA') }}
    </a-->
	<center>
	<a href="home" class="brand-link">
		<img width="50px" src="{{ asset('/storage/img/beltim.png') }}" alt="Sipakcamar Logo" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<br>
		<h3><b>{{ __('SIMANJA') }}</b></h3>
	</a>
	</center>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <!--i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i-->
		  <!--i class="material-icons">line_weight</i-->
          <p style="background-color:pink;"><i class="material-icons">line_weight</i>{{ __('Data User') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <!--i class="material-icons">manage_accounts</i-->
				<lord-icon
					src="https://cdn.lordicon.com/imamsnbq.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp;{{ __('User profile') }} 
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <!--i class="material-icons">people_alt</i-->
				<lord-icon
					src="https://cdn.lordicon.com/ippkhukl.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp;{{ __('Manajemen User') }} 
              </a>
            </li>
          </ul>
        </div>
      </li>
	  
	  <li class="nav-item {{ ( $activePage == 'aplikasi' || $activePage == 'jaringan-opd' || $activePage == 'wireless' || $activePage == 'vm') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#dataAset" aria-expanded="true">
          <!--i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i-->
		  <!--i class="material-icons">table_view</i-->
          <p style="background-color:pink;"><i class="material-icons">table_view</i>{{ __('Data Aset') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="dataAset">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'aplikasi' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('aplikasi.index') }}">
                <!--i class="material-icons">api</i-->
				<lord-icon
					src="https://cdn.lordicon.com/isvvzjbf.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp;{{ __('Aplikasi') }} 
              </a>
            </li>
			
            <li class="nav-item{{ $activePage == 'jaringan-opd' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('jaringan-opd.index') }}">
                <!--i class="material-icons">mediation</i-->
				<lord-icon
					src="https://cdn.lordicon.com/ybfcwnqv.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                 &nbsp;{{ __('Peralatan Jaringan') }} 
              </a>
            </li>
			<li class="nav-item{{ $activePage == 'wireless' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('wireless.index') }}">
                <!--i class="material-icons">mediation</i-->
				<lord-icon
				src="https://cdn.lordicon.com/tclnsjgx.json"
				trigger="loop"
				colors="primary:#121331,secondary:#08a88a"
				style="width:30px;height:30px">
				</lord-icon>
                &nbsp;  {{ __('Alamat IP') }} 
              </a>
            </li>
			
			<li class="nav-item{{ $activePage == 'vm' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vm.index') }}">
                <!--i class="material-icons">mediation</i-->
				<lord-icon
					src="https://cdn.lordicon.com/wrprwmwt.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp;&nbsp;{{ __('Virtual Mesin') }} 
              </a>
            </li>
          </ul>
        </div>
      </li>
	  
	  <li class="nav-item {{ ($activePage == 'opd' || $activePage == 'alat') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#dataReferensi" aria-expanded="true">
          <!--i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i-->
		  <!--i class="material-icons">library_books</i-->
          <p style="background-color:pink;"><i class="material-icons">library_books</i>{{ __('Data Referensi') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="dataReferensi">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'opd' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('opd.index') }}">
                <!--i class="material-icons">api</i-->
				<lord-icon
					src="https://cdn.lordicon.com/gqzfzudq.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp;{{ __('OPD') }} 
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'alat' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('alat.index') }}">
                <!--i class="material-icons">mediation</i-->
				<lord-icon
					src="https://cdn.lordicon.com/qghrdngw.json"
					trigger="loop"
					colors="primary:#121331,secondary:#08a88a"
					style="width:30px;height:30px">
				</lord-icon>
                &nbsp; {{ __('Alat') }} 
              </a>
            </li>
          </ul>
        </div>
      </li>
	  
      <!--li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li-->
	  
      <!--li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li-->
	  
      <!--li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li-->
	  
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <!--i class="material-icons">location_ons</i-->
		  <lord-icon
				src="https://cdn.lordicon.com/zzcjjxew.json"
				trigger="loop"
				colors="primary:#121331,secondary:#08a88a"
				style="width:30px;height:30px">
		  </lord-icon>
            &nbsp;{{ __('Peta Jaringan FO') }}
        </a>
      </li>
	  
      <!--li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li-->
	  
      <!--li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li-->
      
    </ul>
  </div>
</div>
