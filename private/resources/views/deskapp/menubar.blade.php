<div class="menu-block customscroll">
    <div class="sidebar-menu">
        <ul id="accordion-menu">
            <li>
                <div class="sidebar-small-cap">DOKUMEN KELUAR</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-file-earmark"></span
                    ><span class="mtext">Memorandum M.01</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m01biasa')}}">M.01 Biasa</a></li>
                    <li><a href="{{ route('m01rahasia')}}">M.01 Rahasia</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-envelope-open-heart"></span> 
                    <span class="mtext">Surat</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('suratbiasa')}}">Surat Biasa</a></li>
                    <li><a href="{{ route('suratrahasia')}}">Surat Rahasia</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">Faximili</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('faximilibiasa')}}">Faximili Biasa</a></li>
                    <li><a href="{{ route('faximilirahasia')}}">Faximili Rahasia</a></li>
                </ul>
            </li>
            
            <li>
                <a href="{{ route('siaran')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-files-o"></span>
                    <span class="mtext"
                        >Siaran Pers
                    </span>
                </a>
            </li>
                <div class="dropdown-divider"></div>
            </li>
            <li>
                <div class="sidebar-small-cap">DOKUMEN INTERNAL</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">Berita Acara</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('babiasa')}}">Berita Acara Biasa</a></li>
                    <li><a href="{{ route('barahasia')}}">Berita Acara Rahasia</a></li>
                    <li><a href="{{ route('bastam')}}">BASTAM</a></li>
                    <li><a href="{{ route('bana')}}">BANA</a></li>
                    <li><a href="{{ route('bama')}}">BAMA</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">Form UAM</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('erp')}}">Form UAM ERP</a></li>
                    <li><a href="{{ route('cbs')}}">Form UAM CBS</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">Risalah Rapat</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('risalahbiasa')}}">Risalah Rapat Biasa</a></li>
                    <li><a href="{{ route('risalahrahasia')}}">Risalah Rapat Rahasia</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">M.02 Satker</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02satkerbiasa')}}">M.02 Satker Biasa</a></li>
                    <li><a href="{{route('m02satkerrhs')}}">M.02 Satker Rahasia</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">Dokumen CA</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02CA')}}">M.02 CA Biasa</a></li>
                    <li><a href="{{route('caldp')}}">LDP CA</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('surattugas')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-envelope-open-heart"></span>
                    <span class="mtext"
                        >Surat Tugas Satker
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('perjanjian')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-handshake-o"></span>
                    <span class="mtext"
                        >Perjanjian
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('gbi')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-files-o"></span>
                    <span class="mtext"
                        >Keputusan GBI
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('pbi')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-files-o"></span>
                    <span class="mtext"
                        >Keputusan PBI
                    </span>
                </a>
            </li>
            @if (Auth::user()->unit == 'UMI')
                <div class="dropdown-divider"></div>
            <li>
                <div class="sidebar-small-cap">DOKUMEN UMI</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">M.02 UMI</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02umibiasa')}}">M.02 Biasa</a></li>
                    <li><a href="{{ route('m02umirhs')}}">M.02 Rahasia</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('batch')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >Nomor Batch
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('umitv01')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >Nomor TV.01
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('umildp')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >LDP
                    </span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon fa fa-car"></span> 
                    <span class="mtext">Kendaraan Dinas</span>
                </a>
                <ul class="submenu">
                    <li><a href="https://kedirigreat.cloud/kendaraan">Data Kendaraan Dinas</a></li>
                    <li><a href="https://kedirigreat.cloud/pemeliharaan">Data Pemeliharaan Kendaraan</a></li>
                </ul>
            </li>
            
            @endif
            @if (Auth::user()->unit == 'KEKDA')
                <div class="dropdown-divider"></div>
            <li>
                <div class="sidebar-small-cap">DOKUMEN TIM KEKDA</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">M.02 KEKDA</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02kekdabiasa')}}">M.02 Biasa</a></li>
                    <li><a href="{{ route('m02kekdarhs')}}">M.02 Rahasia</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('kekdatv01')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >Nomor TV.01
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('kekdaldp')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >LDP
                    </span>
                </a>
            </li>
            
            @endif
            @if (Auth::user()->unit == 'UIKSP')
                <div class="dropdown-divider"></div>
            <li>
                <div class="sidebar-small-cap">DOKUMEN UIKSPPSPPUR</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">M.02 UIKSPPSPPUR</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02uikspbiasa')}}">M.02 Biasa</a></li>
                    <li><a href="{{ route('m02uiksprhs')}}">M.02 Rahasia</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('uiksptv01')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >Nomor TV.01
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('uikspldp')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >LDP
                    </span>
                </a>
            </li>
            
            @endif
            @if (Auth::user()->unit == 'UIPUR') 
                <div class="dropdown-divider"></div>
            <li>
                <div class="sidebar-small-cap">DOKUMEN UIPUR</div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi  bi bi-telegram"></span> 
                    <span class="mtext">M.02 UIPUR</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('m02uipurbiasa')}}">M.02 Biasa</a></li>
                    <li><a href="{{ route('m02uipurrhs')}}">M.02 Rahasia</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('uipurtv01')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >FORM TV 01
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('uipurldp')}}"
                    class="dropdown-toggle no-arrow">
                    <span class="micon bi bi-layout-text-window-reverse"></span>
                    <span class="mtext"
                        >LDP
                    </span>
                </a>
            </li>
            
            @endif
            @if (Auth::user()->level == 'admin')
                <div class="dropdown-divider"></div>
            <li>
                <div class="sidebar-small-cap">Admin Area</div>
            </li>
            <li>
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-file-pdf"></span
                    ><span class="mtext">Pengaturan Aplikasi</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('dokumen')}}">Atur Jenis Dokumen</a></li>
                    <li><a href="{{ route('tahun')}}">Atur Tahun</a></li>
                    <li><a href="{{ route('koderubrik')}}">Atur Kode Rubrik</a></li>
                    <li><a href="{{ route('rubrik')}}">Atur Rubrik dan Tahun</a></li>
                </ul>
            </li>
            
            <li>
                <a href="javascript:;" class="dropdown-toggle">
                    <span class="micon bi bi-file-pdf"></span
                    ><span class="mtext">Pengaturan User</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('user')}}">Daftar User</a></li>
                    <li><a href="{{ route('resetpassword')}}">Reset password</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>