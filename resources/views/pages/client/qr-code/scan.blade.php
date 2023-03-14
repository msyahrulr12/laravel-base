@extends('layouts.client.main')
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
          <div class="container position-relative">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-6 text-center">
                <h2>Detail Member</h2>
                {{-- <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p> --}}
              </div>
            </div>
          </div>
        </div>
        <nav>
          <div class="container">
            <ol>
              <li><a href="{{ route('home') }}">Beranda</a></li>
              <li>Detail Member</li>
            </ol>
          </div>
        </nav>
      </div><!-- End Breadcrumbs -->

    <div class="container-fluid">
        <div class="container mt-5">
            <table class="table w-75">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $user->birthplace }}, {{ date('d M Y', strtotime($user->birthdate)) }}</td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{ $user->religion }}</td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>:</td>
                    <td>{{ $user->education }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{!! $user->address !!}</td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td>{{ $user->job }}</td>
                </tr>
                <tr>
                    <td>Keahlian</td>
                    <td>:</td>
                    <td>{{ $user->skill }}</td>
                </tr>
            </table>
        </div>
        <div class="px-lg-5">

            <div class="row my-5">
                <div class="col-xl-6 col-lg-4 col-md-6 mb-4">
                    <h5>Kartu Member Bagian Depan</h5>
                    <a href="{{ asset('storage/'.$user->front_card_image) }}" target="_blank">
                        <img src="{{ asset('storage/'.$user->front_card_image) }}" alt="Gambar depan kartu member" class="w-100">
                    </a>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-6 mb-4">
                    <h5>Kartu Member Bagian Belakang</h5>
                    <a href="{{ asset('storage/'.$user->back_card_image) }}" target="_blank">
                        <img src="{{ asset('storage/'.$user->back_card_image) }}" alt="Gambar belakang kartu member" class="w-100">
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
