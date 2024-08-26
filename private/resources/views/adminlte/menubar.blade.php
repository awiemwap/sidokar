<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Sidokar</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{'/dist/img/user2-160x160.jpg'}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-header">DOKUMEN KELUAR</li>
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Memorandum M.01
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('m01biasa')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>M.01 Biasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('m01rahasia') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>M.01 Rahasia</p>
            </a>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a href="/suratbiasa" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>
            Surat
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/suratbiasa" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Surat Biasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dokumenkeluar') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dokumen Keluar</p>
            </a>
          </li>
        </ul>

      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            Faximili
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/UI/general.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Faximili Biasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Faximili Rahasia</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-header">DOKUMEN INTERNAL</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            Berita Acara
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/UI/general.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Berita Acara Biasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Berita Acara Rahasia</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>BAMA</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>BASTAM</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>BANA</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            Form UAM
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/UI/general.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Form UAM ERP</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Form UAM CBS</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="pages/kanban.html" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Perjanjian
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/kanban.html" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Risalah Rapat
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/kanban.html" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Keputusan GBI
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/kanban.html" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Keputusan PBI
          </p>
        </a>
      </li>
      <li class="nav-header">MEMORANDUM M.02</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            M.02 Satker
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/UI/general.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>M.02 Satker Biasa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/UI/icons.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>M.02 Satker Rahasia</p>
            </a>
          </li>
        </ul>
      </li>

      @if (Auth::user()->level == 'admin')
      <li class="nav-header">ADMIN AREA</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            Pengaturan Aplikasi
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('dokumen') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Setting Nama Dokumen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('tahun') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Setting Tahun</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('koderubrik') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Setting Klasifikasi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('rubrik') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Setting Rubrik Lengkap</p>
            </a>
          </li>
        </ul>
      </li>
      @endif
    </ul>

      
  <!-- /.sidebar-menu -->
</div>