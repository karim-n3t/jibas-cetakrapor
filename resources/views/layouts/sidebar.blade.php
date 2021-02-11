<div class="sidebar" data-color="azure" data-background-color="white" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
  <div class="logo">
    <a href="#" class="simple-text logo-mini">
      BT
    </a>
    <a href="#" class="simple-text logo-normal">
      Binawiyata Team
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{ asset('assets/img/logo/karim.jpg') }}" alt="user"/>
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span>
            @auth
                {{ Auth::user()->name }}
            @else
                Guest
            @endauth
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> MP </span>
                <span class="sidebar-normal"> My Profile </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> EP </span>
                <span class="sidebar-normal"> Edit Profile </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span class="sidebar-mini"> S </span>
                <span class="sidebar-normal"> Settings </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="material-icons">dashboard</i>
          <p> Dashboard </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#menuPresensi">
          <i class="material-icons">date_range</i>
          <p> Presensi
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="menuPresensi">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('PresensiHarian') }}">
                <span class="sidebar-mini"> PH </span>
                <span class="sidebar-normal"> Harian </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('PresensiRekap') }}">
                <span class="sidebar-mini"> PR </span>
                <span class="sidebar-normal"> Rekap </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('PresensiPerorangan') }}">
                <span class="sidebar-mini"> PP </span>
                <span class="sidebar-normal"> Perorangan </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('PresensiPengaturan') }}">
                <span class="sidebar-mini"> PS </span>
                <span class="sidebar-normal"> Pengaturan </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @auth
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#menuRaport">
          <i class="material-icons">grid_on</i>
          <p> Raport
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="menuRaport">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('Daftar Kelas Raport') }}">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> Raport Semester </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('Daftar Kelas Raport') }}">
                <span class="sidebar-mini"> ET </span>
                <span class="sidebar-normal"> Pengaturan Raport </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ asset('examples/tables/datatables.net.html') }}">
                <span class="sidebar-mini"> DT </span>
                <span class="sidebar-normal"> DataTables.net </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#menuPPDB">
          <i class="material-icons">grid_on</i>
          <p> PPDB
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="menuPPDB">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('Daftar Kelas Raport') }}">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> Laporan Sementara </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('Daftar Kelas Raport') }}">
                <span class="sidebar-mini"> ET </span>
                <span class="sidebar-normal"> Raport Draft </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ asset('examples/tables/datatables.net.html') }}">
                <span class="sidebar-mini"> DT </span>
                <span class="sidebar-normal"> DataTables.net </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endauth
      <li class="nav-item ">
        <a class="nav-link" href="{{ asset('examples/widgets.html') }}">
          <i class="material-icons">widgets</i>
          <p> Widgets </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{ asset('examples/charts.html') }}">
          <i class="material-icons">timeline</i>
          <p> Charts </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="{{ asset('examples/calendar.html') }}">
          <i class="material-icons">date_range</i>
          <p> Calendar </p>
        </a>
      </li>
    </ul>
  </div>
</div>
