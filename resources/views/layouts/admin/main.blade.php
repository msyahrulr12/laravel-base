<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link href="{{ asset('storage/1674969542rvJhVJyMDd.png') }}" rel="icon">

	<title>Laskar Merah Putih</title>

	<link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/vbv648tcvjj964pg4cw6z4uewq92d4j2zjkxaa0bsvvz2yb8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <!-- Sweetalert -->
    @include('sweetalert::alert')
    <!-- End Sweetalert -->

	<div class="wrapper">
        @include('layouts.admin.sidebar')

		<div class="main">
            @include('layouts.admin.topbar')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            @endif

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            @include('layouts.admin.footer')
		</div>
	</div>

    @include('layouts.admin._js_plugin')
</body>

</html>
