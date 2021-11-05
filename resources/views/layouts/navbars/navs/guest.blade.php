<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('home') }}">
		<img width="50px" src="{{ asset('/storage/img/beltim.png') }}" alt="Simapda Logo" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<b>{{ __('SIMANJA') }}</b>
	  </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <!--li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Dashboard') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li-->
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <!--i class="material-icons">fingerprint</i-->
			<lord-icon
				src="https://cdn.lordicon.com/rqqkvjqf.json"
				trigger="loop"
				colors="primary:#121331,secondary:#08a88a"
				style="width:30px;height:30px">
			</lord-icon>
			{{ __('Login') }}
          </a>
        </li>
        <!--li class="nav-item ">
          <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="material-icons">face</i> {{ __('Profile') }}
          </a>
        </li-->
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->