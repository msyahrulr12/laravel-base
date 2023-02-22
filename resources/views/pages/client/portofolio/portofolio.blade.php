@extends('layouts.client.main')
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
          <div class="container position-relative">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-6 text-center">
                <h2>Progran Kerja</h2>
                <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
              </div>
            </div>
          </div>
        </div>
        <nav>
          <div class="container">
            <ol>
              <li><a href="{{ route('home') }}">Beranda</a></li>
              <li>Portofolio</li>
            </ol>
          </div>
        </nav>
      </div><!-- End Breadcrumbs -->

    <div class="container-fluid">
        <div class="px-lg-5">
            <embed src="{{ asset('storage/'.$data->banner) }}" width="100%" height="2100px" />
        </div>
    </div>

</main>
@endsection
