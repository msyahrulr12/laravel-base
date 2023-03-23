<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link href="{{ asset('storage/1674969542rvJhVJyMDd.png') }}" rel="icon">
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Laskar Merah Putih - Halaman Ganti Password</title>

	<link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Sweetalert -->
    @include('sweetalert::alert')
    <!-- End Sweetalert -->

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Halaman Ganti Password</h1>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="{{ asset('storage/1674969542rvJhVJyMDd.png') }}" alt="Login Image" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form action="{{ route('admin.forgot-password.change') }}" method="POST">
                                        @csrf
                                        <div>
                                            <input class="form-control form-control-lg" type="hidden" name="token" value="{{ $_GET['token'] }}" />
                                        </div>
										<div class="mb-3">
											<label class="form-label">Password Baru</label>
											<input class="form-control form-control-lg" type="password" name="new_password" placeholder="Masukkan password baru Anda" />
                                            <small>
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div>{{$error}}</div>
                                                    @endforeach
                                                @endif
                                            </small>
										</div>
										<div class="mb-3">
											<label class="form-label">Ulangi Password</label>
											<input class="form-control form-control-lg" type="password" name="re_enter_new_password" placeholder="Masukkan ulang password baru Anda" />
                                            <small>
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div>{{$error}}</div>
                                                    @endforeach
                                                @endif
                                            </small>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	@include('layouts.admin._js_plugin')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
