<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Siakar Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SiAkar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(auth()->check())
              @if(auth()->user()->role == 'Admin')
                  <img src="{{ asset('path_to_admin_image') }}" class="img-circle elevation-2" alt="User Image">
              @elseif(auth()->user()->role == 'Karyawan')
                  <img src="{{ asset('path_to_karyawan_image') }}" class="img-circle elevation-2" alt="User Image">
              @else
                  <img src="{{ asset('default_image_path') }}" class="img-circle elevation-2" alt="User Image">
              @endif
          @else
              <img src="{{ asset('default_image_path') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          @if(auth()->check())
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
          @else
            <a href="#" class="d-block">Guest</a>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/home" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(auth()->check() && auth()->user()->role == 'Admin')
          <li class="nav-item">
            <a href="/datakaryawan" class="nav-link">
              <i class="fas fa-chart-bar"></i>
              <p>
                Data Karyawan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class="fas fa-table"></i>
              <p>
                Data User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/jabatans" class="nav-link">
              <i class="far fa-check-square"></i>
              <p>Data Jabatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/absen" class="nav-link">
              <i class="fas fa-calendar-alt"></i>
              <p>Data Absensi</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="/about" class="nav-link">
              <i class="fas fa-info-circle"></i>
              <p>About Us</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
