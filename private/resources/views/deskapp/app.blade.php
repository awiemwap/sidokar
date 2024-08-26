<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('tittle')</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{ url('/vendors/images/apple-touch-icon.png')}}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{ url('/vendors/images/favicon-32x32.png')}}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{ url('/vendors/images/favicon-16x16.png')}}"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ url('/vendors/styles/core.css')}}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('/vendors/styles/icon-font.min.css')}}"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}"
		/>
		<link rel="stylesheet" type="text/css" href="{{ url('/vendors/styles/style.css')}}" />
		@yield('css')
	</head>
	<body>
        {{-- Navbar --}}
		@include('deskapp.navbar')
        {{-- End of navbar --}}

        {{-- Setting Layout --}}
		@include('deskapp.setting')
        {{-- End setting layout --}}

		{{-- Notifikasi SweetAlert --}}
		@include('sweetalert::alert')

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="{{url('dashboard')}}">
					<img src="{{ url('/vendors/images/logo3.png')}}" alt="" class="dark-logo" />
					<img
						src="{{ url('/vendors/images/logodark.png')}}"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
            {{-- Menubar --}}
			@include('deskapp.menubar')
            {{-- End of Menubar --}}
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>@yield('judul')</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											@yield('halaman')
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											@yield('submenu')
										</li>
									</ol>
								</nav>
							</div>
                            <div class="col-md-6 col-sm-12 text-right">
								@yield('tambah')
							</div>
						</div>
					</div>
					{{-- Container --}}
					@yield('container')
					{{-- End of COntainer --}}
				</div>

				<div class="footer-wrap pd-20 mb-20 card-box">
					| Sistem Administrasi Dokumen Keluar | SIADK v.2.0.0 |
					<br><a href="https://www.bi.go.id">KPwBI Kediri</a>
				</div>
			</div>
		</div>
		
		<!-- js -->
		<script src="{{ url('/vendors/scripts/core.js')}}"></script>
		<script src="{{ url('/vendors/scripts/script.min.js')}}"></script>
		<script src="{{ url('/vendors/scripts/process.js')}}"></script>
		<script src="{{ url('/vendors/scripts/layout-settings.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
		<!-- buttons for Export datatable -->
		<script src="{{ url('/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
		<script src="{{ url('/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
		<!-- Datatable Setting js -->
		<script src="{{ url('/vendors/scripts/datatable-setting.js')}}"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->

		@yield('validasi')
	</body>
</html>
