<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width"/>

	<title>{{ @$subject }}</title>
	<style>
		/* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */

		#outlook a {
			padding:0;
		}
		body {
			background-color: #f6f6f6;
			font-family: sans-serif;
			-webkit-font-smoothing: antialiased;
			font-size: 14px;
			line-height: 1.4;
			margin: 0;
			padding: 0;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		/* padding-top */
		.pt-10 {
			padding-top:10px !important;
		}
		.pt-25 {
			padding-top:25px !important;
		}
		.pt-50 {
			padding-top:50px !important;
		}
		.pt-100 {
			padding-top:100px !important;
		}
		/* padding-bottom */
		.pb-10 {
			padding-bottom:10px !important;
		}
		.pb-25 {
			padding-bottom:25px !important;
		}
		.pb-50 {
			padding-bottom:50px !important;
		}
		.pb-100 {
			padding-bottom:100px !important;
		}
		/* margin-top */
		.mt-10 {
			margin-top:10px !important;
		}
		.mt-25 {
			margin-top:25px !important;
		}
		.mt-50 {
			margin-top:50px !important;
		}
		.mt-100 {
			margin-top:100px !important;
		}
		/* margin-bottom */
		.mb-10 {
			margin-bottom:10px !important;
		}
		.mb-25 {
			margin-bottom:25px !important;
		}
		.mb-50 {
			margin-bottom:50px !important;
		}
		.mb-100 {
			margin-bottom:100px !important;
		}
		.clear-property {
			margin: 0;
			padding: 0;
		}
		.dash-line {
			width: 560px;
			height: 2px;
			background-color: #cccccc;
			border: dashed 2px #ffffff;
		}
		/* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */

		.body {
			background-color: #f6f6f6;
			width: 100%; }
		/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
		.container {
			display: block;
			Margin: 0 auto !important;
			/* makes it centered */
			max-width: 580px;
			padding: 10px;
			width: 580px; }
		/* This should also be a block element, so that it will fill 100% of the .container */
        .centering {
            display: flex;
            justify-content: center;
        }
		.content {
			box-sizing: border-box;
			display: block;
			Margin: 0 auto;
			max-width: 580px;
			padding: 10px;
		}
		.logo-frame {
			display:flex;
			align-items: center;
			justify-content: center;
			width: auto;
			height: auto;
			border-radius: 24px;
			background-color: #ffffff;
			box-shadow: 0px 16px 32px 0 rgba(104, 124, 131, 0.25);
		}
		.greet-container {
			max-width: 580px;
			padding: 10px;
			width: 580px;
			display: block;
			margin: 0 auto !important;
			text-align: center;
		}
		.main-container {
			max-width: 580px !important;
			padding: 50px;
			width: 580px;
			display: block;
			margin: 0 auto !important;
			margin-top: 25px !important;
			text-align: left;
			background-color:#ffffff;
		}
		.footer-container {
			max-width: 580px !important;
			padding: 50px;
			width: 580px;
			display: block;
			margin: 0 auto !important;
			margin-top: 25px !important;
			text-align: center;
			background-color:#ffffff;
		}
		.media-social-container {
			display:block;
			margin: 0 auto !important;
			margin-top: 25px !important;
			width: 250px !important;
		}
		.media-social-container > .sort-items {
			display: flex;
			justify-content: space-between;
		}
		.logo-footer-container {
			display: block;
			margin: 0 auto !important;
			margin-top: 30px !important;
			width: 250px !important;
		}
		.copyright-container {
			display: block;
			margin: 0 auto !important;
			margin-top: 30px !important;
			max-width: 580px !important;
			width: 580px !important;
		}
		.btn-upload {
			color: white;
			width: 240px;
			height: 56px;
			border-radius: 4px;
			background-image: linear-gradient(to right, #a5c63b, #b6e030);
		}
		.media-social{
			padding: 10px;
		}
        .text-center {
            text-align: center;
        }

        #rincian-loan {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #rincian-loan td, #rincian-loan th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #rincian-loan tr:nth-child(even){background-color: #f2f2f2;}

        #rincian-loan tr:hover {background-color: #ddd;}

        #rincian-loan th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #EEB11F;
            color: white;
        }

        .btn-forgot-password {
            background-color: #b20238;
            padding: 10px 20px;
            border: 0;
            border-radius: 5px;
            color: #ffffff;
            text-align: center;
            display: block;
            margin: auto;
            width: 200px;
            font-weight: bold;
            text-decoration: none;
            text-decoration: none;
        }

        .btn-forgot-password:hover {
            cursor: pointer;
        }

        .w-100 {
            width: 100%;
        }

        .w-50 {
            width: 50%;
        }

        .w-25 {
            width: 25%;
        }

        .logo {
            display: block;
            margin: auto;
        }
	</style>
</head>
<body>

	<div class="main-container">
        <div class="pt-25 centering">
            <img src="http://localhost:8008/storage/1674969542rvJhVJyMDd.png" alt="Logo" class="w-25 logo" />
        </div>
        <br><br>

        <p>Yth {{ $name }},</p>
        <p>Klik tombol ubah password untuk melakukan perubahan password Anda</p>

        <br>
        <a class="btn-forgot-password" href="{{ $link }}" target="_blank">Ubah Password</a>
        <br>

        <p>Jika tombol di atas tidak bisa diakses, klik link di bawah ini : </p>

        <a href="{{ $link }}">
            {{ $link }}
        </a>

        <p>Salam,</p>

        <p>TIM Laskar Merah Putih</p>
		{{-- <p>Hubungi (021) 515 3166 untuk bantuan</p> --}}
	</div>

	<div class="media-social-container text-center">
		<div class="sort-items">
            <a class="media-social" href="https://twitter.com/klikumkm">
			    <img src="https://storage.googleapis.com/klikumkm/emails/twiter.png" alt="Twitter"/>
            </a>
            <a class="media-social" href="https://www.facebook.com/klikumkmindonesia/">
			    <img src="https://storage.googleapis.com/klikumkm/emails/facebook.png" alt="Facebook"/>
            </a>
            <a class="media-social" href="https://www.youtube.com/channel/UC2BfHj31yczJIDSugUPY1DA/featured?disable_polymer=1">
                <img src="https://storage.googleapis.com/klikumkm/emails/ic-youtube.png" alt="Youtube"/>
            </a>
            <a class="media-social" href="https://www.instagram.com/klikumkm.co.id/">
                <img src="https://storage.googleapis.com/klikumkm/emails/ig.png" alt="Instagram"/>
            </a>
		</div>
	</div>
	<div class="logo-footer-container">
		<!-- <img src="https://storage.googleapis.com/klikumkm/emails/logo-grey.png" alt="Logo"/> -->
	</div>
	<div class="copyright-container">
		<p style="text-align:center">The Capital Residence, Office Tower Lantai 6, Kawasan Niaga Terpadu Sudirman (SCBD). Jl. Jend. Sudirman Kav 52-53, Jakarta Selatan 12190</p>
	</div>
</body>
</html>
