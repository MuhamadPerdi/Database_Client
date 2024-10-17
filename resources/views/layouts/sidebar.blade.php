<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{url('/')}}">{{ Auth::user()->name }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{url('/')}}">{{ Auth::user()->name }}</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Daftar Website</li>
        <li class="dropdown">
          <a href="{{url('/')}}" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
          <a href="{{url('/configurasi')}}" class="nav-link"><i class="fas fa-cog"></i><span>Configurasi</span></a>
          @can('client')
          <a href="{{url('/clients')}}" class="nav-link"><i class="fas fa-users"></i><span>Client</span></a>
          @endcan
          @can('monitoring')
          <a href="{{url('/monitorings')}}" class="nav-link"><i class="fas fa-chart-line"></i><span>Monitoring</span></a>
          @endcan
        </li>
    
        <li class="dropdown">
          @if(auth()->user()->can('monitoring') || auth()->user()->can('client'))
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
          <ul class="dropdown-menu">
            @can('client')
            <li><a class="nav-link" href="{{route('jenis.index')}}">Jenis Client</a></li>
            @endcan
            @can('client')
            <li><a class="nav-link" href="{{route('status.index')}}">Status Client</a></li>
            @endcan
            @can('monitoring')
            <li><a class="nav-link" href="{{route('keterangan.index')}}">Keterangan Monitoring</a></li>
            @endcan
            @can('monitoring')
            <li><a class="nav-link" href="{{route('projek.index')}}">Projek Monitoring</a></li>
            @endcan
          </ul>
          @endif
        </li>
        <li class="dropdown">
          @if(auth()->user()->can('useradmin') || auth()->user()->can('fitur'))
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-lock"></i> <span>Master Admin</span></a>
          <ul class="dropdown-menu">
            @can('useradmin')
            <li><a class="nav-link" href="{{route('users.index')}}">User admin</a></li>
            @endcan
            @can('fitur')
            <li><a class="nav-link" href="{{route('fitur.index')}}">Fitur</a></li>
            @endcan
            @can('useradmin')
            <li><a class="nav-link" href="{{route('history.index')}}">Histori Crud</a></li>
            @endcan
          </ul>
          @endif
        </li>
    </ul>

      </aside>
  </div>